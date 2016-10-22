<?php
class IndexController extends Controller {
    
    public function __construct(Registry $registry, Model $model) {
        parent::__construct($registry, $model);
        
    }
    
    public function index()
    {
        $data["main_news"] = $this->getTechnicalNews();
        $data["title"] = "Welcome to the site";
        $this->view->render("templates/header", $data);
        $this->view->render("templates/slider");
        $this->view->render("templates/main_page");
        $this->view->render("index/index", $data);
        $this->view->render("templates/footer");
    }
    
    private function getTechnicalNews()
    {
        $curl = curl_init("http://localhost/fortunefx/ajaxservice/getTechnicalNews");
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        $data = curl_exec($curl);
        curl_close($curl);
        return json_decode($data, true);
    }
}