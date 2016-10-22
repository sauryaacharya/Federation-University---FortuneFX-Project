<?php
class SignupModel extends Model {
    
    public function __construct() {
        parent::__construct();
    }
    
    public function getSecurityQuestions()
    {
        $sec_sql_query = "SELECT * FROM security_questions";
        $this->dbObject()->executeQuery($sec_sql_query);
        return $this->dbObject()->getRows();
    }
    
    public function checkEmail($email)
    {
        $valid = true;
        $sanitized_email = $this->dbObject()->sanitizeInput($email);
        $check_user = "SELECT * FROM users WHERE email_id = '{$sanitized_email}'";
        $this->dbObject()->executeQuery($check_user);
        if($this->dbObject()->getNumRows() !== 0)
        {
            $valid = false;
        }
        return $valid;
    }
    
    public function registerUser()
    {
        $step1_info = $_SESSION["reg_step_1"];
        $step2_info = $_SESSION["reg_step_2"];
        $step3_info = $_SESSION["reg_step_3"];
        $title_salute = $this->dbObject()->sanitizeInput($step1_info["title_salute"]);
        $first_name = $this->dbObject()->sanitizeInput($step1_info["first_name"]);
        $middle_name = $this->dbObject()->sanitizeInput($step1_info["middle_name"]);
        $last_name = $this->dbObject()->sanitizeInput($step1_info["last_name"]);
        $date_of_birth_arr = explode("/", $this->dbObject()->sanitizeInput($step1_info["dob"]));
        $date_of_birth = $date_of_birth_arr[2]."-".$date_of_birth_arr[0]."-".$date_of_birth_arr[1];
        $phone = $this->dbObject()->sanitizeInput($step1_info["phone"]);
        $country = $this->dbObject()->sanitizeInput($step1_info["country"]);
        $add1 = $this->dbObject()->sanitizeInput($step1_info["add1"]);
        $add2 = $this->dbObject()->sanitizeInput($step1_info["add2"]);
        $state = $this->dbObject()->sanitizeInput($step1_info["state"]);
        $suburb = $this->dbObject()->sanitizeInput($step1_info["suburb"]);
        $post_code = $this->dbObject()->sanitizeInput($step1_info["postcode"]);
        $currency = $this->dbObject()->sanitizeInput($step1_info["currency"]);
        
        $email = $this->dbObject()->sanitizeInput($step2_info["email_id"]);
        $password = Encryption::getPasswordHash($this->dbObject()->sanitizeInput($step2_info["password"]));
        $sec_question_id = $this->dbObject()->sanitizeInput($step2_info["security_question"]);
        $answer = $this->dbObject()->sanitizeInput($step2_info["answer"]);
        
        $name = $this->dbObject()->sanitizeInput($step3_info["holder_name"]);
        $number = $this->dbObject()->sanitizeInput($step3_info["card_number"]);
        $ccv = $this->dbObject()->sanitizeInput($step3_info["ccv"]);
        $expiry = $this->dbObject()->sanitizeInput($step3_info["expiry"]);
        $card_type = $this->dbObject()->sanitizeInput($step3_info["card_type"]);
        
        $insert_user_info = "INSERT INTO users (title_salute, first_name, middle_name, last_name, date_of_birth, phone, country, address_1, address_2, state, suburb, post_code, base_currency, email_id, password)
                             VALUES('{$title_salute}', '{$first_name}', '{$middle_name}', '{$last_name}', '{$date_of_birth}', '{$phone}', '{$country}', '{$add1}', '{$add2}', '{$state}', '{$suburb}', '{$post_code}', '{$currency}', '{$email}', '{$password}');
                            ";
        $this->dbObject()->executeQuery($insert_user_info);
        
        $get_uid = "SELECT user_id FROM users WHERE email_id = '{$email}'";
        $this->dbObject()->executeQuery($get_uid);
        $user_id = $this->dbObject()->getRows()[0]["user_id"];
        
        $insert_sec_question = "INSERT INTO user_security_answer (q_id, user_id, answer) VALUES ({$sec_question_id}, {$user_id}, '{$answer}')";
        $this->dbObject()->executeQuery($insert_sec_question);
        
        $insert_card_detail = "INSERT INTO user_card_detail (card_holder_name, card_number, ccv, expiry, card_type, user_id) VALUES('{$name}', '{$number}', {$ccv}, '{$expiry}', '{$card_type}', {$user_id})";
        $this->dbObject()->executeQuery($insert_card_detail);
        
        $token = $this->generateEmailConfirmationToken();
        
        $insert_user_activation_key = "INSERT INTO user_activation (token, user_id) VALUES('{$token}', {$user_id})";
        $this->dbObject()->executeQuery($insert_user_activation_key);
        
        $this->sendConfirmationEmail($token, $_SESSION["reg_step_2"]["email_id"]);
    }
    
    private function generateEmailConfirmationToken()
    {
        return md5($_SESSION["reg_step_2"]["email_id"].time());
    }
    
    public function updateActivationToken($activation_token, $email)
    {
        $update_sql = "UPDATE user_activation SET token = '{$activation_token}' WHERE user_id = (SELECT user_id FROM users WHERE email_id = '{$email}')";
        $this->dbObject()->executeQuery($update_sql);
    }
    
    public function sendConfirmationEmail($activation_token, $email)
    {
        $to = $email;
        $subject = "Fortune Fx - Account Confirmation Email";
        $msg = "
               <html>
               <head>
               </head>
               <title>
               </title>
               <body>
               Thank you for registering with Fortune Fx. Please follow the link to activate your account. <br/>
               <a href='#'>http://localhost/fortunefx/signup/activate/{$activation_token}</a>
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
    
    public function activateAccount($token)
    {
        $activation_info_sql = "SELECT * FROM user_activation WHERE token = '{$token}'";
        $this->dbObject()->executeQuery($activation_info_sql);
        $activation_info = $this->dbObject()->getRows();
        
        $activate_user = "UPDATE users SET is_active = 1 WHERE user_id = {$activation_info[0]["user_id"]}";
        $this->dbObject()->executeQuery($activate_user);
        
        $delete_activation_token = "DELETE FROM user_activation WHERE user_id = {$activation_info[0]["user_id"]}";
        $this->dbObject()->executeQuery($delete_activation_token);
    }
    
    public function isValidToken($token)
    {
        $valid = false;
        $sql = "SELECT * FROM user_activation WHERE token = '{$token}'";
        $this->dbObject()->executeQuery($sql);
        if($this->dbObject()->getNumRows() == 1)
        {
            $valid = true;
        }
        return $valid;
    }
    
    public function isTokenExpired($token)
    {
        $expired = false;
        $sql = "SELECT * FROM user_activation WHERE token = '{$token}'";
        $this->dbObject()->executeQuery($sql);
        $expiry = $this->dbObject()->getRows()[0]["is_expire"];
        if($expiry == 1)
        {
            $expired = true;
        }
        return $expired;
    }
    
    public function isAccountActive($email_id)
    {
        $active = false;
        $sql = "SELECT * FROM users WHERE email_id = '{$email_id}'";
        $this->dbObject()->executeQuery($sql);
        $is_active = $this->dbObject()->getRows()[0]["is_active"];
        if($is_active == 1)
        {
            $active = true;
        }
        return $active;
    }
}