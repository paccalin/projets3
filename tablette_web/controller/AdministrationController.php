<?php

class AdministrationController extends Controller{
	public function creerUtilisateur(){
		if($_SESSION['droits']>=1){
			$this->render("formCreationCompte",null,"0");
		}else{
			$this->render("erreurAutorisation");
		}
	}

	public function creerAdministrateur(){
		if($_SESSION['droits']>=2){
			$this->render("formCreationCompte",null,"1");
		}else{
			$this->render("erreurAutorisation");
		}
	}

	public function verifieCreationCompte(){
		global $globOption;
		if($_POST['motPasse']!=$_POST['motPasse2']){
			$this->render("erreurCreation","Les mots de passe saisis sont différents.");
		}elseif($_POST['identifiant']==""){
			$this->render("erreurCreation","Veuillez saisir un identifiant.");
		}elseif($_POST['motPasse']==""){
			$this->render("erreurCreation","Veuillez saisir un mot de passe.");
		}elseif(false){
			$this->render("erreurCreation","Ce compte utilisateur existe déjà.");
		}elseif(false){
			$this->render("erreurCreation","Il y a déjà un compte administrateur correspondant à ce nom.");
		}else{
			$this->render("reussiteCreation",null,$globOption);
		}
	}
}
?>
