<?php
include "Database.php";
include "MysqlDatabase.php";
class VisitorAnalytics {
    
    private $db;
    
    public function __construct()
    {
        $this->db = new MysqlDatabase();
    }
    
    public function processVisitorAnalytics()
    {
            $browser = new BrowserDetection();
            $browser_name = $browser->getName();
            $platform = $browser->getPlatform();
            //print_r($platform);
            $insert_visitor_det = "INSERT INTO user_visit (platform, browser) VALUES('{$platform}', '{$browser_name}')";
            $this->db->executeQuery($insert_visitor_det);  
    }
}

