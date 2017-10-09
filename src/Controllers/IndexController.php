<?php

namespace App\Controllers;

use Framework\Injectables\Injector;
use Framework\Facades\RouterFacade;
use Framework\Alias\Request;
use Framework\Alias\Template;

class IndexController
{
    public function index()
    {
        Template::setAssign(["message" => "This is a new app"])->setDisplay("home.tpl");
    }
}
