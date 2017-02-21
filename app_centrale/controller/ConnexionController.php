<?php
class ConnexionController extends Controller{
	public function connexion(){
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
					header('Location: ./?r=site/index');
				}else{
					$this->render('displayConnexionEchec',"Le mot de passe est incorrect.");
				}
			}else{
				$this->render('displayConnexionEchec',"Ce compte n'existe pas.");
			}
		}
		
	}

	public function visualiser(){
		//print_r($_SESSION);
		$data['utilisateur']=Utilisateur::FindById($_SESSION['utilisateur']);
		$data['client']=Client::FindById($_SESSION['client']);
		$this->render('visualiserConnexion',$data);
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
		if($_SESSION['mode']=='utilisateur'){
			if(!isset($_POST['submit'])){
				$this->render('formLiaisonClient');
			}elseif(isset($_POST['cancel'])){
				
			}else{
				$_SESSION['client']=$_POST['client'];
				if(isset($_GET['retour'])){
					header('Location: ./?r='.$_GET['retour']);
				}else{
					header('Location: ./?r=site/index');
				}
			}
		}else{
			$this->render('403');
		}
	}
	
	public function changeClient(){
		$this->ajouterClient();
	}
	
	public function delierClient(){
		if($_SESSION['mode']=='utilisateur'){
			$_SESSION['client']=-1;
			if(isset($_GET['retour'])){
				header('Location: ./?r='.$_GET['retour']);
			}else{
				header('Location: ./?r=site/index');
			}
		}else{
			$this->render('403');
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
	
	public function changerMotPasse(){
		if(isset($_POST['submit'])){
			$data['erreurSaisie']=[];
			$user = Utilisateur::FindById($_SESSION['utilisateur']);
			if($_POST['motPasseAct']!=$user->motDePasse){
				array_push($data['erreurSaisie'],'Le mot de passe actuel est incorrect');
			}
			if($_POST['motPasse1']!=$_POST['motPasse2']){
				array_push($data['erreurSaisie'],'Les mots de passe ne corresponent pas');
			}
			if($_POST['motPasse1']==""){
				array_push($data['erreurSaisie'],'Le nouveau mot de pase est vide');
			}
			if($data['erreurSaisie']!=[]){
				$this->render("formChangementMotDePasse",$data);
			}else{
				$user->motDePasse=$_POST['motPasse1'];
				Utilisateur::Update($user);
				Socket::store('tablette','update','utilisateur',$user);
				header('Location: .?r=connexion/visualiser');
			}
		}elseif(isset($_POST['cancel'])){
			header("Location: ./?r=site/index");
		}else{
			$this->render("formChangementMotDePasse");
		}
	}
}
?>
