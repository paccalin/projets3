<?php
class ConnexionController extends Controller{
	public function formConnexion(){
		$this->render("formConnexion");
	}
	public function verifieConnexion(){
		if(isset($_POST['cancel'])){
			header('Location: ./?r=site/index');
		}elseif(isset($_POST['submit'])){
			include_once("model/Utilisateur.php");
			$user = Utilisateur::findByPseudo($_POST['identifiant']);
			if($user!=null){
				if ($user->motDePasse==$_POST['motPasse']){
					$_SESSION['identifiant']=$user->pseudo;
					$_SESSION['droits']=$user->droits;
					$this->render('displayConnexionReussite');
				}else{
					$this->render('displayConnexionEchec',"Le mot de passe est incorrect: |".$user->motDePasse."|");
				}
			}else{
				$this->render('displayConnexionEchec',"Ce compte n'existe pas.");
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
