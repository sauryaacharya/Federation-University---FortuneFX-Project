<?php
class AdminModel extends Model {
    
    public function __construct() {
        parent::__construct();
        $this->authentication = Registry::getObject("authentication");
    }
    
    public function getOrderTransDet()
    {
        if($this->authentication->isLoggedIn())
        {
            if($this->authentication->isAdmin())
            {
               $sql = "SELECT SUM(tr_o.amount) AS total, tr.date FROM transaction AS tr, transaction_order AS tr_o WHERE tr.transaction_id = tr_o.transaction_id GROUP BY date ORDER BY date DESC";
               $this->dbObject()->executeQuery($sql);
               $rows = $this->dbObject()->getRows();
               
               $column = "['Date', 'Units Traded']";
               $row = "";
               
               for($i = 1; $i < (count($rows) + 1); $i++){
                   $row .= "['{$rows[$i - 1]["date"]}', {$rows[$i-1]["total"]}],";
               }
               $row = rtrim($row, ",");
               $row = "[{$column},{$row}]";
               return $row;
            }
            
        }
    }
    public function getTopFiveActiveCust()
    {
        if($this->authentication->isLoggedIn())
        {
            if($this->authentication->isAdmin())
            {
               $sql = "SELECT SUM(tr_o.amount) AS total, CONCAT(u.first_name,' ', u.middle_name, ' ', u.last_name, ', ID: ', u.user_id) AS name FROM transaction AS tr, transaction_order AS tr_o, users AS u WHERE tr.transaction_id = tr_o.transaction_id AND tr.user_id = u.user_id GROUP BY tr.user_id ORDER BY total DESC LIMIT 0, 5";
               $this->dbObject()->executeQuery($sql);
               $rows = $this->dbObject()->getRows();
               
               $column = "['Customer', 'Units Traded']";
               $row = "";
               
               for($i = 1; $i < (count($rows) + 1); $i++){
                   $row .= "['{$rows[$i - 1]["name"]}', {$rows[$i-1]["total"]}],";
               }
               $row = rtrim($row, ",");
               $row = "[{$column},{$row}]";
               return $row;
            }
            
        }
    }
    
    public function getTopFiveTradedByUnits()
    {
        if($this->authentication->isLoggedIn())
        {
            if($this->authentication->isAdmin())
            {
               $sql = "SELECT SUM(amount) as units, product FROM transaction_order GROUP BY product ORDER BY units DESC LIMIT 0, 5";
               $this->dbObject()->executeQuery($sql);
               $rows = $this->dbObject()->getRows();
               
               $column = "['Pair', 'Units Traded']";
               $row = "";
               
               for($i = 1; $i < (count($rows) + 1); $i++){
                   $row .= "['{$rows[$i - 1]["product"]}', {$rows[$i-1]["units"]}],";
               }
               $row = rtrim($row, ",");
               $row = "[{$column},{$row}]";
               return $row;
            }
            
        }
    }
    
    public function getUserDensByCountry()
    {
        if($this->authentication->isLoggedIn())
        {
            if($this->authentication->isAdmin())
            {
               $sql = "SELECT COUNT(user_id) AS total, country FROM users GROUP BY country";
               $this->dbObject()->executeQuery($sql);
               $rows = $this->dbObject()->getRows();
               
               $column = "['Country', 'Customer']";
               $row = "";
               
               for($i = 1; $i < (count($rows) + 1); $i++){
                   $row .= "['{$rows[$i - 1]["country"]}', {$rows[$i-1]["total"]}],";
               }
               $row = rtrim($row, ",");
               $row = "[{$column},{$row}]";
               return $row;
            }
            
        }
        
    }
    
    public function getVisitByBrowser()
    {
        if($this->authentication->isLoggedIn())
        {
            if($this->authentication->isAdmin())
            {
               $sql = "SELECT count(visit_id) AS visit, browser FROM user_visit GROUP BY browser LIMIT 0, 5";
               $this->dbObject()->executeQuery($sql);
               $rows = $this->dbObject()->getRows();
               
               $column = "['Browser', 'visit']";
               $row = "";
               
               for($i = 1; $i < (count($rows) + 1); $i++){
                   $row .= "['{$rows[$i - 1]["browser"]}', {$rows[$i-1]["visit"]}],";
               }
               $row = rtrim($row, ",");
               $row = "[{$column},{$row}]";
               return $row;
            }
            
        }
        
    }
    
    public function getVisitByPlatform()
    {
        if($this->authentication->isLoggedIn())
        {
            if($this->authentication->isAdmin())
            {
               $sql = "SELECT count(visit_id) AS visit, platform FROM user_visit GROUP BY platform LIMIT 0, 5";
               $this->dbObject()->executeQuery($sql);
               $rows = $this->dbObject()->getRows();
               
               $column = "['Platform', 'visit']";
               $row = "";
               
               for($i = 1; $i < (count($rows) + 1); $i++){
                   $row .= "['{$rows[$i - 1]["platform"]}', {$rows[$i-1]["visit"]}],";
               }
               $row = rtrim($row, ",");
               $row = "[{$column},{$row}]";
               return $row;
            }
            
        }
        
        
    }
}