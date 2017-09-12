<?php

namespace Framework\Payments;

use Framework\Configs\Config;

class Payment
{
    private $config;

    public $gateway;

    private $paymentResult = null;

    public function __construct(Config $config)
    {
        $this->config = $config;
        $this->gateway = $this->getPayment();
        return $this->initPayment();
    }

    public function getPayment()
    {
        return $this->config->getConfig("payment")["usePayment"];
    }

    public function initPayment()
    {
        $namespace = "Framework\\Payments\\" . ucfirst($this->gateway) . "Payment";

        if(class_exists($namespace))
        {
            return new $namespace();
        } else {
            throw new \Exception('Payment class not found.');
        }
    }

}
