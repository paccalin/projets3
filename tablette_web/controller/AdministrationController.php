<?php

class AdministrationController extends Controller{

	public function creerCompte(){
		if($_SESSION['droits']>=2){
			$this->render("formCreationCompte");
		}else{
			$this->render("erreurAutorisation");
		}
	}

	public function verifieCreationCompte(){
		if(!isset($_POST['submit'])){
			if(!isset($_POST['cancel'])){
				$this->render("formCreationCompte");
			}else{
				header('Location: ./?r=administration/gererComptes');
			}
		}else{
			$user = Utilisateur::findByPseudo($_POST['identifiant']);
			$data=array();
			$data['erreurSaisies']=array();
			if($user!=null){
				if($user->droits==1){
					array_push($data['erreurSaisies'],"Il y a déjà un compte commercial à ce nom.");
				}elseif($user->droits==2){
					array_push($data['erreurSaisies'],"Il y a déjà un compte administrateur à ce nom.");
				}elseif($user->droits==3){
					array_push($data['erreurSaisies'],"Il y a déjà un compte super administrateur à ce nom.");
				}
			}
			if($_POST['identifiant']==""){
				array_push($data['erreurSaisies'],"Le champ identifiant est vide.");
			}
			if($_POST['motPasse']==""){
				array_push($data['erreurSaisies'],"Le champ mot de passe est vide.");
			}
			if($_POST['motPasse']!=$_POST['motPasse2']){
				array_push($data['erreurSaisies'],"Les mots de passe saisis sont différents.");
			}
			if($data['erreurSaisies']!=[]){
				$this->render("formCreationCompte",$data);
			}else{
				/** Insertion BD **/
				$newUser = new Utilisateur($_POST['identifiant'],$_POST['motPasse'],$_POST['droits']);
				Utilisateur::insert($newUser);
				Socket::store('centrale','insert','utilisateur',$newUser->toJson());
				header('Location: ./?r=administration/gererComptes');
			}
		}
	}

	public function gererComptes(){
		include_once("model/Utilisateur.php");
		if($_SESSION['droits']>=2){
			$users = Utilisateur::findAll();
			$data = array();
			$droits = ['Commercial','Administrateur','Super-administrateur'];
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
				if($_POST['motPasse']!=""){
					if(!isset($_GET['pseudo'])){
						$user = Utilisateur::FindByPseudo($_SESSION['identifiant']);
					}else{
						$user = Utilisateur::FindByPseudo($_GET['pseudo']);
						if($user->droits==3){
							$this->render("erreurAutorisation");
						}
					}
					$user->motDePasse=$_POST['motPasse'];
					Utilisateur::Update($user);
					Socket::store('centrale','update','utilisateur',$user->toJson());
					$this->render("reussiteChangementMotPasse");
				}else{
					$this->render("formChangementMotDePasse","Erreur: le mot de passe est vide");	
				}
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
			Socket::store('centrale','update','utilisateur',$user->toJson());
		}
		header("Location: ./?r=administration/gererComptes");
	}

	public function reduitDroits(){
		include_once("model/Utilisateur.php");
		$user = Utilisateur::FindByID($_GET['id']);
		$user->droits=$user->droits-1;
		Utilisateur::Update($user);
		Socket::store('centrale','update','utilisateur',$user->toJson());
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
			Socket::store('centrale','delete','utilisateur',$user->toJson());
		}
		header("Location: ./?r=administration/gererComptes");
	}
}
?>
