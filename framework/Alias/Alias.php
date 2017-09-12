<?php

namespace Framework\Alias;

use Framework\Injectables\Injector;

class Alias
{
    /**
     * Store the namespace received from called Facade.
     */
    private static $namespace;

    /**
     * Store the name of the method called staticly.
     */
    private static $name;

    /**
     * Arguments passed as array from the sttic call.
     */
    private static $arguments;

    /**
     * The array of aliases from Config file
     */
    private static $alias;

    /**
     * The class name extracted from alias array
     */
    private static $calledClass;

    /**
     * The class name extracted from alias array
     */
    private static $aliasIndex;

    /**
     * The method who process and call the alias class
     */
    public static function init($namespace, $name, $arguments)
    {
        self::$namespace = $namespace;
        self::$name = $name;
        self::$arguments = $arguments;

        $aliasIndex = self::getClassNameFromNamespace();
        self::$alias = self::injectConfig();
        self::$aliasIndex = $aliasIndex;

        self::$calledClass = self::$alias[self::$aliasIndex];

        if(isset(self::$calledClass))
        {
            return self::callMethod();
        }
    }

    /**
     * Extract the short class name from namespace
     */
    public static function getClassNameFromNamespace()
    {
        $classArray = explode("\\",  self::$namespace);
        return $classArray[count($classArray) - 1];
    }

    /**
     * Call the Injector and receive and instance of Config class
     */
    public static function injectConfig()
    {
        $config = Injector::resolve("Config");
        return $config->getConfig('component')['alias'];
    }

    /**
     * Call the method and return to the Alias
     */
    public static function callMethod()
    {
        $newClass = Injector::resolve(self::$aliasIndex);
        return call_user_func_array(array($newClass, self::$name), self::$arguments);
    }
}
