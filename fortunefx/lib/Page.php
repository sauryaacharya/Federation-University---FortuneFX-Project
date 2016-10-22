<?php
class Page {
    private $page_heading;
    private $page_title;
    private $page_content;
    private $meta_keywords;
    private $meta_description;
    //private $meta_robots;
    
    public function __construct() {
        
    }
    public function getPageHeading()
    {
        return $this->page_heading;
    }
    
    public function setPageHeading($page_heading)
    {
        $this->page_heading = $page_heading;
    }
    
    public function getPageTitle()
    {
        return $this->page_title;
    }
    
    public function setPageTitle($page_title)
    {
        $this->page_title = $page_title;
    }
    
    public function getPageContent()
    {
        return $this->page_content;
    }
    
    public function setPageContent($page_content)
    {
        $this->page_content = $page_content;
    }
    
    public function getMetaKeyWords()
    {
        return $this->meta_keywords;
    }
    
    public function setMetaKeyWords($meta_keywords)
    {
        $this->meta_keywords = $meta_keywords;
    }
    
    public function getMetaDesc()
    {
        return $this->meta_description;
    }
    
    public function setMetaDesc($meta_description)
    {
        $this->meta_description = $meta_description;
    }
    
}

