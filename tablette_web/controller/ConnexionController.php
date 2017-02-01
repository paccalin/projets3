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
					$_SESSION['utilisateur']=$user->id;
					$_SESSION['droits']=$user->droits;
					$data['utilisateur']=$user;
					$this->render('displayConnexionReussite',$data);
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
		$_SESSION['utilisateur'] = -1;
		header('Location: ./?r=site/index');
	}
	public function displayConnexionReussite(){
		$data['utilisateur']=Utilisateur::FindById($_SESSION['utilisateur']);
		$this->render("displayConnexionReussite",$data);
	}

	public function displayConnexionEchec(){
		$this->render("displayConnexionEchec");
	}
	
	public function ajouterClient(){
		if(!isset($_POST['submit'])){
			$this->render('formLiaisonClient');
		}elseif(isset($_POST['cancel'])){
			
		}else{
			$_SESSION['client']=$_POST['client'];
			header('Location: ./?r=site/index');
		}
	}
	
	public function changeClient(){
		if(!isset($_POST['submit'])){
			$this->render('formLiaisonClient');
		}elseif(isset($_POST['cancel'])){
			
		}else{
			$_SESSION['client']=$_POST['client'];
			header('Location: ./?r=site/index');
		}
	}
	
	public function swichUtilisateurClient(){
		if($_SESSION['mode']=='utilisateur'){
			$_SESSION['mode']='client';
			header('Location: ./?r=site/index');
		}else{
			if(!isset($_POST['submit'])){
				$this->render('formEntrerMotDePasse');
			}else{
				$user=Utilisateur::FindById($_SESSION['utilisateur']);
				if($_POST['motPasse']==$user->motDePasse){
					$_SESSION['mode']='utilisateur';
					header('Location: ./?r=site/index');
				}else{
					$data['erreursSaisie']=[];
					array_push($data['erreursSaisie'],'Le mot de passe est faux');
					$this->render('formEntrerMotDePasse',$data);
				}
			}
		}
	}
}
?>
