<?php

namespace App\Emails;

use Framework\Interfaces\EmailInterface;
use Framework\Injectables\Injector;

class HelloEmail implements EmailInterface
{
    public function send()
    {
        $email = Injector::resolve("Email");
        $email->subject("Hello");
        $email->htmlBody("How are you?");
        $email->setAddress("exemple@gmail.com");
        $email->send();
    }
}
