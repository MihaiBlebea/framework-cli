<?php

namespace Framework\Injectables;

use Framework\Injectables\Injector;
use Framework\Interfaces\ComponentInterface;
use Whoops\Run;
use Whoops\Handler\PrettyPageHandler;

class WhoopsComponent extends Injector implements ComponentInterface
{
    public function boot()
    {
        self::register('Whoops', function() {
            $whoops = new Run();
            $whoops->pushHandler(new PrettyPageHandler);
            return $whoops;
        });
    }

    public function run($instance)
    {
        $instance->register();
    }
}
