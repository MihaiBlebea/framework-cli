<?php

namespace Framework\Factory;

use Framework\Interfaces\FactoryInterface;
use Exception;

class ValidatorFactory implements FactoryInterface
{
    private static $namespace;

    public static function init()
    {

    }

    public static function build($type = "", $path = "")
    {
        if($type !== "")
        {
            $className = "Framework\\Validators\\" . ucfirst($type) . "Validator";
            if(class_exists($className))
            {
                return new $className();
            } else {
                throw new Exception($className . ' does not exist.');
            }
        } else {
            throw new Exception('No type given');
        }
    }
}
