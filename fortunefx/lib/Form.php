<?php    
    function render_form($acting_url, $attributes = FALSE)
    {
        $att_key_value = "";
        if($attributes != FALSE)
        {
        foreach($attributes as $key => $value)
        {
            $att_key_value .= " " . $key . "=" . "\"" . $value . "\"";
        }
        }
        $opening_tag = "<form method=\"post\"" . " action=\"http://" .ROOT_URL. "{$acting_url}" . "\"{$att_key_value}>";
        return $opening_tag;
    }
    
    function render_input_text($field_name = NULL, $field_value = NULL, $data = NULL, $extra_attributes = NULL)
    {
        
    }
    
    function set_value($fieldname)
    {
        $obj = getValidationObj();
        return $obj->set_value($fieldname);
    }
    
    function set_radio($radioname, $value)
    {
        $obj = getValidationObj();
        return $obj->set_radio($radioname, $value);
    }
    
    function set_select($select_name, $value)
    {
        $obj = getValidationObj();
        return $obj->set_select($select_name, $value);
    }
    
    function set_checkbox($checkbox_name, $value)
    {
        $obj = getValidationObj();
        return $obj->set_checkbox($checkbox_name, $value);
    }
    
    function form_individual_error($fieldname, $prefix = "", $suffix = "")
    {
        $obj = getValidationObj();
        return $obj->individual_error($fieldname, $prefix, $suffix);
    }
    
    function getValidationObj()
    {
        $registry = Registry::getInstance();
        return $registry->getObject("form_validation");
    }
    
    
  

