<?php
class Cookie {
    
    public function __construct()
    {
        
    }
    
    public static function setCookie($name, $value = NULL, $expiry = NULL, $path = NULL, $domain = NULL, $secure = FALSE, $httponly = FALSE)
    {
        setcookie($name, $value, $expiry, $path);
    }
    
    public static function getCookie($cookie_name)
    {
        if(isset($_COOKIE[$cookie_name]))
        {
            return $_COOKIE[$cookie_name];
        }
    }
}

