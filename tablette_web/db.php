<?php
$host = "localhost";
$databaseName = "showRoom";
$user = "root";
$password = "123";

$db = new PDO("mysql:host=".$host.";dbname=".$databaseName,
				$user,
				$password);

function db(){
	global $db;
	return $db;
}
?>
