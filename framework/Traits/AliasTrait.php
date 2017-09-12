<?php

namespace Framework\Traits;

use App\App;

trait AliasTrait
{
    public static function __callStatic($name, $arguments)
    {
        $classArray = explode("\\",  __CLASS__);
        $className = $classArray[count($classArray) - 1];

        $app = new App();
        $aliases = $app->alias;

        if(isset($aliases[$className]))
        {
            $class = $aliases[$className];

            $reflection = new \ReflectionClass($class);
            if($reflection->hasMethod($name))
            {
                $class = new $class();
                $method = $reflection->getMethod($name);
                return call_user_func_array(array($class, $method->name), $arguments);
            }
        }
    }
}
