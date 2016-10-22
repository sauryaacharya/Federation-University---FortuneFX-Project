<?php
session_start();
ini_set("max_execution_time", 0);
$root_url = $_SERVER["HTTP_HOST"] . "/fortunefx/";
define("ROOT_URL", $root_url);
define("DS", DIRECTORY_SEPARATOR);
define("BASE_PATH", __DIR__);
require_once(BASE_PATH . DS . "lib" . DS . "Loader.php");
require(BASE_PATH . DS . "lib" . DS . "OAuth.php");
$load = new Loader();
$load->loadClass();
$app = new BootStrap();