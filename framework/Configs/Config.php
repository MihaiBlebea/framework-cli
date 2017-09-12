<?php

namespace Framework\Configs;

class Config
{
    private $configArray = array();

    public function __construct()
    {
        $configs = array_values(array_diff(scandir('../config'), array('.', '..')));

        foreach($configs as $config)
        {
            $this->configArray[rtrim($config, ".php")] = require("../config/" . $config);
        }
    }

    public function getAllConfigs()
    {
        return $this->configArray;
    }

    public function getConfig($file)
    {
        return $this->configArray[$file];
    }
}
