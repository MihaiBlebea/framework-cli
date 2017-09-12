<?php

namespace Framework\RouterRules;

use Framework\Injectables\Injector;

class Rule
{
    public function next()
    {
        return $this;
    }
}
