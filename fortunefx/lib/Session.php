<?php
class Session {
    
    public function __construct() {
        
    }
    
    public static function initSession()
    {
        if(!isset($_SESSION))
        {
        session_start();
        }
    }
    
    public static function setSession($key, $value)
    {
        $_SESSION[$key] = $value;
    }
    
    public static function getSession($key)
    {       if(isset($_SESSION[$key]))
    {
            return $_SESSION[$key];
    }
    }
    
    public static function destroy()
    {
        
        session_unset();
        session_destroy();
        
    }
}

