<?php
class Authentication {
    
    private $logged_in = FALSE;
    private $user_id;
    private $username;
    private $just_processed = FALSE;
    private $admin = FALSE;
    private $active = TRUE;
    private $balance;
    
    
    public function __construct()
    {
   
    }
    
    public function isLoggedIn()
    {
        return $this->logged_in;
    }
    
    public function checkForAuthentication()
    {
        
        if(isset($_SESSION["authentication"]) && intval($_SESSION["authentication"]) > 0)
        {
            $user_id = Registry::getObject("db")->sanitizeInput($_SESSION["authentication"]);
            $this->sessionAuthenticate(intval($user_id));
        }
         
        else if(isset($_POST["email_id"]) && isset($_POST["password"]))
        {
            $username = Registry::getObject("db")->sanitizeInput($_POST["email_id"]);
            $password = Registry::getObject("db")->sanitizeInput($_POST["password"]);
            $this->postAuthenticate($username, $password);
        }
    }
    
    public function sessionAuthenticate($user_id)
    {
        $session_check_sql = "SELECT * FROM users WHERE user_id = {$user_id}";
        Registry::getObject("db")->executeQuery($session_check_sql);
        if(Registry::getObject("db")->getNumRows() === 1)
        {
            $user_data = Registry::getObject("db")->getRows();
            
            if($user_data[0]["is_active"] == 0)
            {
                $this->logged_in = FALSE;
                $this->active = FALSE;
            }
            else
            {
                $this->logged_in = TRUE;
                $this->user_id = $user_data[0]["user_id"];
                $this->username = $user_data[0]["first_name"];
                $this->balance = $user_data[0]["account_balance"];
                $this->admin = ($user_data[0]["is_admin"] == 1) ? TRUE : FALSE;
            }
        }
        else
        {
            $this->logged_in = FALSE;
            if($this->logged_in === FALSE)
            {
                $this->logout();
            }
        }
    }
     
    
    public function postAuthenticate($username, $password)
    {
        $this->just_processed = TRUE;
        $check_user_sql = "SELECT * FROM users WHERE email_id = '{$username}'";
        Registry::getObject("db")->executeQuery($check_user_sql);
        if(Registry::getObject("db")->getNumRows() == 1)
        {
            $user_data = Registry::getObject("db")->getRows();
            $db_password = $user_data[0]["password"];
            $hash_given = crypt($password, $db_password);
            
            if($user_data[0]["is_active"] == 0)
            {
                $this->logged_in = FALSE;
                $this->active = FALSE;
            }
            else
            {
                if($db_password === $hash_given)
                {
                    $this->logged_in = TRUE;
                    $this->user_id = $user_data[0]["user_id"];
                    $this->username = $user_data[0]["first_name"];
                    $this->balance = $user_data[0]["account_balance"];
                    $this->admin = ($user_data[0]["is_admin"] == 1) ? TRUE : FALSE;
                    $_SESSION["authentication"] = $user_data[0]["user_id"];
                }
            }
        }
        else
        {
            $this->logged_in = FALSE;  
        }
    }
    
    public function isActive()
    {
        return $this->active;
    }
    
    public function getUserId()
    {
        return $this->user_id;
    }
    
    public function getUsername()
    {
        return $this->username;
    }
    
    public function isAdmin()
    {
        return $this->admin;
    }
    
    public function getBalance()
    {
        return $this->balance;
    }
    
    public function logout()
    {
        unset($_SESSION["authentication"]);
    }
    
    
}