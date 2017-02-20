<?php
	if(!isset($_GET['ip'])){
		echo 'Access denied';
	}else{
		//préparer l'accès db
		try{
			require_once '/projets3/tablette_web/model/Model.php';
		}catch(Exception $e)	{
			echo $e->getMessage();
		}
		$host = $_GET['ip'];
		$databaseName = "projet"; //Trouver un meilleur nom
		$user = "root";
		$password = "root";		
		try {
			$dbA = new PDO("mysql:host=".$host.";dbname=".$databaseName, $user, $password);
		}catch(Exception $e)	{
			echo $e->getMessage();
		}
		$dbA->exec("SET CHARACTER SET utf8");
		echo 'Réussite de l\'initialisation de la BD';
		//insérer des trucs random
		try {
			$requete = "INSERT INTO socket VALUES ('".Model::randomId()."', 'tablette', 'actionner', 'table', '{jsonne}', CURRENT_TIMESTAMP)";
		}catch(Exception $e)	{
			echo $e->getMessage();
		}
		echo 'Réussite de la création de la requête';
		echo $requete;
		$query = dbA()->prepare($requete);
		$query->execute();
	}
	function dbA(){
		global $dbA;
		return $dbA;
	}
?>
