<?php
class Exceptions {
    
    public $exception_msg;
    
    public function __construct() {
        
    }
    
    // FORM EXCEPTION 
    
    public function throwMasterFieldDataException($type)
    {
        try
        {
            throw new Exception();
        }
        catch(Exception $e)
        {
            $html = "
                    <div style=\"border:1px solid red;background:#ffffe5;width:100%;\">
                    <div style=\"padding:20px;border:1px solid #000000;\">
                    <h1 style=\"margin:0px;padding:0px;\">FormValidation Class Error</h1>
                    The type ''{$type}'' of master field data is invalid.
                    </div>
                    </div>
                    ";
                    
                    
                    
                    
            return $this->exception_msg = $html;
        }
    }
}

