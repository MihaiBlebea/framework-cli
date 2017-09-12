<?php

namespace Framework\Injectables;

use Framework\Injectables\Injector;
use Framework\Interfaces\ComponentInterface;
use Framework\Router\Router;
use Framework\Router\Request;
use Framework\Configs\Config;
use Framework\Sessions\PreviousPathSession;

class RouterComponent extends Injector implements ComponentInterface
{
    public function boot()
    {
        self::register('Router', function() {
            //$session = new PreviousPathSession();
            //$request = new Request($session);
            $request = Injector::resolve("Request");
            $config  = new Config();
            $router  = new Router($request, $config);
            $router->storeRouterFilePath("../routes/web.php");
            $router->getRouterPathFile();
            return $router;
        });
    }

    public function run($instance)
    {
        $instance->compare();
    }
}
