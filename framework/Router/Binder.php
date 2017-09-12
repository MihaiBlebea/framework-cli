<?php

namespace Framework\Router;

use Framework\Injectables\Injector;
use Exception;

class Binder
{
    private static $namespace;

    private static $params;

    public static function bind(array $params, array $models)
    {
        $config = Injector::resolve("Config");
        self::$namespace = $config->getConfig("application")["model_namespace"];

        $modelsParams = self::combineParamsWithModels($params, $models);

        $result = array();
        foreach($modelsParams as $model)
        {
            array_push($result, self::resolveBind($model));
        }
        return $result;
    }

    private static function combineParamsWithModels(array $params, array $models)
    {
        if(count($params) == count($models))
        {
            $result = array();
            foreach($params as $index => $param)
            {
                $param["model"] = $models[$param["id"]];
                array_push($result, $param);
            }
            return $result;
        } else {
            throw new Exception("Params array do not have the same number of elements as Models array", 1);
        }
    }

    private static function resolveBind(array $model)
    {
        $class = self::$namespace . $model["model"];
        $class = new $class();

        if(isset($class->tableKey))
        {
            $key = $class->tableKey;
        } else {
            $key = "id";
        }

        $found = $class->where($key, "=", $model["param"])->selectOne();
        if($found !== false)
        {
            return $found;
        } else {
            throw new Exception("Model not found in database", 1);
        }
    }
}
