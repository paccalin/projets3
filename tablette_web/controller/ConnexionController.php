<?php
class ConnexionController extends Controller{
	public function formConnexion(){
		$this->render("formConnexion");
	}
	public function verifieConnexion(){
		if(isset($_POST['cancel'])){
			header('Location: ./?r=site/index');
		}elseif(isset($_POST['submit'])){
			/*
				intégrer la fonction de connexion avec DB
				pour l'instant, test avec des valeurs locales
			*/
			$users=array();
			$users[0]=['identifiant'=>'jean','motPasse'=>'123','droits'=>'1'];
			$users[1]=['identifiant'=>'marmoud','motPasse'=>'123','droits'=>'2'];
			$users[2]=['identifiant'=>'bob','motPasse'=>'123','droits'=>'3'];
			
			$trouve=False;
			foreach($users as $user){
				if($user['identifiant']==$_POST['identifiant'] and $user['motPasse']==$_POST['motPasse']){
					$_SESSION['droits'] = $user['droits'];
					$_SESSION['identifiant'] = $user['identifiant'];
					$trouve=True;
				}
			}
			if($trouve){
				header('Location: ./?r=connexion/displayConnexionReussite');
			}else{
				header('Location: ./?r=connexion/displayConnexionEchec');
			}
		}
		
	}

	public function deconnexion(){
		$_SESSION['droits'] = 0;
		$_SESSION['identifiant'] = "";
		header('Location: ./?r=site/index');
	}
	public function displayConnexionReussite(){
		$this->render("displayConnexionReussite");
	}

	public function displayConnexionEchec(){
		$this->render("displayConnexionEchec");
	}
}
?>
