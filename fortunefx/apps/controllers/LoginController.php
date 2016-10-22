<?php
class LoginController extends Controller{
    
    public function __construct(Registry $registry, Model $model) {
        parent::__construct($registry, $model);
        $this->registry->getObject("loader")->handler("Form");
        $this->validation_object = $this->registry->getObject("form_validation");
        $this->authentication = $this->registry->getObject("authentication");
    }
    
    public function index()
    {
        if($this->authentication->isLoggedIn())
        {
            header("Location: http://" . ROOT_URL . "dashboard");
            exit;
        }
  
        if(isset($_POST["login_btn"]))
        {
            $this->validation_object->setValidationCheck("login_btn", "callback__verifyUser", $this);
        }
        
        if($this->validation_object->runValidator() == FALSE)
        {
            $data["title"] = "Member Login";
            $this->view->render("templates/header", $data);
            $this->view->render("templates/main_page");
            $this->view->render("login/index", $data);
            $this->view->render("templates/footer");
        }
        else
        {
            echo "Successfully logged in.";
        }
    }
    
    public function _verifyUser($post_data)
    {
        //$auth = $this->registry->getObject("authentication");
        if(!$this->authentication->isActive())
        {
            $this->validation_object->setMasterFieldData("Error! This account has not been activated yet. Please activate your account.", "login_btn", "error");
        }
        else if(!$this->authentication->isLoggedIn())
        {
            $this->validation_object->setMasterFieldData("Error! Invalid email / password.", "login_btn", "error");
        }
    }
}
