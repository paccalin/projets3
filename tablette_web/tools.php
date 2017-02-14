<?php

function __autoload($name) {

	$dir = "model";
	if (strpos($name,"Controller") !== FALSE)
		$dir = "controller";
	if (strpos($name,"Ajax") !== FALSE)
		$dir = "ajax";
	echo($dir."/".$name.".php");
	include_once $dir."/".$name.".php";


}

