<?php

namespace Framework\Interfaces;

interface PaymentInterface
{
    public function __construct();

    public function simplePay(array $payload);

    public function recursivePay(array $payload);
}
