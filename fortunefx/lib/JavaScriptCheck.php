<?php
class JavaScriptCheck {
    
    private $js_enabled = false;
    
    
    
    public function __construct() {
        if(!isset($_SESSION["js"]))
        {
            $_SESSION["js"] = false;
        }
        if(!isset($_SESSION["visit_time"]))
        {
            $_SESSION["visit_time"] = 1;   
        }
          
    }
    
    public function isJavaScriptActive()
    {
        echo $_SESSION["visit_time"];
        if(isset($_POST["js"]))
        {
            $_SESSION["js"] = true;
        }
        if($_SESSION["visit_time"] < 2 && $this->js_enabled != true)
        {
            $_SESSION["visit_time"]++;
            echo '<form method="post" id="js" name="js" style="display:none;">'
            . '<input type="text" name="js" value="true"/>'
            . '<script type="text/javascript">document.js.submit();</script>'
            . '</form>';
        }
        $this->js_enabled = $_SESSION["js"];
        return $this->js_enabled;
    }
}