<?php
	class miseAJour extends Controller {
		public function index(){
		}
		if(!isset($_GET['ip'])){
			echo 'Accès interdit';
		}elseif($_GET['ip']=='::1' OR $_GET['ip']=='127.0.0.1'){
			echo 'Connexion non autorisée en localhost';
		}else{
			$host = $_GET['ip'];
			$databaseName = "projet";
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
				$requete = "INSERT INTO socket VALUES ('".randomId()."', 'tablette', 'actionner', 'table', '{jsonne}', CURRENT_TIMESTAMP)";
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
		function randomId(){
			$st='';
			$characters = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789';
			$max = strlen($characters) - 1;
			for ($i = 0; $i < 20; $i++) {
				$st .= $characters[mt_rand(0, $max)];
			}
			return $st;
		}
	}
?>
