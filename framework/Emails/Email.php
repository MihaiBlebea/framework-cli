<?php

namespace Framework\Emails;

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

class Email
{
    public $mail;

    private $subject;
    private $htmlBody;
    private $textBody;
    private $address;

    public function __construct(PHPMailer $mail)
    {
        $this->mail = $mail;
        $this->mail->isHTML(true);
    }

    public function setErrorLevel(int $number)
    {
        if($number >  0 && $number < 10)
        {
            $this->mail->SMTPDebug = $number;
        }
    }

    public function setFrom($name, $email)
    {
        $this->mail->setFrom($email, $name);
    }

    public function setReply($name, $email)
    {
        $this->mail->addReplyTo($email, $name);
    }

    public function setHtmlEmail(bool $bool)
    {
        $this->mail->isHTML($bool);
    }

    public function testEmail()
    {
        return $this->mail;
    }

    public function subject($subject)
    {
        return $this->subject = $subject;
    }

    public function htmlBody($body)
    {
        return $this->htmlBody = $body;
    }

    public function textBody($body)
    {
        return $this->textBody = $body;
    }

    public function setAddress($address)
    {
        return $this->address = $address;
    }

    public function send()
    {
        $this->mail->addAddress($this->address);
        $this->mail->Subject = $this->subject;
        $this->mail->Body = $this->htmlBody;
        $this->mail->AltBody = $this->textBody;

        if(!$this->mail->send())
        {
            dd($this->mail->ErrorInfo);
            return false;
        } else {
            return true;
        }
    }
}
