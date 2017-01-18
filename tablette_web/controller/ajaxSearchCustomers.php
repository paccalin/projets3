<?php

include_once('../db.php');
include_once('../model/Model.php');
include_once('../model/Client.php');

if(isset($_GET['recherche'])){
	$recherche = $_GET['recherche'];

	$res = Client::findByString($recherche);
	
	$retour = array();
	
	foreach($res as $client){
		
		$value = $client->nom." ".$client->prenom;
		
		$retour[$client->id] = $value;
	}
	
	echo json_encode($retour);
	
}else{
	//erreur 404;
	$recherche = 'mar';
	
	$res = Client::findByString($recherche);
	
	$retour = array();
	
	foreach($res as $client){
		
		$value = $client->nom." ".$client->prenom;
		
		$retour[$client->id] = $value;
	}
	
	echo json_encode($retour);

}
?>