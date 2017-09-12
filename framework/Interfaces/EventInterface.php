<?php

namespace Framework\Interfaces;

interface EventInterface
{
    public function attach($listener);

    public function trigger($payload);

    public function notify();
}
