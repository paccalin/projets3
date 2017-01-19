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
}else{/*
	//erreur 404;
	$recherche = 'mar';
	$res = Client::findByString($recherche);
	$retour = array();
	foreach($res as $client){	
		$value = $client->nom." ".$client->prenom;	
		$retour[$client->id] = $value;
	}
	echo json_encode($retour);
	*/
	echo '<h1>Erreur 403</h1>';
	echo '<p>Vous n\'avez pas le droit d\'être là</p>';
}
/* A quoi sert le code dans le else? A rien du tout non? Si le $_GET['recherche'] est nul
ça veut dire que la personne y est allé à la main donc ça devrait sortir un 403
(et non un 404) -> donc ça fait 8 lignes de code c'est pas trop mal pour 8h de projet
ça fait un bon ratio je pense */
?>