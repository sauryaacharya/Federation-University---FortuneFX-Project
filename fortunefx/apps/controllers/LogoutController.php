<?php
class LogoutController extends Controller {
    
    public function __construct(Registry $registry, Model $model) {
        parent::__construct($registry, $model);
        
    }
    
    public function index()
    {
        if($_SERVER["REQUEST_METHOD"] == "POST")
        {
            Registry::getObject("authentication")->logout();
            header("Location: http://" . ROOT_URL . "login");
            exit;
        }
        else
        {
            header("Location: http://" . ROOT_URL);
            exit;
        }
    }
}

