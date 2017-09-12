<?php

namespace Framework\Factory;

use Framework\Interfaces\FactoryInterface;
use Exception;
use Config;
use Framework\Injectables\Injector;

class EventFactory implements FactoryInterface
{
    private static $namespace;

    public static function init()
    {
        $config = Injector::resolve("Config");
        $config = $config->getConfig("application");
        static::$namespace = $config["event_namespace"];
    }

    public static function build($type = "", $path = "")
    {
        static::init();

        if($path == "")
        {
            $className = static::$namespace . ucfirst($type) . "Event";
        } elseif($path == "framework"){
            $className = "Framework\\Events\\" . ucfirst($type) . "Event";
        } else {
            throw new Exception("Unknown path to factory", 1);
        }

        if($type == "")
        {
             throw new Exception('No type given');
        } else {
            if(class_exists($className))
            {
                return new $className();
            } else {
                throw new Exception($className . ' does not exist.');
            }
        }
    }
}
