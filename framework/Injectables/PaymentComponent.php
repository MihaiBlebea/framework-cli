<?php

namespace Framework\Injectables;

use Framework\Injectables\Injector;
use Framework\Interfaces\ComponentInterface;
use Framework\Configs\Config;
use Framework\Payments\Payment;

class PaymentComponent extends Injector implements ComponentInterface
{
    public function boot()
    {
        self::register('Payment', function() {
            $config  = new Config();
            $payment = new Payment($config);
            $payment->initPayment();
            return $payment->initPayment();
        });
    }

    public function run($instance)
    {

    }
}
