<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

/**
 * Email Class
 *
 * @package		SMTP Email transport class
 * @depends		PHP Mailer Library & A SMTP Account
 * @subpackage          Libraries
 * @category            Email Sending
 * @author		Vinay Sachan <vinay@onlinephpstudy.com>
 * @copyright           Copyright (c) 2011-2016, OPS, & Copyright (c) 2016, DEWIOnline.
 * @license             Code licensed MIT
 * @link		 
 * @todo		SMTP needs accurate times, and the PHP time zone MUST be set.
 * 			This should be done in your php.ini, but this is how to do it
 * 			if you don't have access to that
 * 
 */
class Ops_Email {

    protected $CI;
    protected $econfig;
    private $data               =   [];    
    private $host               =   'ssl://smtp.zoho.com';
    private $username           =   'info@eindiavisa.in';
    private $password           =   'Pass@INFO';
    private $port               =   '465';

    public function __construct() {
        
    }

    public function __set($name, $value) {
        $this->data[$name]      =   $value;
    }

    public function __isset($name) {
        return isset($this->data[$name]);
    }

    public function __get($name) {
        if (array_key_exists($name, $this->data)) {
            return $this->data[$name];
        }
    }

    public function __email_template($tmp) {
        if (!empty($tmp)) {
            $this->CI = &get_instance();
            $email_data = $this->CI->setting_model->get_email_content($tmp);
            if (!empty($email_data)) {
                $this->content = $email_data['content'];
                if (empty($this->subject))
                    $this->subject = $email_data['subject'];
                return TRUE;
            }
        }
        return FALSE;
    }

    public function __send_mail() {
        $this->content = html_entity_decode($this->content);

        require_once APPPATH . "/third_party/PHPMailer/PHPMailerAutoload.php";
        $mail = new PHPMailer;
        $mail->isSMTP();
        $mail->SMTPDebug = 0;
        $mail->Debugoutput = 'html';
        $mail->Host = $this->host;
        $mail->Port = $this->port;
        $mail->SMTPAuth = true;
        $mail->Username = $this->username;
        $mail->Password = $this->password;
        $mail->setFrom($this->username, SITE_NAME);
        /**
         * Add Recipeint
         */
        if (is_array($this->__toEmail)) {
            foreach ($this->__toEmail as $k => $email) {
                if (!empty($this->__toName[$k]))
                    $mail->addAddress($email, $this->__toName[$k]);
                else
                    $mail->addAddress($email);
            }
        } else {
            if (!empty($this->__toName))
                $mail->addAddress($this->__toEmail, $this->__toName);
            else
                $mail->addAddress($this->__toEmail);
        }
        /**
         * Add Reply To
         */
        if ((!empty($this->addReplyTo)) && (!empty($this->addReplyToName))) {
            $mail->addReplyTo($this->addReplyTo, $this->addReplyToName);
        } elseif (!empty($this->addReplyTo)) {
            $mail->addReplyTo($this->addReplyTo);
        }

        /**
         * Add CC
         */
        if (!empty($this->addCC))
            $mail->addCC($this->addCC);
        /**
         * Add BCC
         */
        if (!empty($this->addBCC))
            $mail->addBCC($this->addBCC);

        $mail->Subject = $this->subject;
        $mail->WordWrap = 76;
        $mail->Body = $this->content;

        if (!empty($this->attach)) {
            if (is_array($this->attach)) {
                foreach ($this->attach as $attach) {
                    $mail->addAttachment($attach);
                }
            } else {
                $mail->addAttachment($this->attach);
            }
        }
        $mail->CharSet = "utf-8";
        $mail->isHTML(true);
        return $mail->send() ? TRUE : FALSE;
    }

}
