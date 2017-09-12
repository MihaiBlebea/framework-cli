<?php

namespace Framework\Injectables;

use Framework\Injectables\Injector;
use Framework\Interfaces\ComponentInterface;
use Framework\Configs\Config;

class ConfigComponent extends Injector implements ComponentInterface
{
    public function boot()
    {
        self::register('Config', function() {
            $config = new Config();
            return $config;
        });
    }

    public function run($instance)
    {

    }
}
