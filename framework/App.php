<?php

namespace Framework;

use Framework\Injectables\Injector;
use Framework\Log\Logger;
use Framework\Factory\EventFactory;
use Framework\Factory\ListenerFactory;

class App
{
    public $config = array();

    private $booted = false;

    private $routerActivated = false;

    private $errorHandlerActivated = false;

    public function __construct()
    {
        $config = require_once('../config/component.php');
        $this->config = $config;
    }

    public function boot()
    {
        foreach($this->config['components'] as $namespace)
        {
            $component = new $namespace();
            $component->boot();
        }
        $this->booted = true;
    }

    public function init()
    {
        foreach($this->config['components'] as $index => $namespace)
        {
            $instance = Injector::resolve($index);
            $component = new $namespace();
            $component->run($instance);
        }
    }

    public function setErrorHandler($errno, $errstr, $errfile, $errline)
    {
        $time = date("Y-m-d H:i:s");
        $message = $time . ": Error name => " . $errno . " Error message => " . $errstr . " in file " . $errfile . " line " . $errline;

        $emailListener = ListenerFactory::build("EmailErrorToAdmin", "framework");
        $logListener = ListenerFactory::build("LogError", "framework");
        $event = EventFactory::build("Error", "framework");
        $event->attach($emailListener)->attach($logListener)->trigger($message);

        //Check if fatal error and die
    }

    public function testApp()
    {
        return [
            "booted" => $this->booted,
            "routerActivated" => $this->routerActivated,
            "errorHandlerActivated" => $this->errorHandlerActivated
        ];
    }
}
