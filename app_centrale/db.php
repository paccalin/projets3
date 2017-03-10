<?php
$host = "localhost";
$databaseName = "moalexan";
$user = "moalexan";
$password = "BCiXck";

$db = new PDO("mysql:host=".$host.";dbname=".$databaseName,$user,$password);
$db->exec("SET CHARACTER SET utf8");

function db(){
	global $db;
	return $db;
}
?>
