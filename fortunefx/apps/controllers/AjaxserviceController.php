<?php
class AjaxserviceController extends Controller {
    
    public function __construct(Registry $registry, Model $model) {
        parent::__construct($registry, $model);
        //$this->model->getMargin("EURUSD", 100000, 20);
        //$this->model->getUserBal();
        
    }
    
    public function index()
    {
        
    }
    
    public function totalvisits()
    {
        header("Content-Type: application/json; charset=UTF-8");
        echo $this->model->getTotalVisitor();
    }
    
    public function visitbybrowser()
    {
        header("Content-Type: application/json; charset=UTF-8");
        echo $this->model->getByBrowser();
    }
    
    public function blockuser()
    {
        header("Content-Type: application/json; charset=UTF-8");
        echo $this->model->blockUser();
    }
    
    public function unblockuser()
    {
        header("Content-Type: application/json; charset=UTF-8");
        echo $this->model->unblockUser();
    }
    
    public function customers()
    {
        header("Content-Type: application/json; charset=UTF-8");
        echo $this->model->getCustomers();
    }
    
    public function deposit()
    {
        require dirname(dirname(__DIR__)) . "/paypal/paypal/rest-api-sdk-php/sample/bootstrap.php";
        header("Content-Type: application/json; charset=UTF-8");
        echo $this->model->deposit();
    }
    
    public function closeorder()
    {
        header("Content-Type: application/json; charset=UTF-8");
        echo $this->model->closeOrder();
    }
    
    public function closedorders()
    {
        header("Content-Type: application/json; charset=UTF-8");
        echo $this->model->getClosedOrders();
    }
    
    public function openorders()
    {
        header("Access-Control-Allow-Origin: *");
        header("Cache-Control: max-age = 3");
        header("Content-Type: application/json; charset=UTF-8");
        echo $this->model->getOpenOrders();
    }
    
    public function accountsummary()
    {
        header("Access-Control-Allow-Origin: *");
        header("Cache-Control: max-age = 3");
        header("Content-Type: application/json; charset=UTF-8");
        echo $this->model->getAccountSummary();
    }
    
    public function placeorder()
    {
        header("Content-Type: application/json; charset=UTF-8");
        echo $this->model->placeOrder();
    }
    
    public function deposittransactions()
    {
        header("Content-Type: application/json; charset=UTF-8");
        echo $this->model->getDepositTransactions();
    }
    
    public function changepassword()
    {
        header("Content-Type: application/json; charset=UTF-8");
        echo $this->model->changePassword();
    }
    
    public function userdetails()
    {
        header("Content-Type: application/json; charset=UTF-8");
        echo $this->model->getUserDetails();
    }
    
    public function carddetails()
    {
        header("Content-Type: application/json; charset=UTF-8");
        echo $this->model->getUserCardDetail();
    }
    
    public function getLiveFxRate($pair = "")
    {
        header("Access-Control-Allow-Origin: *");
        header("Cache-Control: max-age = 3");
        header("Content-Type: application/json; charset=UTF-8");
        echo $this->model->getLiveFxRate($pair);    
    }
    
    public function getTechnicalNews()
    {
        header("Access-Control-Allow-Origin: *");
        header("Content-Type: application/json; charset=UTF-8");
        echo $this->model->getTechnicalNews();
    }
    
    public function getBreakingNews()
    {
        header("Access-Control-Allow-Origin: *");
        header("Content-Type: application/json; charset=UTF-8");
        echo $this->model->getBreakingNews();
    }
    
    public function getFxIndustryNews()
    {
        header("Access-Control-Allow-Origin: *");
        header("Content-Type: application/json; charset=UTF-8");
        echo $this->model->getFxIndustryNews();
    }
    
    public function getFundamentalNews()
    {
        header("Access-Control-Allow-Origin: *");
        header("Content-Type: application/json; charset=UTF-8");
        echo $this->model->getFundamentalNews();
    }
    
    public function getEntertainmentNews()
    {
        header("Access-Control-Allow-Origin: *");
        header("Content-Type: application/json; charset=UTF-8");
        echo $this->model->getEntertainmentNews();
    }
    
    public function checkDate($month = "", $day = "", $year = "") {
        header("Access-Control-Allow-Origin: *");
        header("Content-Type: application/json; charset=UTF-8");
        if (intval($month) && intval($day) && intval($year)) {
            if (strlen($year) == 4) {
                if (!checkdate($month, $day, $year)) {
                    echo json_encode(array("error" => "Invalid date format."));
                }
                else
                {
                    echo json_encode(array("error" => "null"));
                }
            } else {
                echo json_encode(array("error" => "Invalid date format."));
            }
            //echo "integer";
        } else {
            echo json_encode(array("error" => "Invalid date format"));
        }
    }
    
    public function checkUserNameAvailability($username)
    {
        header("Content-Type: application/json; charset=UTF-8");
        echo $this->model->checkUserNameAvailability($username);
    }
    
    public function sendConfirmationEmail($email_id = "")
    {
        header("Content-Type: application/json; charset=UTF-8");
        if($_SERVER["REQUEST_METHOD"] == "POST")
        {
            if($email_id != "")
            {
                $sModel = new SignupModel();
                if(!$sModel->checkEmail($email_id))
                {
                //print_r($sModel->isAccountActive($email_id));
                if(!$sModel->isAccountActive($email_id))
                {
                    $sModel->updateActivationToken(md5($email_id . time()), $email_id);
                    $sModel->sendConfirmationEmail(md5($email_id . time()), $email_id);
                    echo json_encode(array("error"=>0));
                }
                else
                {
                    echo json_encode(array("error"=>1));
                }  
                }
                else
                {
                    echo json_encode(array("error"=>1));
                }
            }
        }
    }

    public function getEconomicCalendar()
    {
        
    }
    
    
    /*
        $consumer_key = "dj0yJmk9SlFrRVRKU0VKaU5wJmQ9WVdrOVowMXpRVWxTTlRBbWNHbzlNQS0tJnM9Y29uc3VtZXJzZWNyZXQmeD0zZg--";
        $consumer_secret = "a2cd662aed8afd33e5d7e69bdfb1bf3f86e860a1";
        $base_url = "https://query.yahooapis.com/v1/public/yql";
        $args = array();
        $args["q"] = "select * from yahoo.finance.xchange where pair in ('EURUSD','AUDUSD', 'AUDNZD')";
        $args["format"] = "json";
        $args["env"] = "store://datatables.org/alltableswithkeys";
        $args["diagnostics"] = "true";
        
        $oath_consumer = new OAuthConsumer($consumer_key, $consumer_secret);
        $request = OAuthRequest::from_consumer_and_token($oath_consumer, NULL, "GET", $base_url, $args);
        $request->sign_request(new OAuthSignatureMethod_HMAC_SHA1(), $oath_consumer, NULL);
        $url = sprintf("%s?%s", $base_url, OAuthUtil::build_http_query($args));
        $curl = curl_init();
        $headers = array($request->to_header());
        curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($curl, CURLOPT_URL, $url);
        curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, TRUE);
        $json_data = curl_exec($curl);
        //echo $json_data;
         * 
         */
    
    /*
        //$yql_base_url = "https://query.yahooapis.com/v1/public/yql";
        $yql_query = 'https://query.yahooapis.com/v1/public/yql?q=select%20*%20from%20yahoo.finance.xchange%20where%20pair%20in%20(%22EURUSD%22%2C%22GBPUSD%22)&format=json&env=store%3A%2F%2Fdatatables.org%2Falltableswithkeys&callback=';
        //$yql_query_url = $yql_base_url . "?q=" . $yql_query;
        $curl = curl_init($yql_query);
        curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        $json_data = curl_exec($curl);
        curl_close($curl);
        echo $json_data;
        // https://queries.yahooapis.com/v1/public/yql?q=select%20*%20from%20yahoo.finance.xchange%20where%20pair%20in%20(%22EURUSD%22%2C%22GBPUSD%22)&env=store%3A%2F%2Fdatatables.org%2Falltableswithkeys
        */
}