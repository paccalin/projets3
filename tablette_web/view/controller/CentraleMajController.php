<?php

class CentraleMajController extends Controller{

	public function afficher(){
		$this->render('index');
	}

	public function miseAJour(){
		if(!isset(parameters()['ip'])){
			$data['erreur']='Accès interdit';
			$this->render('erreurMaj',$data);
		}elseif(parameters()['ip']=='::1' OR parameters()['ip']=='127.0.0.1'){
			$data['erreur']='Connexion non autorisée en localhost';
			$this->render('erreurMaj',$data);
		}else{
			CentraleMajController::initialiseDb();

			//On récupère sur dbTablette() les sockets destinés à centrale dbT -> db
			//print_r(Socket::FindAllOnTabFor('centrale'));
			Socket::TransfertT2C();			

			//On copie sur dbTablette() les sockets destinés à centrale db -> dbT
			Socket::TransfertC2T();

		}
	}

	static public function initialiseDb(){
		global $dbTab;
		$host = parameters()['ip'];
		$databaseName = "projet";
		$user = "root";
		$password = "root";		
		try {
			$dbTab = new PDO("mysql:host=".$host.";dbname=".$databaseName, $user, $password);
		}catch(Exception $e)	{
			echo $e->getMessage();
		}
		$dbTab->exec("SET CHARACTER SET utf8");
		//echo '<p>+Réussite de l\'initialisation de la BD</p>';
	}
	
	static public function dbTablette(){
		global $dbTab;
		return $dbTab;
	}
}
?>
