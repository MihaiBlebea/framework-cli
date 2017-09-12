<?php

namespace Framework\Injectables;

use Closure;

class Injector
{
    private static $registry = array();

    public function register($name, Closure $resolve)
    {
        self::$registry[$name] = $resolve;
    }

    public static function resolve($name)
    {
        if(self::registered($name))
        {
            $name = self::$registry[$name];
            return $name();
        }
        throw new \Exception("No class or method found. [InjectionContainer => resolve()]");
    }

    public function resolveNamespace($namespace)
    {
        foreach($registry as $index => $value)
        {
            if($namespace == $value)
            {
                dd('ceva');
            }
        }
        throw new \Exception("No class or method found. [InjectionContainer => resolve()]");
    }

    public static function registered($name)
    {
       return array_key_exists($name, self::$registry);
    }
}
