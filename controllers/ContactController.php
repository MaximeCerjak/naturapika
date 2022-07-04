<?php

namespace Controllers;

class ContactController
{
    private $send = false;
    private $failSend = false;
    
     public function displayFormContact()
    {
        $headerView = 'general_header.phtml';
        $view = 'formContact.phtml';
        include_once 'views/layout.phtml';
    }
    
    public function sendMessage()
    {
        if( isset( $_POST["name"] ) && !empty( $_POST["name"] ) 
        && isset( $_POST["subject"] ) && !empty( $_POST["subject"] ) 
        && isset(  $_POST["email"]) && !empty( $_POST["email"] ) 
        && isset( $_POST["message"] ) && !empty( $_POST["message"] ) )
        {
            $name = htmlspecialchars( $_POST["name"] );
            $subject = htmlspecialchars( $_POST["subject"] );
            $email = filter_var($_POST['email'], FILTER_VALIDATE_EMAIL);
            $message = htmlspecialchars( $_POST["message"] );
            $wrapMessage = wordwrap($message, 70, "\r\n");
            $to = "maxpro.cerjak@gmail.com";
            $additional_headers = array('From' => $email);
            
            if(mail($to, $subject, $wrapMessage, $additional_headers))
            {
                $this->send = true;
                $this->displayFormContact();
            }
            else
            {
                $this->failSend = true;
                $this->displayFormContact();
            }
            
            
        }
        
    }
}