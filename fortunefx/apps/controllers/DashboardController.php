<?php
class DashboardController extends Controller {
    
    public function __construct(Registry $registry, Model $model) {
        parent::__construct($registry, $model);
        $this->authentication = $this->registry->getObject("authentication");
        if(!$this->authentication->isLoggedIn())
        {
            header("Location: http://" . ROOT_URL . "login");
            exit;
        }
    }
    
    public function index()
    {
        $data["first_name"] = $this->authentication->getUsername();
        $data["title"] = "Dashboard";
        $this->view->render("templates/header", $data);
        $this->view->render("templates/main_page");
        $this->view->render("dashboard/dashboard", $data);
        $this->view->render("templates/footer");
    }
    
    public function funding()
    {
        $data["card_detail"] = $this->model->getCardDetail();
        $data["first_name"] = $this->authentication->getUsername();
        $data["title"] = "Dashboard";
        $this->view->render("templates/header", $data);
        $this->view->render("templates/main_page");
        $this->view->render("dashboard/funding", $data);
        $this->view->render("templates/footer");
    }
    
    public function myaccount()
    {
        $data["user_detail"] = $this->model->getUserDetail();
        $data["title"] = "Dashboard";
        $this->view->render("templates/header", $data);
        $this->view->render("templates/main_page");
        $this->view->render("dashboard/myaccount", $data);
        $this->view->render("templates/footer");
    }
    
    public function transactions()
    {
        $data["title"] = "My Transactions";
        //$data["dep_transaction"] = $this->model->getDepositTransactions();
        $this->view->render("templates/header", $data);
        $this->view->render("templates/main_page");
        $this->view->render("dashboard/transactions", $data);
        $this->view->render("templates/footer");
    }
    
    public function orders()
    {
        $data["title"] = "My Orders";
        $data["dep_transaction"] = $this->model->getDepositTransactions();
        $this->view->render("templates/header", $data);
        $this->view->render("templates/main_page");
        $this->view->render("dashboard/orders", $data);
        $this->view->render("templates/footer");
    }
}

