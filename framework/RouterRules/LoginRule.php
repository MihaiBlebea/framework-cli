<?php

namespace Framework\RouterRules;

use Framework\Interfaces\RouterRuleInterface;
use Framework\Injectables\Injector;
use Framework\RouterRules\Rule;

class LoginRule extends Rule implements RouterRuleInterface
{
    public static function apply($params = null)
    {
        if(true)
        {
            $this->next();
        }
    }

    public static function fail()
    {
        dd("failed rule");
    }
}
