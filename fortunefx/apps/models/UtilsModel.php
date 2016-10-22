<?php
class UtilsModel extends Model {
    
    public function __construct() {
        parent::__construct();
    }
    
    public function isEmailExists($email)
    {
        $signupModel = new SignupModel();
        return !$signupModel->checkEmail($email);
    }
    
    public function generateToken($email)
    {
        return base64_encode(md5($email . time()));
    }
    
    public function setPasswordRecoveryToken($token, $email)
    {
        $token_id = $this->dbObject()->sanitizeInput($token);
        $email_id = $this->dbObject()->sanitizeInput($email);
        $user_id = $this->dbObject()->sanitizeInput($this->getUidByEmail($email_id));
        $time = $this->dbObject()->sanitizeInput($_SERVER["REQUEST_TIME"]);
        $sql = "INSERT INTO user_password_reset (user_id, token, time) VALUES({$user_id}, '{$token_id}', {$time})";
        $this->dbObject()->executeQuery($sql);
    }
    
    private function getUidByEmail($email)
    {
        $sql = "SELECT user_id FROM users WHERE email_id = '{$email}'";
        $this->dbObject()->executeQuery($sql);
        return $this->dbObject()->getRows()[0]["user_id"];
    }
    
    public function sendPasswordRecoveryEmail($token, $email)
    {
        $to = htmlentities($email);
        $subject = "Fortune Fx - Password Recovery Email";
        $msg = "
               <html>
               <head>
               </head>
               <title>
               </title>
               <body>
               Your password recovery link will expire in 2 hours. Please follow the link below to reset your password. <br/>
               <a href='#'>http://localhost/fortunefx/utils/passwordrecovery/{$token}</a>
               </body>
               </html>
               ";
        $headers = "MIME-Version: 1.0" . "\r\n";
        $headers .= "Content-type: text/html;charset=UTF-8" . "\r\n";
        $headers .= "Reply-To: <info@fortunefx.com.au>" . "\r\n";
        $headers .= "Return-Path: <info@fortunefx.com.au>" . "\r\n";
        $headers .= "From: <info@fortunefx.com.au>" . "\r\n";
        $headers .= "X-Priority: 3" . "\r\n";
        $headers .= "X-Mailer: PHP" . phpversion() . "\r\n";
        mail($to, $subject, $msg, $headers);   
    }
    
    public function changePassword($token, $password)
    {
        $token_id = $this->dbObject()->sanitizeInput($token);
        $hashed_password = Encryption::getPasswordHash($this->dbObject()->sanitizeInput($password));
        $sql = "UPDATE users SET password = '{$hashed_password}' WHERE user_id = (SELECT user_id FROM user_password_reset WHERE token = '{$token}')";
        $this->dbObject()->executeQuery($sql);
    }
    
    public function isTokenExists($token)
    {
        $exists = false;
        $token_id = $this->dbObject()->sanitizeInput($token);
        $sql = "SELECT * FROM user_password_reset WHERE token = '{$token_id}'";
        $this->dbObject()->executeQuery($sql);
        if($this->dbObject()->getNumRows() == 1)
        {
            $exists = true;
        }
        return $exists;
    }
    
    public function deleteResetToken($token)
    {
        $token_id = $this->dbObject()->sanitizeInput($token);
        $sql = "DELETE FROM user_password_reset WHERE token = '{$token_id}'";
        $this->dbObject()->executeQuery($sql);
    }
    
    public function isTokenExpire($token)
    {
        $expire = false;
        $valid_time = 7200;
        $token_id = $this->dbObject()->sanitizeInput($token);
        $current_time = $_SERVER["REQUEST_TIME"];
        $sql = "SELECT * FROM user_password_reset WHERE token = '{$token_id}'";
        $this->dbObject()->executeQuery($sql);
        $token_created_time = $this->dbObject()->getRows()[0]["time"];
        if($current_time - $token_created_time > $valid_time)
        {
            $expire = true;
            $update_expiry = "UPDATE user_password_reset SET expire = 1 WHERE token = '{$token_id}'";
            $this->dbObject()->executeQuery($update_expiry);
        }
        return $expire;
    }
}

