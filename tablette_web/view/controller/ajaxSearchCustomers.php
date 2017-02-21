<?php

include_once('../db.php');
include_once('../model/Model.php');
include_once('../model/Client.php');

if(isset($_GET['recherche'])){
	$recherche = $_GET['recherche'];
	$clients = Client::findByString($recherche);
	$retour = [];
	foreach($clients as $client){
		$value = $client->nom." ".$client->prenom;
		$retour[$client->id] = $value;
	}
	echo json_encode($retour);
}else{
	echo '<h1>Erreur 403</h1>';
	echo '<p>Vous n\'avez pas le droit d\'être là</p>';
}

?>