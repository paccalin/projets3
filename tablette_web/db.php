<?php

$host = "localhost";
$databaseName = "desmazia";
$user = "desmazia";
$password = "HjEA0n";

$db = new PDO("mysql:host=".$host.";dbname=".$databaseName,
				$user,
				$password);

function db(){
	global $db;
	return $db;
}

?>