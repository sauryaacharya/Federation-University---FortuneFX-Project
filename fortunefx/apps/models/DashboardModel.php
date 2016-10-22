<?php
class DashboardModel extends Model {
    
    public function __construct() {
        parent::__construct();
    }
    
    public function getCardDetail()
    {
        $user_id = $this->dbObject()->sanitizeInput($_SESSION["authentication"]);
        $card_detail_sql = "SELECT * FROM user_card_detail WHERE user_id = {$user_id}";
        $this->dbObject()->executeQuery($card_detail_sql);
        return $this->dbObject()->getRows();
    }
    
    public function getUserDetail()
    {
        $user_id = $this->dbObject()->sanitizeInput($_SESSION["authentication"]);
        //$user_detail_sql = "SELECT * FROM users WHERE user_id = {$user_id}";
        $user_detail_sql = "SELECT title_salute, first_name, middle_name, last_name, date_of_birth, phone, country, address_1, address_2, state, suburb, post_code, email_id, account_balance FROM users WHERE user_id = {$user_id}";
        $this->dbObject()->executeQuery($user_detail_sql);
        return $this->dbObject()->getRows();
    }
    
    public function getDepositTransactions()
    {
        $user_id = $this->dbObject()->sanitizeInput($_SESSION["authentication"]);
        $dep_tran_sql = "SELECT tr.confirmation_number, tr.date, td.amount, td.description FROM transaction AS tr, transaction_deposit AS td WHERE tr.transaction_id = td.transaction_id AND tr.transaction_type_id = td.deposit_type_id AND tr.user_id = {$user_id}";
        $this->dbObject()->executeQuery($dep_tran_sql);
        return $this->dbObject()->getRows();
    }
}

