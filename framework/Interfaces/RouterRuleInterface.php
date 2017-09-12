<?php

namespace Framework\Interfaces;

/**
 *
 */
interface RouterRuleInterface
{
    public function apply();

    public function fail();

}
