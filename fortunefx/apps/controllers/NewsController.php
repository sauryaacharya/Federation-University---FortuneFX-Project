<?php
class NewsController extends Controller {
    
    public function __construct(Registry $registry, Model $model) {
        parent::__construct($registry, $model);
        
    }
    
    public function index()
    {
        $data["breaking_news"] = $this->getBreakingNews();
        $data["technical_news"] = $this->getTechnicalNews();
        $data["fx_ind_news"] = $this->getFxIndustryNews();
        $data["fundamental_news"] = $this->getFundamentalNews();
        $data["ent_news"] = $this->getEntertainmentNews();
        $data["title"] = "Hot and Latest Forex News";
        $this->view->render("templates/header", $data);
        $this->view->render("templates/main_page");
        $this->view->render("news/news", $data);
        $this->view->render("templates/footer");
    }
    
    public function breakingnews()
    {
        $data["breaking_news"] = $this->getBreakingNews();
        $data["title"] = "Breaking News @ Fortune FX";
        $this->view->render("templates/header", $data);
        $this->view->render("templates/main_page");
        $this->view->render("news/breakingnews", $data);
        $this->view->render("templates/footer");
    }
    
    private function getBreakingNews()
    {
        $curl = curl_init("http://localhost/fortunefx/ajaxservice/getBreakingNews");
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        $data = curl_exec($curl);
        curl_close($curl);
        return json_decode($data, true);
    }
    
    public function technicalnews()
    {
        $data["title"] = "Technical Analysis News @ Fortune FX";
        $data["technical_news"] = $this->getTechnicalNews();
        $this->view->render("templates/header", $data);
        $this->view->render("templates/main_page");
        $this->view->render("news/technicalnews", $data);
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
    
    public function fxindustrynews()
    {
        $data["title"] = "Forex Industry News @ Fortune FX";
        $data["fx_ind_news"] = $this->getFxIndustryNews();
        $this->view->render("templates/header", $data);
        $this->view->render("templates/main_page");
        $this->view->render("news/fxindustrynews", $data);
        $this->view->render("templates/footer");
    }
    
    private function getFxIndustryNews()
    {
        $curl = curl_init("http://localhost/fortunefx/ajaxservice/getFxIndustryNews");
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        $data = curl_exec($curl);
        curl_close($curl);
        return json_decode($data, true);
    }
    
    public function fundamentalanalysisnews()
    {
        $data["title"] = "Fundamental Analysis News @ Fortune FX";
        $data["fundamental_news"] = $this->getFundamentalNews();
        $this->view->render("templates/header", $data);
        $this->view->render("templates/main_page");
        $this->view->render("news/fundamental_analysis_news", $data);
        $this->view->render("templates/footer");
    }
    
    private function getFundamentalNews()
    {
        $curl = curl_init("http://localhost/fortunefx/ajaxservice/getFundamentalNews");
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        $data = curl_exec($curl);
        curl_close($curl);
        return json_decode($data, true);
    }
    
    public function entertainmentnews()
    {
        $data["title"] = "Entertaining Forex News @ Fortune FX";
        $data["ent_news"] = $this->getEntertainmentNews();
        $this->view->render("templates/header", $data);
        $this->view->render("templates/main_page");
        $this->view->render("news/entertainmentnews", $data);
        $this->view->render("templates/footer");
    }
    
    private function getEntertainmentNews()
    {
        $curl = curl_init("http://localhost/fortunefx/ajaxservice/getEntertainmentNews");
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        $data = curl_exec($curl);
        curl_close($curl);
        return json_decode($data, true);
    }
}