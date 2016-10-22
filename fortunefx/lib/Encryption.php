<?php

class Encryption {
    
    
    public function __construct()
    {
        
    }
    
    public static function getPasswordHash($plain_text)
    {
        $bytes = substr(base64_encode(openssl_random_pseudo_bytes(32)), 0, 22);
        $salt = "$2y$12$" . $bytes;
        return crypt($plain_text, $salt);
    }
}

