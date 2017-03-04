<?php

class CentraleMajController extends Controller{

	public function afficher(){
		$data['tablettes']=Tablette::FindAll();
		$this->render('index',$data);
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
			//Socket::TransfertT2C();			

			//On copie sur dbTablette() les sockets destinés à centrale db -> dbT
			//Socket::TransfertC2T();

			//header('Location: http://'.parameters()['ip'].'8080');
		}
	}

	static public function initialiseDb(){
		global $dbTab;
		$host = parameters()['ip'];
		$databaseName = "projet";
		$user = "root";
		$password = "";		
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
