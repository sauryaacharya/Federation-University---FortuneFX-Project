<?php
class AdminController extends Controller {
    
    public function __construct(Registry $registry, Model $model) {
        parent::__construct($registry, $model);
        $this->registry->getObject("loader")->handler("Form");
        $this->validation_object = $this->registry->getObject("form_validation");
        $this->authentication = $this->registry->getObject("authentication");
    }
    
    public function index()
    {
        if($this->authentication->isAdmin())
        {
            header("Location: http://" . ROOT_URL . "admin/dashboard");
            exit;
        }
        
        if(isset($_POST["ad_login_btn"]))
        {
            $this->validation_object->setValidationCheck("ad_login_btn", "callback__verifyUser", $this);
        }
        
        if($this->validation_object->runValidator() == FALSE)
        {
            $data["title"] = "Welcome To Admin Panel | Admin Login";
            $this->view->render("admin/admin_login", $data);
        }
    }
    
    public function dashboard()
    {
        if(!$this->authentication->isAdmin())
        {
            header("Location: http://" . ROOT_URL);
            exit;
        }
        $data["title"] = "Welcome - Admin Dashboard | Fortune FX";
        $this->view->render("templates/admin/header", $data);
        $this->view->render("templates/admin/main_page");
        $this->view->render("admin/admin_dashboard", $data);
        $this->view->render("templates/admin/footer");
    }
    
    public function customer()
    {
        if(!$this->authentication->isAdmin())
        {
            header("Location: http://" . ROOT_URL);
            exit;
        }
        $data["user_dens"] = $this->model->getUserDensByCountry();
        $data["title"] = "Customer Of Fortune FX";
        $this->view->render("templates/admin/header", $data);
        $this->view->render("templates/admin/main_page");
        $this->view->render("admin/allcustomer", $data);
        $this->view->render("templates/admin/footer");
    }
    
    public function tradinganalytics()
    {
       if(!$this->authentication->isAdmin())
        {
            header("Location: http://" . ROOT_URL);
            exit;
        }
        
        $data["unit_trd"] = $this->model->getTopFiveTradedByUnits();
        $data["cust_trd"] = $this->model->getTopFiveActiveCust();
        $data["trade_trans"] = $this->model->getOrderTransDet();
        //echo $data["trade_trans"];
        $data["title"] = "Trading Analytics Overview";
        $this->view->render("templates/admin/header", $data);
        $this->view->render("templates/admin/main_page");
        $this->view->render("admin/trading_overview", $data);
        $this->view->render("templates/admin/footer"); 
    }
    
    public function useranalytics()
    {
        if(!$this->authentication->isAdmin())
        {
            header("Location: http://" . ROOT_URL);
            exit;
        }
        
        $data["arr"] = $this->model->getVisitByBrowser();
        $data["arr_plt"] = $this->model->getVisitByPlatform();
        $data["title"] = "Audience Overview";
        $this->view->render("templates/admin/header", $data);
        $this->view->render("templates/admin/main_page");
        $this->view->render("admin/user_overview", $data);
        $this->view->render("templates/admin/footer");
    }
    
    public function _verifyUser($post_data)
    {
            if(!$this->authentication->isAdmin())
            {
            unset($_SESSION["authentication"]);
            $this->validation_object->setMasterFieldData("Error! Invalid username / password.", "ad_login_btn", "error");
            }
        
    }
}

