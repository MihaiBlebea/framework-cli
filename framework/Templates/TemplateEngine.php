<?php

namespace Framework\Templates;

require_once("../vendor/smarty/smarty/libs/Smarty.class.php");

use Framework\Configs\Config;
use Framework\Auth\Login;

class TemplateEngine extends \Smarty
{
    private $config;
    private $login;
    private $globalVariables;

    public function __construct(Config $config, Login $login)
    {
        parent::__construct();

        $this->config = $config;
        $this->login = $login;

        $this->setFolders();
        $this->assignGlobalVariables();
    }

    public function setFolders()
    {
        $this->setTemplateDir('../views/templates/');
        $this->setCompileDir('../views/templates_c/');
        $this->setConfigDir('../views/configs/');
        $this->setCacheDir('../views/cache/');
    }

    public function assignGlobalVariables()
    {
        $this->assign([
            "app_name" => $this->config->getConfig("application")["app_name"],
            "app_path" => $this->config->getConfig("application")["app_path"],
        ]);
    }

    public function setAssign(array $values)
    {
        $this->assign($values);
        return $this;
    }

    public function setDisplay($template)
    {
        $this->display($template);
    }
}
