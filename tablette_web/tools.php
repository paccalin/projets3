<?php

function __autoload($name) {

	$dir = "model";
	if (strpos($name,"Controller") !== FALSE)
		$dir = "controller";
	if (strpos($name,"Ajax") !== FALSE)
		$dir = "ajax";
	include_once $dir."/".$name.".php";
}

function gereRetour($defaut){
		if(isset(param()['retour'])){
			$data['retour']=str_replace('-','&',$_GET['retour']);
		}else{
			$data['retour']='option/afficherTous';
		}
}

function removeQuote($st){
	return str_replace("'", "\'",$st);
}