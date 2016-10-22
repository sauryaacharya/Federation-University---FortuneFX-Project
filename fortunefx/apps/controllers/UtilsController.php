<?php
class UtilsController extends Controller{
    
    public function __construct(Registry $registry, Model $model) {
        parent::__construct($registry, $model);
        $this->registry->getObject("loader")->handler("Form");
        $this->validation_object = $this->registry->getObject("form_validation");
    }
    
    public function index()
    {
        header("Location: http://".ROOT_URL);
        exit;
    }
    
    public function passwordrecovery($token = "")
    {
        
        if($token == "")
        {
            header("Location: http://".ROOT_URL);
            exit;
        }
        
            if($this->model->isTokenExists($token))
            {
                $data["success_msg"] = "";
                if(!$this->model->isTokenExpire($token))
                {
                if(isset($_POST["pass_change_btn"]))
                {
                    $this->validation_object->setValidationCheck("password", "callback__validatePassword", $this);
                    $this->validation_object->setValidationCheck("confirm_password", "callback__validateConfirmPassword", $this);
                }
                
                if($this->validation_object->runValidator() !== FALSE)
                {
                    $this->model->changePassword($token, htmlspecialchars($_POST["password"]));
                    $this->model->deleteResetToken($token);
                    $data["success_msg"] = "<div id='success_msg' style='font-family:Arial;color:#009900;font-size:13px;border:1px solid #eaeaea;padding:10px;background:#f2f2f2;'>Congratulations! Your password has been successfully changed.</div>";
                }
                    $data["title"] = "Password Recovery";
                    $data["exp"] = false;
                    
                }
                else
                {
                    $data["title"] = "Password Recovery Token Expired";
                    $data["exp"] = true;
                }
                    $this->view->render("templates/header", $data);
                    $this->view->render("templates/main_page");
                    $this->view->render("utils/passrecovery", $data);
                    $this->view->render("templates/footer");
                
            }
            else
            {
                header("Location: http://".ROOT_URL);
                exit;
            }
              
    }
    
    public function _validatePassword($post_data)
    {
        if($this->validation_object->required($post_data) == TRUE)
        {
            $this->validation_object->setMasterFieldData("&nbsp;Please enter the password.", "password", "error");
        }
        else
        {
            if(strlen($post_data) < 8)
            {
               $this->validation_object->setMasterFieldData("&nbsp;Please enter the password of at least 8 characters.", "password", "error");
            }
            else
            {
                if(!preg_match("/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d).+$/", $post_data))
                {
                    $this->validation_object->setMasterFieldData("&nbsp;Please enter the password including uppercase, lowercase and number.", "password", "error");
                }
            }
        }
    }
    
    public function _validateConfirmPassword($post_data)
    {
        if($this->validation_object->required($post_data) == TRUE)
        {
            $this->validation_object->setMasterFieldData("Please enter the confirm password.", "confirm_password", "error");
        }
        else
        {
            if($post_data != $this->validation_object->getValidationCheck()["password"]["postdata"])
            {
                $this->validation_object->setMasterFieldData("Password mismatch.", "confirm_password", "error");
            }
        }
    }
    
    public function passwordreset()
    {
        if(isset($_POST["send_btn"]))
        {
            $this->validation_object->setValidationCheck("email_id", "callback__validateEmail", $this);
        }
        
        $data["success_msg"] = "";
        
        if($this->validation_object->runValidator() !== FALSE)
        {
           $data["success_msg"] = "<div id='success_msg' style='font-family:Arial;color:#009900;font-size:13px;border:1px solid #eaeaea;padding:10px;background:#f2f2f2;'>An email has been sent. Please check your email and follow the link to reset your password.</div>"; 
           $token = htmlentities($this->model->generateToken($_POST["email_id"]));
           $this->model->setPasswordRecoveryToken($token, $_POST["email_id"]);
           $this->model->sendPasswordRecoveryEmail($token, $_POST["email_id"]);
        }
        $data["title"] = "Password Recovery";
        $this->view->render("templates/header", $data);
        $this->view->render("templates/main_page");
        $this->view->render("utils/passreset", $data);
        $this->view->render("templates/footer");
    }
     
    public function _validateEmail($post_data)
    {
        if($this->validation_object->required($post_data) == TRUE)
        {
            $this->validation_object->setMasterFieldData("Please enter the email.", "email_id", "error");
        }
        else if($this->validation_object->valid_email($post_data) == FALSE)
        {
            $this->validation_object->setMasterFieldData("Please enter a valid email.", "email_id", "error");
        }
        else if(!$this->model->isEmailExists($post_data))
        {
           $this->validation_object->setMasterFieldData("Error! email not found in database.", "email_id", "error"); 
        }
        
    }
}
