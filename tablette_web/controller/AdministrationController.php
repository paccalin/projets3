<?php

class AdministrationController extends Controller{
	public function creerCompte(){
		if($_SESSION['droits']>=1){
			$this->render("formCreationCompte");
		}else{
			$this->render("erreurAutorisation");
		}
	}

	public function verifieCreationCompte(){
		include_once("model/Utilisateur.php");
		$user = Utilisateur::findByPseudo($_POST['identifiant']);
		if($user!=null){
			if($user->droits==1){
				$this->render("erreurCreationCompte","Il y a déjà un compte utilisateur à ce nom.");
			}elseif($user->droits==2){
				$this->render("erreurCreationCompte","Il y a déjà un compte administrateur à ce nom.");
			}elseif($user->droits==3){
				$this->render("erreurCreationCompte","Il y a déjà un compte superadministrateur à ce nom.");
			}
		}elseif($_POST['motPasse']!=$_POST['motPasse2']){
			$this->render("erreurCreationCompte","Les mots de passe saisis sont différents.");
		}elseif($_POST['identifiant']==""){
			$this->render("erreurCreationCompte","Veuillez saisir un identifiant.");
		}elseif($_POST['motPasse']==""){
			$this->render("erreurCreationCompte","Veuillez saisir un mot de passe.");
		}else{
			/** Insertion BD **/
			$this->render("reussiteCreationCompte");
		}
	}
}
?>
