<?php

namespace Framework\Interfaces;

/**
 *
 */
interface FactoryInterface
{
    public static function init();

    public static function build($type = "", $path = "");
}
