<?php

class AjaxserviceModel extends Model {

    public function __construct() {
        parent::__construct();
        $this->authentication = Registry::getObject("authentication");
    }

    public function getLiveFxRate($pair = "") {
        $currency_rate_arr = array();
        $currency_arr_with_key = array();
        $currency_pair = array();
        if ($pair === "") {
            $currency_pair = array("AUDUSD", "AUDNZD", "AUDCAD", "AUDCHF", "AUDJPY", "CADCHF", "CADJPY",
                "CHFJPY", "EURAUD", "EURCAD", "EURCHF", "EURCZK", "EURDKK", "EURGBP",
                "EURJPY", "EURNOK", "EURNZD", "EURUSD", "GBPAUD", "GBPCAD",
                "GBPCHF", "GBPJPY", "GBPNZD", "GBPUSD", "NZDCAD", "NZDCHF", "NZDJPY",
                "NZDUSD", "SGDJPY", "USDCAD", "USDCHF", "USDCNH", "USDDKK", "USDHKD",
                "USDJPY", "USDNOK", "USDRUB", "USDSGD");
        } else if ($pair === "limit") {
            $currency_pair = array("AUDUSD", "AUDNZD", "AUDCAD", "AUDCHF", "AUDJPY");
        } else if (strpos($pair, ",") !== false) {
            $currency_pair = explode(",", $pair);
        } else {
            $currency_pair = array($pair);
        }
        $currency_string = "";
        foreach ($currency_pair as $pair) {
            $currency_string .= trim($pair) . "=X+";
        }

        $final_string = rtrim($currency_string, "+");

        $file = fopen("https://download.finance.yahoo.com/d/quotes.csv?s={$final_string}&f=snl1d1t1ab", "r");
        if ($file) {
            while (!feof($file)) {
                $currency_rate_arr[] = fgetcsv($file);
            }
        }
        fclose($file);

        for ($i = 0; $i < count(array_filter($currency_rate_arr)); $i++) {
            $currency_arr_with_key[] = array("id" => $currency_rate_arr[$i][0],
                "name" => $currency_rate_arr[$i][1],
                "rate" => $currency_rate_arr[$i][2],
                "date" => $currency_rate_arr[$i][3],
                "time" => $currency_rate_arr[$i][4],
                "buy" => $currency_rate_arr[$i][5],
                "sell" => $currency_rate_arr[$i][6],
                "spread" => abs(number_format(($currency_rate_arr[$i][6] - $currency_rate_arr[$i][5]) / $currency_rate_arr[$i][6] * 100, 4))
            );
        }
        return json_encode(array("live_rates" => $currency_arr_with_key), JSON_PRETTY_PRINT);
    }
    
    public function getByBrowser()
    {
        if($this->authentication->isLoggedIn())
        {
            if($this->authentication->isAdmin())
            {
               $sql = "SELECT count(visit_id) AS visit, browser FROM user_visit GROUP BY browser LIMIT 0, 5";
               $this->dbObject()->executeQuery($sql);
               $rows = $this->dbObject()->getRows();
               $data_arr[0] = array("counts", "browser");
               
               $column = "['visit', 'Browser']";
               $row = "";
               
               for($i = 1; $i < (count($rows) + 1); $i++){
                   //(int)$rows[$i - 1]["visit"], $rows[$i - 1]["browser"]);
                   $row .= "[{$rows[$i-1]["visit"]}, '{$rows[$i - 1]["browser"]}']";
               }
               
               $row = "[{$column}, {$row}]";
               echo $row;
            }
            
        }
    }
    
    public function getTotalVisitor()
    {
        if($this->authentication->isLoggedIn())
        {
            if($this->authentication->isAdmin())
            {
                $sql = "SELECT COUNT(visit_id) AS total_visit FROM user_visit";
                $this->dbObject()->executeQuery($sql);
                return json_encode(array("total_visit" => $this->dbObject()->getRows()[0]["total_visit"]));
            }
        }
    }
    
    public function blockUser()
    {
        if($this->authentication->isLoggedIn())
        {
            if($this->authentication->isAdmin())
            {
                $user_id = $this->dbObject()->sanitizeInput($_POST["user_id"]);
                $update_sql = "UPDATE users SET is_active = 0 WHERE user_id = {$user_id}";
                $this->dbObject()->executeQuery($update_sql);
                return json_encode(array("response"=>array("status"=>"success")));
            }
        }
    }
    
    public function unblockUser()
    {
        if($this->authentication->isLoggedIn())
        {
            if($this->authentication->isAdmin())
            {
                $user_id = $this->dbObject()->sanitizeInput($_POST["user_id"]);
                $update_sql = "UPDATE users SET is_active = 1 WHERE user_id = {$user_id}";
                $this->dbObject()->executeQuery($update_sql);
                return json_encode(array("response"=>array("status"=>"success")));
            }
        }
    }

    public function getCustomers()
    {
        if($this->authentication->isLoggedIn())
        {
            if($this->authentication->isAdmin())
            {
                //$cust_sql = "SELECT * FROM users";
                $cust_sql = "SELECT user_id, first_name, middle_name, last_name, date_of_birth, phone, country, address_1, address_2, state, suburb, post_code, email_id, created, is_active FROM users WHERE is_admin = 0";
                $this->dbObject()->executeQuery($cust_sql);
                $user_info = $this->dbObject()->getRows();
                //print_r($user_info);
                $final_user_array  = array();
                for($i = 0; $i < count($user_info); $i++)
                {
                    $user_id = $user_info[$i]["user_id"];
                $name = $user_info[$i]["first_name"] . " " . $user_info[$i]["middle_name"] . " " . $user_info[$i]["last_name"];
                $dob = $user_info[$i]["date_of_birth"];
                $phone = $user_info[$i]["phone"];
                $country = $user_info[$i]["country"];
                $address = $user_info[$i]["address_1"] . ", " . $user_info[$i]["address_2"] . ", " . $user_info[$i]["suburb"] . ", " . $user_info[$i]["state"] . ", " . $user_info[$i]["post_code"];
                $email = $user_info[$i]["email_id"];
                $created = $user_info[$i]["created"];
                $status = $user_info[$i]["is_active"] == 0 ? "Inactive" : "Active";
                $final_user_array [] = array("user_id" => $user_id, "name" => $name, "dob" => $dob, "phone" => $phone, "country" => $country, "address" => $address, "email" => $email, "created" => $created, "status" => $status);
                }
                return json_encode(array("users" => $final_user_array), JSON_PRETTY_PRINT);
            }
        }
    }
    
    public function getClosedOrders() {
        if ($this->authentication->isLoggedIn()) {
            if ($_SERVER["REQUEST_METHOD"] == "GET") {
                $user_id = $this->dbObject()->sanitizeInput($_SESSION["authentication"]);
                $order_tran_sql = "SELECT tr.transaction_id, tr.confirmation_number, tr.date, o.product, o.description AS order_desc, o.amount, CONCAT('$', o.deal_rate) AS deal_rate, CONCAT('$', o.pl) AS pl, tt.description FROM transaction AS tr, transaction_order AS o, trading_type AS tt WHERE tr.transaction_id = o.transaction_id AND tr.transaction_type_id = o.order_type_id AND o.type_id = tt.trading_type_id AND o.status = 'close' AND tr.user_id = {$user_id}";
                $this->dbObject()->executeQuery($order_tran_sql);
                return json_encode(array("close_orders" => $this->dbObject()->getRows()), JSON_PRETTY_PRINT);
            }
        } else {
            return json_encode(array("error" => "Access Forbidden"));
        }
    }

    public function getAccountSummary()
    {
        if($this->authentication->isLoggedIn())
        {
            $this->getOpenOrders();
            $realized_pl = 0.0;
            $unrealized_pl = 0.0;
            $user_id = $this->dbObject()->sanitizeInput($_SESSION["authentication"]);
            $open_ord_sql = "SELECT tr.transaction_id, o.pl, o.unrealized_pl, o.close_time FROM transaction AS tr, transaction_order AS o, trading_type AS tt WHERE tr.transaction_id = o.transaction_id AND tr.transaction_type_id = o.order_type_id AND o.type_id = tt.trading_type_id AND o.status = 'open' AND tr.user_id = {$user_id}";
            $this->dbObject()->executeQuery($open_ord_sql);
            //print_r($this->dbObject()->getRows());
            $ord_det = $this->dbObject()->getRows();
            //print_r($ord_det);
            for($i = 0; $i < count($ord_det); $i++)
            {
                $unrealized_pl += $ord_det[$i]["unrealized_pl"];
                $realized_pl += $ord_det[$i]["pl"];
            }
            
            $curr_time = $_SERVER["REQUEST_TIME"];
            $close_ord_sql = "SELECT o.pl, o.close_time FROM transaction_order AS o, transaction AS tr WHERE tr.transaction_id = o.transaction_id AND status = 'close' AND tr.user_id = {$user_id} AND {$curr_time} - close_time < 36000";
            $this->dbObject()->executeQuery($close_ord_sql);
            $pl_list = $this->dbObject()->getRows();
            $pl_count = count($pl_list);
            for($i = 0; $i < $pl_count; $i++)
            {
                $realized_pl += $pl_list[$i]["pl"];
            }
            
            $acc_bal_sql = "SELECT account_balance FROM users WHERE user_id = {$user_id}";
            $this->dbObject()->executeQuery($acc_bal_sql);
            $acc_bal = $this->dbObject()->getRows()[0]["account_balance"];
            $marginal_bal = $acc_bal + $unrealized_pl;
            if($marginal_bal <= 0)
            {
                $this->closeAllOrders();
            }
            $acc_summ = array("account_balance" => $acc_bal, "marginal_balance" => $marginal_bal, "realized_pl" => $realized_pl, "unrealized_pl" => $unrealized_pl);
            
            return json_encode(array("account_summary" => $acc_summ), JSON_PRETTY_PRINT);
        }
        else
        {
            return json_encode(array("error" => "Access Forbidden"));
        }
    }
    
    private function closeAllOrders()
    {
        if($this->authentication->isLoggedIn()){
                $user_id = $this->dbObject()->sanitizeInput($_SESSION["authentication"]);
                $update_sql = "UPDATE transaction_order AS t_o, transaction AS t SET t_o.status='close',  t_o.pl = t_o.unrealized_pl, t_o.close_time = {$_SERVER['REQUEST_TIME']} WHERE t_o.transaction_id = t.transaction_id AND t.user_id = {$user_id} AND t_o.status = 'open'";
                $this->dbObject()->executeQuery($update_sql);
                $update_bal_sql = "UPDATE users SET account_balance = 0 WHERE user_id = {$user_id}";
                $this->dbObject()->executeQuery($update_bal_sql);
        }
    }
    
    public function getOpenOrders() {
        if ($this->authentication->isLoggedIn()) {
            //if($_SERVER["REQUEST_METHOD"] == "POST")
            //{
            $user_id = $this->dbObject()->sanitizeInput($_SESSION["authentication"]);
            $open_order_sql = "SELECT tr.transaction_id, tr.confirmation_number, tr.date, o.product, o.description AS order_desc, o.amount, o.deal_rate, CONCAT('$', o.pl) AS pl, tt.description, CONCAT('$', o.unrealized_pl) AS unrealized_pl FROM transaction AS tr, transaction_order AS o, trading_type AS tt WHERE tr.transaction_id = o.transaction_id AND tr.transaction_type_id = o.order_type_id AND o.type_id = tt.trading_type_id AND o.status = 'open' AND tr.user_id = {$user_id} ORDER BY tr.transaction_id DESC";
            $this->dbObject()->executeQuery($open_order_sql);
            $order_det = $this->dbObject()->getRows();
            $product_list = "";

            //print_r($order_det);
            foreach ($order_det as $detail) {
                $product_list .= $detail["product"] . ",";
            }

            //echo $product_list;
            $product = rtrim($product_list, ",");
            //print_r($order_det);
            
            $quote_arr = explode(",", $product);
            $quote_curr = "";
            
            foreach($quote_arr as $quote)
            {
                $quote_curr .= substr($quote, 3) . "AUD,";
            }
            
            
            $quote_curr = rtrim($quote_curr, ",");
            /*
            $curl = curl_init();
            curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($curl, CURLOPT_URL, "http://" . ROOT_URL . "ajaxservice/getLiveFxRate/{$product}");
             * 
             */
            //curl_setopt($curl, CURLOPT_TIMEOUT_MS, 200);
            $rate_arr = json_decode(file_get_contents("http://" . ROOT_URL . "ajaxservice/getLiveFxRate/{$product}"), true);
            
           // curl_setopt($curl, CURLOPT_URL, "http://" . ROOT_URL . "ajaxservice/getLiveFxRate/{$quote_curr}");
            $rate_arr_quote = json_decode(file_get_contents("http://" . ROOT_URL . "ajaxservice/getLiveFxRate/{$quote_curr}"), true);
                       
            for ($i = 0; $i < count($order_det); $i++) {
                
                if ($order_det[$i]["description"] == "Buy") {
                    $order_det[$i]["live_rate"] = $rate_arr["live_rates"][$i]["sell"];
                    $live_rate = $order_det[$i]["live_rate"];
                    $deal_rate = $order_det[$i]["deal_rate"];
                    $unrealized_pl = number_format($live_rate - $deal_rate, 4) * $rate_arr_quote["live_rates"][$i]["sell"] * $order_det[$i]["amount"];
                    $order_det[$i]["unrealized_pl"] = $unrealized_pl;
                    $update_sql = "UPDATE transaction_order SET unrealized_pl = {$unrealized_pl} WHERE transaction_id = {$order_det[$i]["transaction_id"]}";
                    $this->dbObject()->executeQuery($update_sql);

                    //echo $rate_arr["live_rates"][$i]["sell"] . ", ";
                } else if ($order_det[$i]["description"] == "Sell") {
                    $order_det[$i]["live_rate"] = $rate_arr["live_rates"][$i]["buy"];
                    $live_rate = $order_det[$i]["live_rate"];
                    $deal_rate = $order_det[$i]["deal_rate"];
                    $order_det[$i]["unrealized_pl"] = number_format($deal_rate - $live_rate, 4) * $rate_arr_quote["live_rates"][$i]["buy"] * $order_det[$i]["amount"];

                    $update_sql = "UPDATE transaction_order SET unrealized_pl = {$order_det[$i]["unrealized_pl"]} WHERE transaction_id = {$order_det[$i]["transaction_id"]}";
                    $this->dbObject()->executeQuery($update_sql);
                    
                }
            }
            return json_encode(array("open_orders" => $order_det), JSON_PRETTY_PRINT);
           
        //}
       
        }
        else
        {
            return json_encode(array("error" => "Access Forbidden"));
        }
    }

    public function getDepositTransactions() {
        if ($this->authentication->isLoggedIn()) {
            if ($_SERVER["REQUEST_METHOD"] == "GET") {
                $user_id = $this->dbObject()->sanitizeInput($_SESSION["authentication"]);
                $dep_tran_sql = "SELECT tr.transaction_id, tr.confirmation_number, tr.date, CONCAT('$',td.amount) AS amount, td.description FROM transaction AS tr, transaction_deposit AS td WHERE tr.transaction_id = td.transaction_id AND tr.transaction_type_id = td.deposit_type_id AND tr.user_id = {$user_id}";
                $this->dbObject()->executeQuery($dep_tran_sql);
                return json_encode(array("deposit_transactions" => $this->dbObject()->getRows()), JSON_PRETTY_PRINT);
            }
        } else {
            return json_encode(array("error" => "Access Forbidden"));
        }
    }

    public function changePassword() {
        if ($this->authentication->isLoggedIn()) {
            $error = array();
            if ($_SERVER["REQUEST_METHOD"] == "POST") {
                $old_password = htmlentities($this->dbObject()->sanitizeInput($_POST["old_password"]));
                $new_password = htmlentities($this->dbObject()->sanitizeInput($_POST["new_password"]));
                $user_id = $this->dbObject()->sanitizeInput($_SESSION["authentication"]);
                $user_sql = "SELECT password FROM users WHERE user_id = {$user_id}";
                $this->dbObject()->executeQuery($user_sql);
                $db_password = $this->dbObject()->getRows()[0]["password"];
                $hashed_pass = crypt($old_password, $db_password);
                if ($db_password == $hashed_pass) {
                    $hashed_password = Encryption::getPasswordHash($this->dbObject()->sanitizeInput($new_password));
                    $pass_update_sql = "UPDATE users SET password = '{$hashed_password}' WHERE user_id = {$user_id}";
                    $this->dbObject()->executeQuery($pass_update_sql);
                    return json_encode(array("response" => array("status" => "success", "msg" => "Your password has been successfully changed.")));
                } else {
                    return json_encode(array("response" => array("status" => "failed", "msg" => "Your old password cannot be found in database.")));
                }
            }
        } else {
            return json_encode(array("error" => "Access Forbidden"));
        }
    }

    public function deposit() {
        if ($this->authentication->isLoggedIn()) {
            if ($_SERVER["REQUEST_METHOD"] == "POST") {
                $amt = $this->dbObject()->sanitizeInput($_POST["fund_amt"]);
                $user_id = $this->dbObject()->sanitizeInput($_SESSION["authentication"]);
                $card_det_sql = "SELECT * FROM user_card_detail WHERE user_id = {$user_id}";
                $this->dbObject()->executeQuery($card_det_sql);
                $card_detail = $this->dbObject()->getRows();
                $card_name = $card_detail[0]["card_holder_name"];
                $card_num = $card_detail[0]["card_number"];
                $ccv = $card_detail[0]["ccv"];
                $expiry = $card_detail[0]["expiry"];
                $expiry_split = explode("/", $expiry);
                $expiry_month = trim($expiry_split[0]);
                $expiry_year = trim($expiry_split[1]);
                $card_type = $card_detail[0]["card_type"];

                try {
                    $sdkConfig = array("mode" => "sandbox");
                    $auth = new PayPal\Auth\OAuthTokenCredential("AcL0bgW9GMk3IN_OvjfVffa7SwFamNClSqU4iInTisS5Y5wiRmqPb18e8sHDygMFZS7jHzRxD--ARARG", "EJsuEp0PkfpZ8uJ3YsfrnIA7YlZ1uzrQcdEVRR3-_9gHNeElkbgtO6_fgBwwNx--3m61kESX1k3VCK0t");
                    $apiContext = new PayPal\Rest\ApiContext($auth, 'Request' . time());
                    $apiContext->setConfig($sdkConfig);

                    $card = new PayPal\Api\CreditCard();
                    $card->setType($card_type);
                    $card->setNumber($card_num);
                    $card->setCvv2($ccv);
                    $card->setExpireMonth($expiry_month);
                    $card->setExpireYear($expiry_year);
                    $card->setFirstName($card_name);

                    $fundingInstrument = new PayPal\Api\FundingInstrument();
                    $fundingInstrument->setCreditCard($card);

                    $payer = new PayPal\Api\Payer();
                    $payer->setPaymentMethod("credit_card");
                    $payer->setFundingInstruments(array($fundingInstrument));

                    $amount = new PayPal\Api\Amount();
                    $amount->setCurrency("AUD");
                    $amount->setTotal($amt);

                    $transaction = new PayPal\Api\Transaction();
                    $transaction->setAmount($amount);
                    $transaction->setDescription("Fund Deposit");

                    $payment = new PayPal\Api\Payment();
                    $payment->setIntent("sale");
                    $payment->setPayer($payer);
                    $payment->setTransactions(array($transaction));
                    $payment->create($apiContext);
                    $payment_detail = $payment->toArray();
                    $state = $payment_detail["state"];
                    $total = $this->dbObject()->sanitizeInput($payment_detail["transactions"][0]["amount"]["total"]);
                    $desc = $this->dbObject()->sanitizeInput($payment_detail["transactions"][0]["description"]);
                    $id = $this->dbObject()->sanitizeInput($payment_detail["id"]);
                    $created_time = $this->dbObject()->sanitizeInput($payment_detail["create_time"]);
                    if ($state == "approved") {
                        $insert_trans_sql = "INSERT INTO transaction (confirmation_number, date, transaction_type_id, user_id) VALUES ('{$id}', DATE_FORMAT(NOW(),'%b %d %Y %h:%i %p'), 'D', {$user_id})";
                        $this->dbObject()->executeQuery($insert_trans_sql);
                        $last_id = $this->dbObject()->getLastId();

                        $insert_dep_sql = "INSERT INTO transaction_deposit (amount, description, transaction_id) VALUES ({$total}, '{$desc}', {$last_id})";
                        $this->dbObject()->executeQuery($insert_dep_sql);

                        $update_bal_sql = "UPDATE users SET account_balance = account_balance + {$total} WHERE user_id = {$user_id}";
                        $this->dbObject()->executeQuery($update_bal_sql);

                        $acc_sql = "SELECT account_balance FROM users WHERE user_id = {$user_id}";
                        $this->dbObject()->executeQuery($acc_sql);
                        $bal = $this->dbObject()->getRows()[0]["account_balance"];
                        return json_encode(array("status" => "approved", "amt" => $bal));
                    } else {
                        return json_encode(array("status" => "failed"));
                    }
                } catch (PayPal\Exception\PayPalConnectionException $ex) {
                    return json_encode(array("status" => "failed"));
                }
            }
        } else {
            return json_encode(array("error" => "Access Forbidden"));
        }
    }
    
    public function closeOrder()
    {
        if($this->authentication->isLoggedIn()){
            if($_SERVER["REQUEST_METHOD"] == "POST"){
                $user_id = $this->dbObject()->sanitizeInput($_SESSION["authentication"]);
                $transaction_id = $this->dbObject()->sanitizeInput($_POST["transaction_id"]);
                $update_sql = "UPDATE transaction_order SET status = 'close', pl = unrealized_pl, unrealized_pl = 0, close_time = {$_SERVER['REQUEST_TIME']} WHERE transaction_id = {$transaction_id}";
                $this->dbObject()->executeQuery($update_sql);
                $get_pl_sql = "SELECT pl FROM transaction_order WHERE transaction_id = {$transaction_id}";
                $this->dbObject()->executeQuery($get_pl_sql);
                $pl = $this->dbObject()->getRows()[0]["pl"];
                $update_bal_sql = "UPDATE users SET account_balance = account_balance + {$pl} WHERE user_id = {$user_id}";
                $this->dbObject()->executeQuery($update_bal_sql);
                return json_encode(array("response" => array("status" => "success", "pl" => $pl)));
            }
            
        }else{
            return json_encode(array("error" => "Access Forbidden"));
        }
    }
    
    public function getMargin($pair, $trade_size)
    {
        $slice_pair = substr($pair, 0, 3);
        $base_rate_pair = $slice_pair . "AUD";
        $live_rate_json = $this->getLiveFxRate($base_rate_pair);
        $live_rate_arr = json_decode($live_rate_json, true);
        $margin = ($trade_size / 100)*$live_rate_arr["live_rates"][0]["rate"];
        return $margin;
    }
    
    private function getUserBal()
    {
        if($this->authentication->isLoggedIn())
        {
        $user_id = $this->dbObject()->sanitizeInput($_SESSION["authentication"]);
        $bal_sql = "SELECT account_balance FROM users WHERE user_id = {$user_id}";
        $this->dbObject()->executeQuery($bal_sql);
        $bal = $this->dbObject()->getRows()[0]["account_balance"];
        return $bal;
        }
    }
    
    public function placeOrder() {
        if ($this->authentication->isLoggedIn()) {
            if ($_SERVER["REQUEST_METHOD"] == "POST") {
                $user_id = $this->dbObject()->sanitizeInput($_SESSION["authentication"]);
                $trade_type = $_POST["trade_type"];
                $product = $_POST["product"];
                $trading_size = intval($_POST["trading_size"]);
                $rate = 0;
                $desc = "";
                if($this->getUserBal() >= $this->getMargin($product, $trading_size))
                {
                $confirmation_number = "PAY-" . md5(microtime() . rand());

                $curl = curl_init("http://" . ROOT_URL . "ajaxservice/getLiveFxRate/{$product}");
                curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
                $rate_arr = json_decode(curl_exec($curl), true);

                $rate_arr["live_rates"][0]["buy"];

                if ($trade_type == "B") {
                    $rate = $rate_arr["live_rates"][0]["buy"];
                    $desc = "Bought " . $product . " @ " . $rate;
                } else if ($trade_type == "S") {
                    $rate = $rate_arr["live_rates"][0]["sell"];
                    $desc = "Sold " . $product . " @ " . $rate;
                }


                $insert_trans_sql = "INSERT INTO transaction (confirmation_number, date, transaction_type_id, user_id) VALUES ('{$confirmation_number}', DATE_FORMAT(NOW(),'%b %d %Y %h:%i %p'), 'O', {$user_id})";
                $this->dbObject()->executeQuery($insert_trans_sql);
                $last_id = $this->dbObject()->getLastId();

                $insert_ord_sql = "INSERT INTO transaction_order (transaction_id, product, description, type_id, amount, deal_rate, status, open_time) VALUES ({$last_id}, '{$product}', '{$desc}', '{$trade_type}', {$trading_size}, {$rate}, 'open', {$_SERVER['REQUEST_TIME']})";
                $this->dbObject()->executeQuery($insert_ord_sql);

                return json_encode(array("response" => array("status" => "success", "desc" => $desc, "size" => $trading_size)));
                }
                else{
                  return json_encode(array("response" => array("status" => "failed", "desc" => "Sorry! You don't have sufficient balance.", "size" => $trading_size)));  
                }
            }
        } else {
            return json_encode(array("error" => "Access Forbidden"));
        }
    }

    public function getUserDetails() {
        if ($this->authentication->isLoggedIn()) {
            if ($_SERVER["REQUEST_METHOD"] == "GET") {
                $user_id = $this->dbObject()->sanitizeInput($_SESSION["authentication"]);
                //$user_detail_sql = "SELECT * FROM users WHERE user_id = {$user_id}";
                $user_detail_sql = "SELECT title_salute, first_name, middle_name, last_name, date_of_birth, phone, country, address_1, address_2, state, suburb, post_code, email_id FROM users WHERE user_id = {$user_id}";
                $this->dbObject()->executeQuery($user_detail_sql);
                return json_encode(array("user_detail" => $this->dbObject()->getRows()), JSON_PRETTY_PRINT);
            }
            if ($_SERVER["REQUEST_METHOD"] == "POST") {
                $user_id = $this->dbObject()->sanitizeInput($_SESSION["authentication"]);
                $country = htmlentities($this->dbObject()->sanitizeInput($_POST["country"]));
                $add1 = htmlentities($this->dbObject()->sanitizeInput($_POST["address_1"]));
                $add2 = htmlentities($this->dbObject()->sanitizeInput($_POST["address_2"]));
                $state = htmlentities($this->dbObject()->sanitizeInput($_POST["state"]));
                $postcode = htmlentities($this->dbObject()->sanitizeInput($_POST["postcode"]));
                $detail_update_sql = "UPDATE users SET country = '{$country}', address_1 = '{$add1}', address_2 = '{$add2}', state = '{$state}', post_code = '{$postcode}'";
                $this->dbObject()->executeQuery($detail_update_sql);
                return json_encode(array("response" => array("status" => "success")));
            }
        } else {
            return json_encode(array("error" => "Access Forbidden"));
        }
    }

    public function getUserCardDetail() {
        if ($this->authentication->isLoggedIn()) {
            if ($_SERVER["REQUEST_METHOD"] == "GET") {
                $user_id = $this->dbObject()->sanitizeInput($_SESSION["authentication"]);
                $card_sql = "SELECT * FROM user_card_detail WHERE user_id = {$user_id}";
                $this->dbObject()->executeQuery($card_sql);
                return json_encode(array("card" => $this->dbObject()->getRows()), JSON_PRETTY_PRINT);
            }
            if ($_SERVER["REQUEST_METHOD"] == "POST") {
                $user_id = $this->dbObject()->sanitizeInput($_SESSION["authentication"]);
                $card_num = $this->dbObject()->sanitizeInput($_POST["card_number"]);
                $card_type = $this->dbObject()->sanitizeInput($_POST["card_type"]);
                $card_name = $this->dbObject()->sanitizeInput($_POST["holder_name"]);
                $ccv = $this->dbObject()->sanitizeInput($_POST["ccv"]);
                $expiry = $this->dbObject()->sanitizeInput($_POST["expiry"]);
                if (!is_numeric($card_num)) {
                    return json_encode(array("response" => array("status" => "failed", "error" => array("code" => 2, "desc" => "Please check your input."))));
                }
                if (!is_numeric($ccv) && strlen($ccv) > 4) {
                    return json_encode(array("response" => array("status" => "failed", "error" => array("code" => 2, "desc" => "Please check your input."))));
                }

                if (strpos($expiry, "/") === FALSE) {
                    return json_encode(array("response" => array("status" => "failed", "error" => array("code" => 2, "desc" => "Please check your input."))));
                } else {
                    $splitted_data = explode("/", $expiry);
                    if (intval($splitted_data[0]) < 1 || intval($splitted_data[0]) > 12) {
                        return json_encode(array("response" => array("status" => "failed", "error" => array("code" => 2, "desc" => "Please check your input."))));
                    }
                    if (strlen($splitted_data[1]) < 4) {
                        return json_encode(array("response" => array("status" => "failed", "error" => array("code" => 2, "desc" => "Please check your input."))));
                    }
                }
                $card_sql = "SELECT * FROM user_card_detail WHERE user_id = {$user_id} AND card_number = {$card_num}";
                $this->dbObject()->executeQuery($card_sql);
                $rows = $this->dbObject()->getRows();
                $row_count = $this->dbObject()->getNumRows();
                if ($row_count == 1) {
                    if ($rows[0]["card_number"] == $card_num && $rows[0]["card_type"] == $card_type && $rows[0]["card_holder_name"] == $card_name && $rows[0]["ccv"] == $ccv && $rows[0]["expiry"] == $expiry) {
                        $card_update_sql = "UPDATE user_card_detail SET card_holder_name = '{$card_name}', card_number = {$card_num}, ccv = {$ccv}, expiry = '{$expiry}', card_type = '{$card_type}' WHERE user_id = {$user_id}";
                        $this->dbObject()->executeQuery($card_update_sql);
                        return json_encode(array("response" => array("status" => "success")));
                    }
                    return json_encode(array("response" => array("status" => "failed", "error" => array("code" => 1, "desc" => "Same card number with different information."))));
                } else {
                    if (CreditCardValidator::validCreditCard($card_num, $card_type)["valid"] == false) {
                        return json_encode(array("response" => array("status" => "failed", "error" => array("code" => 2, "desc" => "Card number does not match with card type."))));
                    }
                    $card_update_sql = "UPDATE user_card_detail SET card_holder_name = '{$card_name}', card_number = {$card_num}, ccv = {$ccv}, expiry = '{$expiry}', card_type = '{$card_type}' WHERE user_id = {$user_id}";
                    $this->dbObject()->executeQuery($card_update_sql);
                    return json_encode(array("response" => array("status" => "success")));
                }
            }
        } else {
            return json_encode(array("error" => "Access Forbidden"));
        }
    }

    public function getTechnicalNews() {
        return json_encode($this->getNewsDom("http://rss.forexfactory.net/news/technicalanalysis.xml"));
    }

    public function getBreakingNews() {
        return json_encode($this->getNewsDom("http://rss.forexfactory.net/news/breakingnews.xml"));
    }

    public function getFxIndustryNews() {
        return json_encode($this->getNewsDom("http://rss.forexfactory.net/news/forexindustrynews.xml"));
    }

    public function getFundamentalNews() {
        return json_encode($this->getNewsDom("http://rss.forexfactory.net/news/fundamentalanalysis.xml"));
    }

    public function getEntertainmentNews() {
        return json_encode($this->getNewsDom("http://rss.forexfactory.net/news/entertainmentnews.xml"));
    }

    public function checkUserNameAvailability($username) {
        $sanitized_username = $this->dbObject()->sanitizeInput(htmlentities($username));
        $check_user = "SELECT * FROM users WHERE email_id = '{$sanitized_username}'";
        $this->dbObject()->executeQuery($check_user);
        if ($this->dbObject()->getNumRows() === 1) {
            return json_encode(array("error" => 1));
        } else {
            return json_encode(array("error" => 0));
        }
    }

    private function getNewsDom($url) {
        $xmldoc = new DOMDocument();
        $xmldoc->load($url);
        $x = $xmldoc->getElementsByTagName("item");
        $news_length = $x->length;
        $news_arr = array();
        for ($i = 0; $i < $news_length; $i++) {
            $item_title = $x->item($i)->getElementsByTagName("title")->item(0)->childNodes->item(0)->nodeValue;
            $item_link = $x->item($i)->getElementsByTagName("link")->item(0)->childNodes->item(0)->nodeValue;
            $pub_date = $x->item($i)->getElementsByTagName("pubDate")->item(0)->childNodes->item(0)->nodeValue;
            $content = $x->item($i)->getElementsByTagNameNS("http://purl.org/rss/1.0/modules/content/", "encoded")->item(0)->childNodes->item(0)->nodeValue;
            $news_arr[] = array("title" => $item_title, "link" => $item_link, "pub_date" => $pub_date, "content" => $content);
        }
        return $news_arr;
    }

}
