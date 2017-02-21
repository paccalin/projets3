<?php

// Debug. Désactiver en prod
error_reporting(E_ALL | E_STRICT);
ini_set('display_errors', true);

include_once "db.php";
include_once "tools.php";

session_start(); 

include_once "view/head.php";
date_default_timezone_set('Australia/Melbourne');
include_once "controller/route.php";
include_once "view/footer.php";
?>
