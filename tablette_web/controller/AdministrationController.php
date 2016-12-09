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
		/* intégrer le user=Utilisateur.findByNom() d'Axel */
		if($_POST['motPasse']!=$_POST['motPasse2']){
			$this->render("erreurCreation","Les mots de passe saisis sont différents.");
		}elseif($_POST['identifiant']==""){
			$this->render("erreurCreation","Veuillez saisir un identifiant.");
		}elseif($_POST['motPasse']==""){
			$this->render("erreurCreation","Veuillez saisir un mot de passe.");
		}elseif(false){
			/*condition: user!=null*/
			/*
			if(user->droits==1){
				$this->render("erreurCreation","Il y a déjà un compte utilisateur à ce nom.");
			}elseif(user->droits==2){
				$this->render("erreurCreation","Il y a déjà un compte administrateur à ce nom.");
			}elseif(user->droits==3){
				$this->render("erreurCreation","Il y a déjà un compte superadministrateur à ce nom.");
			}
			*/
		}elseif(false){
			$this->render("erreurCreation","Il y a déjà un compte administrateur correspondant à ce nom.");
		}else{
			/** Insertion BD **/
			$this->render("reussiteCreationCompte");
		}
	}
}
?>
