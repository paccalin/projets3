<?php
$host = "localhost";
$databaseName = "showRoom";
$user = "root";
$password = "123";

$db = new PDO("mysql:host=".$host.";dbname=".$databaseName,
				$user,
				$password);
$db->exec("SET CHARACTER SET utf8");

function db(){
	global $db;
	return $db;
}
?>
