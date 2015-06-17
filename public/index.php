<?php
include('config.php');
include('helpers/func.php');
include('helpers/loader.php');
include('helpers/db.php');

$current_page = isset($_GET['con']) ? $_GET['con'] : FRONT_PAGE;
$current_func = isset($_GET['func']) ? $_GET['func'] : "FIRST";

// check if 
include("_controllers/{$current_page}.php");

$controller = new $current_page();
$controller->$current_func();
$controller->end();