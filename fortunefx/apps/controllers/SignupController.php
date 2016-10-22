<?php
class SignupController extends Controller {
    
    public function __construct(Registry $registry, Model $model) {
        parent::__construct($registry, $model);
        $this->registry->getObject("loader")->handler("Form");
        $this->validation_object = $this->registry->getObject("form_validation");
    }
    
    public function index()
    {
        header("Location:http://" . ROOT_URL . "signup/step1");
    }
    
    public function step1()
    {
        if(isset($_POST["save_cont"]))
        {
            $this->validation_object->setValidationCheck("title_salute", "callback__validateTitle", $this);
            $this->validation_object->setValidationCheck("first_name", "callback__validateFirstName", $this);
            $this->validation_object->setValidationCheck("last_name", "callback__validateLastName", $this);
            $this->validation_object->setValidationCheck("dob", "callback__validateDob", $this);
            $this->validation_object->setValidationCheck("phone", "callback__validatePhone", $this);
            $this->validation_object->setValidationCheck("country", "callback__validateCountry", $this);
            $this->validation_object->setValidationCheck("add1", "callback__validateAdd1", $this);
            $this->validation_object->setValidationCheck("state", "callback__validateState", $this);
            $this->validation_object->setValidationCheck("suburb", "callback__validateSuburb", $this);
            $this->validation_object->setValidationCheck("postcode", "callback__validatePostCode", $this);
        
        }
        if($this->validation_object->runValidator() == FALSE)
        {
        $data["title"] = "Personal Details | Fortune FX Registration | Step 1";
        $this->view->render("templates/header", $data);
        $this->view->render("templates/main_page");
        $this->view->render("signup/step1", $data);
        $this->view->render("templates/footer");
        }
        else
        {
            $title = htmlentities($_POST["title_salute"]);
            $first_name = htmlentities($_POST["first_name"]);
            $last_name = htmlentities($_POST["last_name"]);
            $middle_name = htmlentities($_POST["middle_name"]);
            $dob = htmlentities($_POST["dob"]);
            $phone = htmlentities($_POST["phone"]);
            $country = htmlentities($_POST["country"]);
            $add1 = htmlentities($_POST["add1"]);
            $add2 = htmlentities($_POST["add2"]);
            $state = htmlentities($_POST["state"]);
            $suburb = htmlentities($_POST["suburb"]);
            $postcode = htmlentities($_POST["postcode"]);
            $base_currency = htmlentities($_POST["currency"]);
            
            $step1_details = array(
                                   "title_salute" => $title, 
                                   "first_name" => $first_name, 
                                   "middle_name" => $middle_name,
                                   "last_name" => $last_name,
                                   "dob" => $dob,
                                   "phone" => $phone,
                                   "country" => $country,
                                   "add1" => $add1,
                                   "add2" => $add2,
                                   "state" => $state,
                                   "suburb" => $suburb,
                                   "postcode" => $postcode,
                                   "currency" => $base_currency
                                  );
            $_SESSION["reg_step_1"] = $step1_details;   
            
            header("Location: http://localhost/fortunefx/signup/step2");
        }
    }
    
    public function _validatePostCode($post_data)
    {
        if($this->validation_object->required($post_data) == TRUE)
        {
            $this->validation_object->setMasterFieldData("Please enter the postcode.", "postcode", "error");
        }
    }
    
    public function _validateSuburb($post_data)
    {
        if($this->validation_object->required($post_data) == TRUE)
        {
            $this->validation_object->setMasterFieldData("Please enter the suburb.", "suburb", "error");
        }
    }
    
    public function _validateState($post_data)
    {
        if($this->validation_object->required($post_data) == TRUE)
        {
            $this->validation_object->setMasterFieldData("Please enter the state.", "state", "error");
        }
    }
    
    public function _validateAdd1($post_data)
    {
        if($this->validation_object->required($post_data) == TRUE)
        {
            $this->validation_object->setMasterFieldData("Please enter the address.", "add1", "error");
        }
    }
    
    public function _validateCountry($post_data)
    {
        if($this->validation_object->required($post_data) == TRUE)
        {
            $this->validation_object->setMasterFieldData("Please select the country.", "country", "error");
        }
    }
    
    public function _validatePhone($post_data)
    {
        if($this->validation_object->required($post_data) == TRUE)
        {
            $this->validation_object->setMasterFieldData("Please enter the phone number.", "phone", "error");
        }
        else if(!intval($post_data))
        {
            $this->validation_object->setMasterFieldData("Please enter the valid phone number.", "phone", "error");
        }
    }
    
    public function _validateDob($post_data)
    {
        if($this->validation_object->required($post_data) == TRUE)
        {
            $this->validation_object->setMasterFieldData("Please enter the date.", "dob", "error");
        }
        else if($this->validation_object->valid_date($post_data) == FALSE)
        {
            $this->validation_object->setMasterFieldData("Please enter a valid date.", "dob", "error");
        }
        
    }
    
    public function _validateLastName($post_data)
    {
        if($this->validation_object->required($post_data) == TRUE)
        {
            $this->validation_object->setMasterFieldData("Please enter the last name.", "last_name", "error");
        }
    }
    
    public function step2()
    {    
        if(!isset($_SESSION["reg_step_1"]))
        {
            header("Location: http://localhost/fortunefx/signup/step1");
            exit;
        }
        if(isset($_POST["save_cont"]))
        {
            $this->validation_object->setValidationCheck("email_id", "callback__validateEmail", $this);
            $this->validation_object->setValidationCheck("password", "callback__validatePassword", $this);
            $this->validation_object->setValidationCheck("confirm_password", "callback__validateConfirmPassword", $this);
            $this->validation_object->setValidationCheck("security_question", "callback__validateSecQ", $this);
            $this->validation_object->setValidationCheck("answer", "callback__validateAnswer", $this);
            
        }
        if($this->validation_object->runValidator() == FALSE)
        {
            $data["questions"] = $this->_getSecurityQuestions();
            $data["title"] = "Account Credentials | Fortune FX Registration | Step 2";
            $this->view->render("templates/header", $data);
            $this->view->render("templates/main_page");
            $this->view->render("signup/step2", $data);
            $this->view->render("templates/footer");
        }
        else
        {
            $email_id = htmlentities($_POST["email_id"]);
            $password = htmlentities($_POST["password"]);
            $confirm_password = htmlentities($_POST["confirm_password"]);
            $security_question = htmlentities($_POST["security_question"]);
            $answer = htmlentities($_POST["answer"]);
            
            $step2_details = array(
                                  "email_id" => $email_id,
                                  "password" => $password,
                                  "confirm_password" => $confirm_password,
                                  "security_question" => $security_question,
                                  "answer" => $answer
                                  );
            $_SESSION["reg_step_2"] = $step2_details;
            header("Location: http://localhost/fortunefx/signup/step3");
        }
    }
    
    public function _validateAnswer($post_data)
    {
        if($this->validation_object->required($post_data) == TRUE)
        {
            $this->validation_object->setMasterFieldData("Please enter the answer.", "answer", "error");
        }
    }
    
    public function _validateSecQ($post_data)
    {
        if($this->validation_object->required($post_data) == TRUE)
        {
            $this->validation_object->setMasterFieldData("Please select the security question.", "security_question", "error");
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
    public function _validateEmail($post_data)
    {
        if($this->validation_object->required($post_data) == TRUE)
        {
            $this->validation_object->setMasterFieldData("Please enter the email.", "email_id", "error");
        }
        if($this->validation_object->valid_email($post_data) == FALSE)
        {
            $this->validation_object->setMasterFieldData("Please enter a valid email.", "email_id", "error");
        }
        if(!$this->model->checkEmail($post_data))
        {
            $this->validation_object->setMasterFieldData("Email not available.", "email_id", "error");
        }
    }
    
    
    public function step3()
    {
        if(!isset($_SESSION["reg_step_2"]))
        {
            header("Location: http://localhost/fortunefx/signup/step2");
            exit;
        }
        if(isset($_POST["save_cont"]))
        {
            $this->validation_object->setValidationCheck("card_type", "callback__validateCardType", $this);
            $this->validation_object->setValidationCheck("holder_name", "callback__validateHolderName", $this);
            $this->validation_object->setValidationCheck("card_number", "callback__validateCardNumber", $this);
            $this->validation_object->setValidationCheck("ccv", "callback__validateCCV", $this);
            $this->validation_object->setValidationCheck("expiry", "callback__validateExpiry", $this);
        }
        if($this->validation_object->runValidator() == FALSE)
        {
            $data["title"] = "Funding Details | Fortune FX Registration | Step 3";
            $this->view->render("templates/header", $data);
            $this->view->render("templates/main_page");
            $this->view->render("signup/step3", $data);
            $this->view->render("templates/footer");
        }
        else
        {
            $holder_name = htmlentities($_POST["holder_name"]);
            $card_number = str_replace(" ", "", htmlentities($_POST["card_number"]));
            $ccv = htmlentities($_POST["ccv"]);
            $expiry = htmlentities($_POST["expiry"]);
            $card_type = htmlentities($_POST["card_type"]);
            
            $step3_details = array(
                                  "holder_name" => $holder_name,
                                  "card_number" => $card_number,
                                  "ccv" => $ccv,
                                  "expiry" => $expiry,
                                  "card_type" => $card_type
                                  );
            
            $_SESSION["reg_step_3"] = $step3_details;
            header("Location: http://localhost/fortunefx/signup/step4");
        }
        
    }
    
    public function _validateCardType($post_data)
    {
        if($this->validation_object->required($post_data) == TRUE)
        {
            $this->validation_object->setMasterFieldData("Please select the card type.", "card_type", "error");
        }
    }
    
    public function _validateExpiry($post_data)
    {
        if($this->validation_object->required($post_data) == TRUE)
        {
            $this->validation_object->setMasterFieldData("Please enter the expiry date.", "expiry", "error");
        }
        else
        {
            if(strpos($post_data, "/") === FALSE)
            {
                $this->validation_object->setMasterFieldData("Please enter a valid date.", "expiry", "error");
            }
            else
            {
                $splitted_data = explode("/", $post_data);
                if(intval($splitted_data[0]) < 1 || intval($splitted_data[0]) > 12)
                {
                    $this->validation_object->setMasterFieldData("Please enter a valid date.", "expiry", "error");
                }
                
                if(strlen($splitted_data[1]) < 4)
                {
                    $this->validation_object->setMasterFieldData("Please enter a valid date.", "expiry", "error");
                }
                 
            }
        }
    }
    
    public function _validateCCV($post_data)
    {
        if($this->validation_object->required($post_data) == TRUE)
        {
            $this->validation_object->setMasterFieldData("Please enter the CCV.", "ccv", "error");
        }
        else
        {
            if(!is_numeric(intval($post_data)))
            {
                $this->validation_object->setMasterFieldData("Please enter the correct CCV.", "ccv", "error");
            }
        }
    }
    
    public function _validateCardNumber($post_data)
    {
        if($this->validation_object->required($post_data) == TRUE)
        {
            $this->validation_object->setMasterFieldData("Please enter the card number.", "card_number", "error");
        }
        else if(!intval($post_data))
        {
           $this->validation_object->setMasterFieldData("Please enter a valid card number.", "card_number", "error"); 
        }
        else if(CreditCardValidator::validCreditCard(htmlentities($_POST["card_number"]), htmlentities($_POST["card_type"]))["valid"] == false)
        {
            $this->validation_object->setMasterFieldData("Card number does not match with card type", "card_number", "error"); 
       
        }
    }
    
    public function _validateHolderName($post_data)
    {
        if($this->validation_object->required($post_data) == TRUE)
        {
            $this->validation_object->setMasterFieldData("Please enter the card holder's name.", "holder_name", "error");
        }
    }
    
    public function complete()
    {
            if(isset($_SERVER["HTTP_REFERER"]) && $_SERVER["HTTP_REFERER"] == "http://localhost/fortunefx/signup/step4")
            {
            $data["title"] = "Congratulaions! Your Account Has Been Created.";
            $this->view->render("templates/header", $data);
            $this->view->render("templates/main_page");
            $this->view->render("signup/complete", $data);
            $this->view->render("templates/footer");
            }
            else
            {
                header("Location: http://localhost/fortunefx");
            }
        
    }
    
    public function step4()
    {
        
        if(!isset($_SESSION["reg_step_3"]))
        {
            header("Location: http://localhost/fortunefx/signup/step3");
            exit;
        }
        
        if(isset($_POST["submit_reg"]))
        {
            $this->validation_object->setValidationCheck("agreement", "callback__validateAgreement", $this);
        }
        if($this->validation_object->runValidator() == FALSE)
        {
        $data["title"] = "Accept Terms & Condition | Fortune FX Registration | Step 4";
        $this->view->render("templates/header", $data);
        $this->view->render("templates/main_page");
        $this->view->render("signup/step4", $data);
        $this->view->render("templates/footer");
        }
        else
        {
            $this->model->registerUser();
            unset($_SESSION["reg_step_1"]);
            unset($_SESSION["reg_step_2"]);
            unset($_SESSION["reg_step_3"]);
            header("Location: http://localhost/fortunefx/signup/complete");
            exit;
        }
    }
    
    public function activate($token = "")
    {
        $msg = "";
        $img = "";
        if($token == "")
        {
            header("Location:http://" . ROOT_URL);
            exit;
        }
        
        if($this->model->isValidToken($token))
        {
            if(!$this->model->isTokenExpired($token))
            {
            $this->model->activateAccount($token);
            $img = "success_icon.png";
            $msg = 'Your account has been successfully activated. Click <a href="http://localhost/fortunefx/login" style="text-decoration:none;color:#0086b3;">here</a> to login to your account.';
            }
            else
            {
                $img = "warning_icon.png";
                $msg = "Error! The activation key is not valid or expired.";
            }
        }
        else
        {
            $img = "warning_icon.png";
            $msg = "Error! The activation key is not valid or expired.";
        }
        $data["title"] = "Account Activation - Fortune FX";
        $data["msg"] = $msg;
        $data["icon"] = $img;
        $this->view->render("templates/header", $data);
        $this->view->render("templates/main_page");
        $this->view->render("signup/activation", $data);
        $this->view->render("templates/footer");
    }
    
    public function _validateAgreement($post_data)
    {
        if($this->validation_object->required($post_data) == TRUE)
        {
            $this->validation_object->setMasterFieldData("<br/>Please accept the terms and conditions.", "agreement", "error");
        }
    }
    
    public function _getSecurityQuestions()
    {
        return $this->model->getSecurityQuestions();
    }
    
    public function _validateTitle($post_data)
    {
        if($this->validation_object->required($post_data) == TRUE)
        {
            $this->validation_object->setMasterFieldData("Please enter the title.", "title_salute", "error");
        }
    }
    
    public function _validateFirstName($post_data)
    {
        if($this->validation_object->required($post_data) == TRUE)
        {
            $this->validation_object->setMasterFieldData("Please enter the first name.", "first_name", "error");
        }
    }
}