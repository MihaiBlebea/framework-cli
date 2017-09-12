<?php

namespace Framework\Router;

use Framework\Sessions\PreviousPathSession;
use Framework\Router\GateKeeper;
use Framework\Router\Binder;
use Framework\Configs\Config;

class Router
{
    private $request;

    private $config;

    private $routerPathFile = array();

    private $getRoutes      = array();

    private $postRoutes     = array();

    private $dinamicParams  = array();

    private $options        = array();

    private $groups         = array();

    private $lastMethod;

    private $lastRoute;

    private $hasDinamicParams = false;

    private $goTo;

    public function __construct(Request $request, Config $config)
    {
        $this->request = $request;
        $this->config  = $config->getConfig("application");
    }

    // Store router path and objects in different files
    public function storeRouterFilePath($path)
    {
        array_push($this->routerPathFile, $path);
    }

    // Access the stored router files, like web.php, api.php, etc
    public function getRouterPathFile()
    {
        foreach($this->routerPathFile as $routerFile)
        {
            include($routerFile);
        }
    }

    // Specify a named root that you want to access
    public function goToName($name)
    {
        foreach($this->getRoutes as $index => $routeOptions)
        {
            if($routeOptions["name"] == $name)
            {
                $this->goTo = $index;
            }
        }
        return $this;
    }

    // Specify additional params for manual access route path
    public function with(array $keys)
    {
        $params = $this->splitRoute($this->goTo);

        foreach($params as $index => $param)
        {
            if(strpos($param, ":") !== false)
            {
                $params[$index] = $keys[ltrim($param, ":")];
            }
        }
        $url = $this->concatParams($params);

        $this->navigateToUrl($url);
    }

    // String together and build an url from different params
    public function concatParams(array $params)
    {
        $result = "";
        foreach($params as $param)
        {
            $result .= "/" . $param;
        }
        return $result;
    }

    // Redirect to a specific url
    public function navigateToUrl($url)
    {
        header("Location: " . $this->config["app_path"] . $url);
        die();
    }

    // Build and store all the GET routes
    public function get($path, $controller)
    {
        $this->lastMethod = "GET";
        $this->lastRoute = $path;
        $this->getRoutes[$path]["controller"] = $controller;
        return $this;
    }

    // Build and store all the POST routes
    public function post($path, $controller)
    {
        $this->lastMethod = "POST";
        $this->lastRoute = $path;
        $this->postRoutes[$path]["controller"] = $controller;
        return $this;
    }

    public function group(array $array)
    {
        $this->groups[$array["name"]] = $array;
    }

    public function belongsTo($name)
    {
        if(array_key_exists($name, $this->groups))
        {
            if($this->lastMethod == "GET")
            {
                $this->getRoutes[$this->lastRoute]["rules"] = $this->groups[$name]["rules"];
                if(array_key_exists("prefix", $this->groups[$name]))
                {
                    $prefix = $this->groups[$name]["prefix"];
                    $routePayload = $this->getRoutes[$this->lastRoute];
                    array_pop($this->getRoutes);
                    $this->getRoutes[$prefix . "/" . $this->lastRoute] = $routePayload;
                }

            } elseif($this->lastMethod == "POST") {
                $this->postRoutes[$this->lastRoute]["rules"] = $this->groups[$name]["rules"];
                if(array_key_exists("prefix", $this->groups[$name]))
                {
                    $prefix = $this->groups[$name]["prefix"];
                    $routePayload = $this->postRoutes[$this->lastRoute];
                    array_pop($this->postRoutes);
                    $this->postRoutes[$prefix . "/" . $this->lastRoute] = $routePayload;
                }
            } else {
                throw new Exception("Could not find route", 1);
            }
        } else {
            throw new Exception("Could not find name of route in groups. Please call the group function first", 1);
        }
        // dd($this->getRoutes);
    }

    // CHeck if the request is GET or POST and save the info
    private function checkMethod($data, $key)
    {
        if($this->lastMethod == "GET")
        {
            $this->getRoutes[$this->lastRoute][$key] = $data;
        } elseif($this->lastMethod == "POST") {
            $this->postRoutes[$this->lastRoute][$key] = $data;
        }
    }

    // Specify a name for easy access your route
    public function as($name = "")
    {
        if($name !== "")
        {
            $this->checkMethod($name, "name");
        }
        return $this;
    }

    // Specify what params and models to bind to the route, using route-model binding
    public function bind(array $binds = [])
    {
        if($binds !== [])
        {
            $this->checkMethod($binds, "binds");
        }
        return $this;
    }

    // Specify middlewares for limiting access to specific urls
    public function rules(array $rules = [])
    {
        if($rules !== [])
        {
            $this->checkMethod($rules, "rules");
        }
        return $this;
    }

    // Split an url to it's bare params
    private function splitRoute($route)
    {
        return explode("/", $route);
    }

    // Start comparing different routes to the current request
    public function compare()
    {
        if($this->request->getMethod() == "GET")
        {
            $localArray = $this->getRoutes;
        } elseif ($this->request->getMethod() == "POST") {
            $localArray = $this->postRoutes;
        } else {
            throw new Exception("Error Processing Routes Method", 1);
        }

        if($this->compareArrays($localArray) !== true)
        {
            if($this->compareStrings($localArray) !== true)
            {
                $this->callNotFound();
            } else {
                $this->callFoundInString();
            }
        } else {
            $this->callFoundInArray();
        }
    }

    // Compare routes with request as ARRAYS (dinamic params)
    private function compareArrays($localArray)
    {
        foreach($localArray as $key => $options)
        {
            $local    = $this->splitRoute($key);
            $incoming = $this->request->getArray();

            if(count($local) == count($incoming))
            {
                for($i = 0; $i < count($local); $i++)
                {
                    if($local[$i] !== $incoming[$i])
                    {
                        if(strpos($local[$i], ':') !== false)
                        {
                            $id = ltrim($local[$i], ':');
                            $this->dinamicParams[$i] = ["id" => $id, "param" => $incoming[$i]];
                        } else {
                            continue 2;
                        }
                    }
                }
                $this->options = $options;
                return true;
                break;
            }
        }
    }

    // Compare routes with request as strings (NO dinamic params)
    private function compareStrings($localArray)
    {
        foreach($localArray as $key => $options)
        {
            if($key == $this->request->getTrimmedUrl())
            {
                $this->options = $options;
                return true;
            }
        }
    }

    // Specify the 404 page
    private function callNotFound()
    {
        dd("404");
    }

    // Found route in array comparision
    private function callFoundInArray()
    {
        if(array_key_exists("binds", $this->options))
        {
            $this->hasDinamicParams = true;
        }
        $this->beforeController($this->request, $this->options);
    }

    // Found route by string comparision
    private function callFoundInString()
    {
        $this->beforeController($this->request, $this->options);
    }

    // Do all the necesary computetions here before calling the controller class
    private function beforeController(Request $request, $options)
    {
        // Call Rules and see if they are valid
        if(isset($options["rules"]))
        {
            $rules = GateKeeper::call($options["rules"]);
        }

        if($this->hasDinamicParams == true)
        {
            //Also check if the models were not found in the database
            $models = Binder::bind($this->dinamicParams, $options["binds"]);
            return $this->callController($models);
        }

        return $this->callController();
    }

    // Call the controller and pass the request with the specific params
    private function callController($models = "")
    {
        $result = explode("@", $this->options["controller"]);
        $class = $result[0];
        $method = $result[1];
        $class = new $class();

        // Transform models in arrays
        if(gettype($models) !== "array")
        {
            $models = array($models);
        }

        // Check if Request payload is empty and if not pass it to controller
        if($this->request->getAllPayload() !== [])
        {
            array_unshift($models, $this->request);
        }

        call_user_func_array(array($class, $method), $models);
    }
}
