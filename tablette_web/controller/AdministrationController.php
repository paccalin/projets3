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
			$newUser = new Utilisateur($_POST['identifiant'],$_POST['motPasse'],$_POST['droits']);
			Utilisateur::insert($newUser);
			$this->render("reussiteCreationCompte");
		}
	}

	public function gererComptes(){
		include_once("model/Utilisateur.php");
		if($_SESSION['droits']>=2){
			$users = Utilisateur::findAll();
			$data = array();
			$droits = ['Utilisateur','Administrateur','Super-administrateur'];
			foreach($users as $user){
				$usr = array();
				$usr['pseudo']=$user->pseudo;
				$usr['droitsNom']=$droits[$user->droits-1];
				$usr['droitsNb']=$user->droits;
				$usr['id']=$user->id;
				array_push($data,$usr);
			}
			if($_SESSION['droits']==2){
				$this->render("tableauComptesAffichage",$data);
			}else{
				$this->render("tableauComptesGestion",$data);
			}
		}else{
			$this->render("erreurAutorisation");
		}
	}
	
	public function changerMotPasse(){
		if(isset($_POST['submit'])){
			if($_POST['motPasse']==$_POST['motPasse2']){
				include_once("model/Utilisateur.php");
				$user = Utilisateur::FindByPseudo($_SESSION['identifiant']);
				$user->motDePasse=$_POST['motPasse'];
				Utilisateur::Update($user);
				$this->render("reussiteChangementMotPasse");
			}else{
				$this->render("formChangementMotDePasse","Erreur: les mots de passe ne correspondent pas");
			}
		}elseif(isset($_POST['cancel'])){
		header("Location: ./?r=site/index");
		}else{
			$this->render("formChangementMotDePasse");
		}
	}
	
	public function confirmeAugmenteDroit(){
		$this->render("formConfirmationAugmenteDroits");
	}

	public function augmenteDroits(){
		include_once("model/Utilisateur.php");
		$user = Utilisateur::FindByID($_GET['id']);
		if(isset($_POST['submit']) OR $user->droits!=2){
			$user = Utilisateur::FindByID($_GET['id']);
			$user->droits=$user->droits+1;
			Utilisateur::Update($user);
		}
		header("Location: ./?r=administration/gererComptes");
	}

	public function reduitDroits(){
		include_once("model/Utilisateur.php");
		$user = Utilisateur::FindByID($_GET['id']);
		$user->droits=$user->droits-1;
		Utilisateur::Update($user);
		header("Location: ./?r=administration/gererComptes");
	}

	public function confirmeSupression(){
		$this->render("formConfirmationSupprimeCompte");
	}

	public function supprimeCompte(){
		include_once("model/Utilisateur.php");
		$user = Utilisateur::FindByID($_GET['id']);
		if(isset($_POST['submit'])){
			$user = Utilisateur::FindByID($_GET['id']);
			$user->droits=$user->droits+1;
			Utilisateur::Delete($user);
		}
		header("Location: ./?r=administration/gererComptes");
	}
}
?>
