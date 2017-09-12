<?php

namespace Framework\Alias;

use Framework\Alias\Alias;
use Framework\Interfaces\AliasInterface;

class Payment extends Alias implements AliasInterface
{
    public static function __callStatic($name, $arguments)
    {
        return parent::init( __CLASS__, $name, $arguments);
    }
}
