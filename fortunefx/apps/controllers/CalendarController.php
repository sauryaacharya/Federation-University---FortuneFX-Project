<?php
class CalendarController extends Controller {
    
    public function __construct(Registry $registry, Model $model) {
        parent::__construct($registry, $model);
        
    }
    
    public function index()
    {
        $data["title"] = "Economic Calendar @ Fortune FX";
        $this->view->render("templates/header", $data);
        $this->view->render("templates/main_page");
        $this->view->render("calendar/calendar", $data);
        $this->view->render("templates/footer");
    }
}