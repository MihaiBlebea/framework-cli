<?php

namespace Framework\Injectables;

use Framework\Injectables\Injector;
use Framework\Interfaces\ComponentInterface;
use Framework\Validators\Validator;
use Framework\Router\Request;

class ValidatorComponent extends Injector implements ComponentInterface
{
    public function boot()
    {
        self::register('Validator', function() {
            $request   = new Request();
            $validator = new Validator($request);
            return $validator;
        });
    }

    public function run($instance)
    {

    }
}
