<?php 

session_start();

$_SESSION['connecter'] = True;

echo json_encode($_SESSION['connecter']);

?>