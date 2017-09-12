<?php

namespace Framework\Emails;

use Framework\Interfaces\EmailInterface;
use Framework\Injectables\Injector;

class ErrorToAdminEmail implements EmailInterface
{
    public static function send($message)
    {
        $email = Injector::resolve("Email");
        $email->subject("Hey Admin");
        $email->htmlBody("There is a new error you need to check.
                          Here is the full message: <br />" . $message);
        $email->setAddress("mihaiserban.blebea@gmail.com");
        $email->send();
    }
}
