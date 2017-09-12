<?php

namespace Framework\Interfaces;

/**
 *
 */
interface ComponentInterface
{
    public function boot();

    public function run($instance);

}
