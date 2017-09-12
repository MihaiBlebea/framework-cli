<?php

namespace Framework\Injectables;

use Framework\Injectables\Injector;
use Framework\Interfaces\ComponentInterface;
use Framework\Configs\Config;
use Framework\Sessions\UsernameSession;
use Framework\Auth\Login;
use Framework\Factory\SessionFactory;
use Framework\Templates\TemplateEngine;

class TemplateComponent extends Injector implements ComponentInterface
{
    public function boot()
    {
        self::register('Template', function() {
            $config = new Config();
            $session = SessionFactory::build("Username", "framework");
            $login = new Login($session);
            $template = new TemplateEngine($config, $login);
            return $template;
        });
    }

    public function run($instance)
    {

    }
}
