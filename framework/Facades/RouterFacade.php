<?php

namespace Framework\Facades;

use Framework\Injectables\Injector;

class RouterFacade
{
    public static function __callStatic($method, $params)
    {
        $router = Injector::resolve("Router");
        return $router->$method($params);
    }
}
