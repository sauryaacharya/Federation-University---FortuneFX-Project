<?php

class FormValidation {

    //private $validation_rules = array();
    private $master_field_data = array();
    private $error_array = array();
    private $form_data = array();
    private $prefix = "";
    private $suffix = "";
    public $error = FALSE;
    private $obj;

    public function __construct() {
        
    }

    public function setMasterFieldData($value, $key, $type) {
    if($type == "error" || $type == "func" || $type == "fieldname" || $type == "postdata")
    {
        $this->master_field_data[$key][$type] = $value;
    }
    else
    {
        echo throwMasterFieldDataException($type);
    }
    }

    public function setValidationCheck($fieldname, $callable_func, Controller $controller) {
        $this->obj = $controller;
        if ($_SERVER["REQUEST_METHOD"] !== "POST" && empty($this->form_data)) {
            return $this;
        }
        if ($fieldname === "" OR empty($callable_func)) {
            return $this;
        }

        $this->master_field_data[$fieldname] = array(
            "fieldname" => $fieldname,
            "func" => $callable_func,
            "postdata" => NULL,
            "error" => ""
        );
        // return $this;
    }

    public function runValidator() {
        
        $form_data_array = empty($this->form_data) ? $_POST : $this->form_data;
        $this->form_data = $form_data_array;
        //print_r($form_data_array);
        if (count($form_data_array) === 0) {
            return FALSE;
        }
        
        if (count($this->master_field_data) === 0) {
            echo "Validation not set";
            return FALSE;
        }

        foreach ($this->master_field_data as $key => $value) {
            if (isset($form_data_array[$key])) {
                $this->master_field_data[$key]["postdata"] = $form_data_array[$key];
            }
        }

        foreach ($this->master_field_data as $key => $value) {
            if (empty($value["func"])) {
                continue;
            }
            $this->validateData($value["func"], $value, $value["postdata"]);
        }

        $total_errors = count($this->error_array);
        return ($total_errors === 0);
        
    }

    public function validateData($callable_func, $value, $post_data) {
        $callback = FALSE;
        $callback = $callable = FALSE;
        if (strpos($callable_func, "callback") !== FALSE) {
            $callable_func = substr($callable_func, 9);
            $callback = TRUE;
        } else if (is_callable($callable_func)) {
            $callable = TRUE;
        }

        if ($callback OR $callable !== FALSE) {
            if ($callback) {
                if (method_exists($this->obj, $callable_func)) {
                    $this->obj->$callable_func($post_data);
                }
            }
        }
        if ($this->master_field_data[$value["fieldname"]]["error"] !== "") {
            $err_msg = $this->master_field_data[$value["fieldname"]]["error"];
            $this->error_array[$value["fieldname"]] = $err_msg;
            /*
              $total_errors = count($this->error_array);
              if ($total_errors === 0) {
              $this->error = FALSE;
              }
             * 
             */
        }
    }

    public function set_radio($radioname, $value) {
        if (!isset($this->form_data, $this->form_data[$radioname])) {
            return "";
        } else if (isset($this->form_data[$radioname]) && $this->form_data[$radioname] == $value) {
            return "checked";
        }
    }

    public function set_checkbox($checkboxname, $value) {
        $check_box = array();
        if (isset($this->form_data, $this->form_data[$checkboxname])) {
            if (is_array($this->form_data[$checkboxname])) {
                $check_box = $this->form_data[$checkboxname];
                if (is_array($check_box)) {
                    if (in_array($value, $check_box)) {
                        return "checked";
                    }
                }
            } else {
                if (!isset($this->form_data, $this->form_data[$checkboxname])) {
                    return "";
                } else if (isset($this->form_data[$checkboxname]) && $this->form_data[$checkboxname] == $value) {
                    return "checked";
                }
            }
        }
    }

    public function set_value($fieldname) {
        if (!isset($this->form_data, $this->form_data[$fieldname])) {
            return "";
        }
        return htmlspecialchars($this->form_data[$fieldname]);
    }

    public function set_select($select_name, $value) {
        if (!isset($this->form_data, $this->form_data[$select_name])) {
            return "";
        } else if (isset($this->form_data[$select_name]) && $this->form_data[$select_name] == $value) {
            return "selected";
        }
    }

    public function getValidationCheck() {
        return $this->master_field_data;
    }

    public function individual_error($fieldname, $prefix = "", $suffix = "") {
        if (empty($this->master_field_data[$fieldname]["error"])) {
            return "";
        }
        if ($prefix === "") {
            $prefix = $this->prefix;
        }
        if ($suffix === "") {
            $suffix = $this->suffix;
        }
        return $prefix . $this->master_field_data[$fieldname]["error"] . $suffix;
    }

    public function required($str) {
        if ($str == "") {
            return TRUE;
        } else {
            return FALSE;
        }
    }

    public function valid_email($email_str) {
        return (bool) filter_var($email_str, FILTER_VALIDATE_EMAIL);
    }

    public function valid_date($date_str) {
        if(strpos($date_str, "/") === false)
        {
            return false;
        }
        else
        {
        $date_str_split = explode("/", $date_str);
        if(intval($date_str_split[1]) && intval($date_str_split[2]) && intval($date_str_split[0]))
        {
        return (bool) checkdate($date_str_split[0], $date_str_split[1], $date_str_split[2]);
        }
        else
        {
            return false;
        }
        }
    }

    public function valid_int($num) {
        return (bool) filter_var($num, FILTER_VALIDATE_INT);
    }

    public function valid_url($url) {
        return (bool) filter_var($url, FILTER_VALIDATE_URL);
    }

    public function valid_ip($ip) {
        return (bool) filter_var($ip, FILTER_VALIDATE_IP);
    }

}
