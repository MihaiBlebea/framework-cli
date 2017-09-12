<?php

namespace Framework\Factory;

use Framework\Interfaces\FactoryInterface;
use Framework\Injectables\Injector;

class EmailFactory implements FactoryInterface
{
    private static $namespace;

    public static function init()
    {
        $config = Injector::resolve("Config");
        $config = $config->getConfig("application");
        static::$namespace = $config["email_namespace"];
    }

    public static function build($type, $path = "")
    {
        static::init();

        if($path == "")
        {
            $className = static::$namespace . ucfirst($type);
        } elseif($path == "framework"){
            $className = "Framework\\Emails\\" . ucfirst($type);
        } else {
            throw new Exception("Unknown path to factory", 1);
        }

        if($type == "")
        {
            throw new \Exception('No email found');
        } else {
            if(class_exists($className))
            {
                return new $className();
            } else {
                throw new \Exception('Email class not found.');
            }
        }
    }

}
