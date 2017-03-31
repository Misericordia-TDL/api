<?php
/**
 * Copyright (c) 2017. This file belongs to Misericordia di "Torre del lago Puccini"
 */

namespace App\Email;

use PHPMailer;

/**
 * Class EmailService
 * @package App\Email
 */
class EmailService extends PHPMailer
{

    /**
     * EmailService constructor.
     * @param array $config
     */
    public function __construct(array $config)
    {
        parent::__construct();
        $this->Host = $config['host'];
        $this->isSMTP();
        $this->Port = 587;
        $this->SMTPSecure = 'tls';
        $this->Username = $config['user_name'];
        $this->Password = $config['user_password'];
        $this->SMTPAuth = true;
    }

    /**
     * @param $body
     * @param $email
     * @param $name
     */
    public function sendResetPasswordEmail($body, $email, $name)
    {
        //Set who the message is to be sent from
        $this->FromName = 'Misericordia Torre del lago';
        //Set who the message is to be sent to
        $this->addAddress($email, $name);
        //email subject
        $this->Subject = 'Misericordia accoglienza - Reset Passord';
        //set email body message
        $this->msgHTML($body);
        //override xmailer header
        $this->XMailer = ' ';

        if (!$this->send()) {
            throw new \LogicException('Email not sent to ' . $email . ' because: ' . $this->ErrorInfo);
        }
    }

}