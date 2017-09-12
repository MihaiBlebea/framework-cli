<?php

namespace Framework\Injectables;

use Framework\Injectables\Injector;
use Framework\Interfaces\ComponentInterface;
use Framework\Database\Connector;
use Framework\Configs\Config;

class ConnectorComponent extends Injector implements ComponentInterface
{
    public function boot()
    {
        self::register('Connector', function() {
            $config = new Config();
            $config = $config->getConfig("database");
            $connector = new Connector($config["connect"]["servername"],
                                       $config["connect"]["database"],
                                       $config["connect"]["username"],
                                       $config["connect"]["password"]);
            return $connector;
        });
    }

    public function run($instance)
    {

    }
}
