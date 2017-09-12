<?php

namespace Framework\Emails;

use Framework\Interfaces\EmailInterface;
use Framework\Injectables\Injector;

class SuccessRecursivePaymentToAdminEmail implements EmailInterface
{
    public static function send($message)
    {
        $email = Injector::resolve("Email");
        $email->subject("Hey Admin");
        $email->htmlBody("A new recursive payment went throught with success.
                          Here is the full message: <br />" . json_encode($message);
        $email->setAddress("mihaiserban.blebea@gmail.com");
        $email->send();
    }
}
