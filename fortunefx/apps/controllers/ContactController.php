<?php
class ContactController extends Controller {
    
    public function __construct(Registry $registry, Model $model) {
        parent::__construct($registry, $model);
        $this->registry->getObject("loader")->handler("Form");
        $this->validation_object = $this->registry->getObject("form_validation");
    }
    
    public function index()
    {
        if(isset($_POST["contact_submit_btn"]))
        {
            $this->validation_object->setValidationCheck("fullname", "callback__validateName", $this);
            $this->validation_object->setValidationCheck("email", "callback__validateEmail", $this);
            $this->validation_object->setValidationCheck("subject", "callback__validateSubject", $this);
            $this->validation_object->setValidationCheck("message", "callback__validateMessage", $this); 
        }
        
        $data["success_msg"] = "";
        
        if($this->validation_object->runValidator() !== FALSE)
        {
            $this->_sendMailForContact();
            $data["success_msg"] = "<div id='success_msg' style='font-family:Arial;color:#009900;font-size:13px;border:1px solid #eaeaea;padding:10px;background:#f2f2f2;'>Thanks for contacting us. We'll get back to you soon.</div>";
            
        }
        
        $data["title"] = "Contact Us";
        $this->view->render("templates/header", $data);
        $this->view->render("templates/main_page");
        $this->view->render("contact/index", $data);
        $this->view->render("templates/footer");   
    }
    
    public function _validateName($post_data)
    {
        if($this->validation_object->required($post_data) == TRUE)
        {
            $this->validation_object->setMasterFieldData("Please enter your name.", "first_name", "error");
        }
    }
    
    public function _validateEmail($post_data)
    {
        if($this->validation_object->required($post_data) == TRUE)
        {
            $this->validation_object->setMasterFieldData("Please enter the email.", "email", "error");
        }
        if($this->validation_object->valid_email($post_data) == FALSE)
        {
            $this->validation_object->setMasterFieldData("Please enter a valid email.", "email", "error");
        }
    }
    
    public function _validateSubject($post_data)
    {
        if($this->validation_object->required($post_data) == TRUE)
        {
            $this->validation_object->setMasterFieldData("Please enter the subject.", "subject", "error");
        }
    }
    
    public function _validateMessage($post_data)
    {
        if($this->validation_object->required($post_data) == TRUE)
        {
            $this->validation_object->setMasterFieldData("Please enter the message.", "message", "error");
        }
    }
    
    private function _sendMailForContact()
    {
        $full_name = htmlentities($_POST["full_name"]);
        $email = htmlentities($_POST["email"]);
        $subject = htmlentities($_POST["subject"]);
        $message = htmlentities($_POST["message"]);
        
        $to = "info@fortunefx.com.au";
        $msg = "Name: {$full_name} \r\n\n";
        $msg .= "Subject: {$subject} \r\n\n";
        $msg .= $message;
        
        $headers = "MIME-Version: 1.0" . "\r\n";
        $headers .= "Content-type: text/plain;" . "\r\n";
        $headers .= "Reply-To: <{$email}>" . "\r\n";
        $headers .= "Return-Path: <{$email}" . "\r\n";
        $headers .= "From: <{$email}>" . "\r\n";
        $headers .= "X-Priority: 3" . "\r\n";
        $headers .= "X-Mailer: PHP" . phpversion() . "\r\n";
        
        mail($to, $subject, $msg, $headers);
    }
    
}