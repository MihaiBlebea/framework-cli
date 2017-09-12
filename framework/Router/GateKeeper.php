<?php

namespace Framework\Router;

use ReflectionMethod;

class GateKeeper
{
    public static function call(array $array)
    {
        foreach($array as $index => $value)
        {
            $rule = new ReflectionMethod($value, 'apply');
            $rule->invoke(new $value());

        }
        return true;
    }
}
