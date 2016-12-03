<?php

$host = "localhost";
$databaseName = "db";
$user = "root";
$password = "root";

$db = new PDO("mysql:host=".$host.";dbname=".$databaseName,
				$user,
				$password);

function db(){
	global $db;
	return $db;
}

?>
