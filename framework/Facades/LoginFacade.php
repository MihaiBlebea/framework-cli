<?php

namespace Framework\Facades;

use Framework\Injectables\Injector;

class LoginFacade
{
    public static function __callStatic($method, $params)
    {
        $login = Injector::resolve("Login");
        return $login->$method($params);
    }
}
