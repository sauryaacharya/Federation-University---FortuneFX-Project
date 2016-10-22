<?php
class AllcurrencyController extends Controller {
    
    public function __construct(Registry $registry, Model $model) {
        parent::__construct($registry, $model);
        
    }
    
    public function index()
    {
        $data["title"] = "All Currency Pair";
        $this->view->render("templates/header", $data);
        $this->view->render("templates/main_page");
        $this->view->render("allcurrency/index", $data);
        $this->view->render("templates/footer");
    }
}

