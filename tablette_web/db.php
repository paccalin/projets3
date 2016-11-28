<?php

$host = "localhost";
$port = "5432";
$databaseName = "showRoomContent";
$user = "postgres";
$password = "123";

$db = new PDO("pgsql:host=".$host.";
				port=".$port.";
				dbname=".$databaseName.";
				user=".$user.";
				password=".$password);

function db(){
	global $db;
	return $db;
}

?>