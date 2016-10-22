<?php
//require_once(BASE_PATH . DS . "config" .DS. "config.php");

class MysqlDatabase extends Database {
    
    private $con;
    private $query_result;
    private $last_id;
    
    public function __construct() {
        parent::__construct();
        $this->connect();
    }
    
    public function connect() {
        
        $this->con = new mysqli("localhost", "fortune_fx", "fxfortune123", "fortunefx");
        if($this->con->connect_error)
        {
            die("Connection failed: " . $this->con->connect_error);
        }
    }
    
    public function closeConnection()
    {
        $this->con->close();
    }
    
    public function dbConnection()
    {
        return $this->con;
    }
    
    public function sanitizeInput($data)
    {
        return $this->con->real_escape_string($data);
    }
    
    public function executeQuery($query_statement)
    {
            if(!($result = $this->con->query($query_statement)))
            {
                trigger_error("Error executing query: " . E_USER_ERROR);
            }
            else
            {
              $this->query_result = $result;  
            }
    }
    
    public function getRows()
    {
        return $this->query_result->fetch_all(MYSQLI_ASSOC);
    }
    
    public function getNumRows()
    {
        return $this->query_result->num_rows;
    }
    
    public function getLastId()
    {
        $this->last_id = $this->con->insert_id;
        return $this->last_id;
    }
}
