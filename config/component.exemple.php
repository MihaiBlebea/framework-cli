<?php

return [
    "components" => [

        "Config"    => Framework\Injectables\ConfigComponent::class,
        "Request"   => Framework\Injectables\RequestComponent::class,
        "Template"  => Framework\Injectables\TemplateComponent::class,
        "Whoops"    => Framework\Injectables\WhoopsComponent::class,
        "Login"     => Framework\Injectables\LoginComponent::class,
        "Connector" => Framework\Injectables\ConnectorComponent::class,
        "Email"     => Framework\Injectables\EmailComponent::class,
        "Payment"   => Framework\Injectables\PaymentComponent::class,
        "Validator" => Framework\Injectables\ValidatorComponent::class,

        "Router"    => Framework\Injectables\RouterComponent::class

    ],

    "alias" => [

        "Request"   => Framework\Router\Request::class,
        "Router"    => Framework\Router\Router::class,
        "Template"  => Framework\Templates\TemplateEngine::class,
        "Payment"   => Framework\Payments\Payment::class,
        "Validator" => Framework\Validators\Validator::class,

    ]
];
