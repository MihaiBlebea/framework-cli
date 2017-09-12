<?php

namespace App\Components;

use Framework\Injectables\Injector;
use Framework\Interfaces\ComponentInterface;

class NewComponent extends Injector implements ComponentInterface
{
    public function boot()
    {
        self::register('New', function() {
            $comp = new New();
            return $comp;
        });
    }

    public function run($instance)
    {

    }
}
