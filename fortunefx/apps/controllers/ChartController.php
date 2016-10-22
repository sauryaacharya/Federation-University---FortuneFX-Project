<?php
class ChartController extends Controller {
    
    public function __construct(Registry $registry, Model $model) {
        parent::__construct($registry, $model);
        
    }
    
    public function index()
    {
        $data["title"] = "All Currency Pair";
        $this->view->render("templates/header", $data);
        $this->view->render("templates/main_page");
        $this->view->render("chart/chart", $data);
        $this->view->render("templates/footer");
    }
    
    
    public function currencypair($pair = "")
    {
        if($pair == "")
        {
            $controller = new ErrorController($this->registry, new ErrorModel());
            $controller->index();
            exit;
        }
        else
        {
            if($this->model->isValidCurrencyPair($pair))
            {
            $data["heading"] = $pair . ", Live Foreign Exchange Chart";
            $data["title"] = $pair . " | Live Foreign Exchange Chart";
            $data["currency_pair"] = $pair;
            $this->view->render("templates/header", $data);
            $this->view->render("templates/main_page");
            $this->view->render("chart/chart", $data);
            $this->view->render("templates/footer");
            }
            else
            {
               $controller = new ErrorController($this->registry, new ErrorModel());
               $controller->index();
               exit; 
            }
        }
        
    }
}

