<?php

namespace Framework\Payments;

use Framework\Interfaces\PaymentInterface;
use Framework\Injectables\Injector;
use Framework\Router\Request;
use Framework\Events\EventFactory;
use Framework\Listeners\ListenerFactory;
use Braintree\Configuration;
use Braintree\ClientToken;
use Braintree\Transaction;
use Braintree\Customer;
use Braintree\Subscription;
use Braintree\WebhookNotification;

class BraintreePayment implements PaymentInterface
{
    public $name = "Braintree";

    private $config;

    private $notificationType;

    public function __construct()
    {
        $this->config = Injector::resolve("Config");
        $config = $this->config->getConfig("payment");

        Configuration::environment($config['Braintree']['environment']);
        Configuration::merchantId($config['Braintree']['merchantId']);
        Configuration::publicKey($config['Braintree']['publicKey']);
        Configuration::privateKey($config['Braintree']['privateKey']);
    }

    public function generateToken()
    {
        return ClientToken::generate();
    }

    public function simplePay(array $payload)
    {
        $result = Transaction::sale([
            'amount'             => $payload["price"],
            'paymentMethodNonce' => $payload["paymentNonce"],
            'options'            => ['submitForSettlement' => true],
            'customer'           => [
                'firstName' => $payload["firstName"],
                'lastName'  => $payload["lastName"],
                'phone'     => $payload["phone"],
                'email'     => $payload["email"]
            ]
        ]);

        if($result->success)
        {
            return $result->transaction->id;
        } else {
            throw new Exception("Simple payment could not be processed", 1);
        }
    }

    public function recursivePay(array $payload)
    {
        $payment_token = $this->createCustomer($payload);

        $result = Subscription::create([
            'paymentMethodToken' => $payment_token,
            'planId'             => $payload["productId"],
            'merchantAccountId'  => $this->config->getConfig("payment")['braintree']['merchantAccountId']
        ]);

        if($result->success)
        {
            return $result->subscription->transactions[0]->id;
        } else {
            throw new Exception("Recursive payment could not be processed", 1);
        }
    }

    public function createCustomer(array $payload)
    {
        $customer = Customer::create([
            'customFields'       => ['username' => $payload["username"],
                                     'plan_tag' => $payload["productId"]
                                    ],
            'firstName'          => $payload["firstName"],
            'lastName'           => $payload["lastName"],
            'phone'              => $payload["phone"],
            'email'              => $payload["email"],
            'paymentMethodNonce' => $payload["paymentNonce"]
        ]);

        if ($customer->success)
        {
            return $customer->customer->paymentMethods[0]->token;
        } else {
            $message = "";
            foreach($customer->errors->deepAll() AS $error)
            {
                $message .= $error->code . ": " . $error->message . "\n";
            }
            throw new Exception("Customer could not be created: " . $message, 1);
        }
    }

    public function webhook(Request $request)
    {
        $webhook = WebhookNotification::parse($request->out('bt_signature'),
                                              $request->out('bt_payload'));
        $this->notificationType = $webhook->kind;

        if($this->notificationType == "subscription_charged_successfully")
        {
            $customer_id = $webhookNotification->subscription->transactions[0]->customerDetails->id;
            $this->getUserFromSubscription($customer_id);
        }

        if($notification_type == "subscription_charged_unsuccessfully")
        {

        }
    }

    private function getUserFromSubscription($customer_id)
    {
        $customer = Customer::find($customer_id);

        $username = $customer->customFields['username'];
        $tag = $customer->customFields['plan_tag'];

        $event = EventFactory::build("recursivePaymentSuccess", "framework");
        $emailListener = ListenerFactory::build("EmailToAdminSuccessfullRecursivePayment");
        $logListener = ListenerFactory::build("LogSuccessfullRecursivePayment");
        $event->attach($emailListener)->attach($logListener)->trigger([
            "type"        => "success",
            "username"    => $username,
            "program_tag" => $tag
        ]);
    }
}
