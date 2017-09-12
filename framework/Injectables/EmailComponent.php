<?php

namespace Framework\Injectables;

use Framework\Injectables\Injector;
use Framework\Interfaces\ComponentInterface;
use Framework\Configs\Config;
use Framework\Emails\Email;
use PHPMailer\PHPMailer\PHPMailer;

class EmailComponent extends Injector implements ComponentInterface
{
    public function boot()
    {
        self::register('Email', function() {
            $config = new Config();
            $config = $config->getConfig('email');

            $mail = new PHPMailer();
            $mail->isSMTP();
            $mail->SMTPDebug = 0;
            $mail->Host = $config['host'];
            $mail->SMTPAuth = true;
            $mail->Username = $config['username'];
            $mail->Password = $config['password'];
            $mail->SMTPSecure = 'tsl';
            $mail->Port = $config['port'];
            $mail->isHTML(true);
            $mail->setFrom($config['send_email'], $config['send_name']);

            $email = new Email($mail);
            return $email;
        });
    }

    public function run($instance)
    {

    }
}
