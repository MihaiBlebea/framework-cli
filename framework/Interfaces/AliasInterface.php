<?php

namespace Framework\Interfaces;

interface AliasInterface
{
    public static function __callStatic($name, $arguments);
}
