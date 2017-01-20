<?php
class ClientController extends Controller{

	public function creer(){
		if($_SESSION['droits']>=1){
			if(!isset($_POST['nom'])){
				$this->render("formCreationClient");
			}else{
				$data=array();
				$data['erreursSaisie']=array();
				if(false){/* Gestion des erreurs de saisie */
					array_push($data['erreurSaisies'],"Erreur de saisie 1");
				}
				if(false){
					array_push($data['erreurSaisies'],"Erreur de saisie 2");
				}
				if(false){
					array_push($data['erreurSaisies'],"Erreur de saisie 3");
				}
				if($data['erreursSaisie']!=[]){
					$this->render("formCreationRendezvous",$data);
				}else{
					$newClient = new Client($_POST['nom'],$_POST['prenom'],$_POST['rue'],$_POST['ville'],$_POST['cp'],$_POST['mail'],$_POST['telephone']);
					Client::insert($newClient);
					Socket::store('centrale','insert','client',$newClient);
					header('Location: ./?r=client/afficherParId&id='.$newClient->id);
				}
			}
		}else{
			$this->render("erreurAutorisation");
		}
	}
	
	public function afficherTous(){
		$clientsObj=Client::findAll();
		$clients=array();
		foreach($clientsObj as $clientObj){
			$client=["id"=>$clientObj->id,"nom"=>$clientObj->nom,"prenom"=>$clientObj->prenom,"adresse"=>$clientObj->rue,"ville"=>$clientObj->ville,"mail"=>$clientObj->mail,"tel"=>$clientObj->tel];
			array_push($clients, $client);
		}
		$this->render("affichageClientAll",$clients);
	}
	
	public function afficherParId(){
		include_once("./model/Modele.php");
		$clientObj=Client::findByID($_GET['id']);
		$data=array();
		$data['vehicules']=array();
		$data['client']=["id"=>$clientObj->id,"nom"=>$clientObj->nom,"prenom"=>$clientObj->prenom,"adresse"=>$clientObj->rue,"ville"=>$clientObj->ville,"mail"=>$clientObj->mail,"tel"=>$clientObj->tel];
		$vehicules=Vehicule::FindByProprietaireID($clientObj->id);
		foreach($vehicules as $vehicule){
			/* Pourquoi $vehicule->modele marche alors que c'est un objet PHP et pas un simple champ texte $vehicule->modele->libelle matche pas*/
			array_push($data['vehicules'],["marque"=>$vehicule->modele->constructeur->libelle,"modele"=>$vehicule->modele,"immatriculation"=>$vehicule->immatriculation]);
		}
		$this->render("affichageClientId",$data);
	}
	
	public function rechercher(){
		if(isset($_POST['recherche'])){
			$clientsObj=Client::FindByString($_POST['recherche']);
			$clients=array();
			$clients['resultat']=array();
			foreach($clientsObj as $clientObj){
				$client=["id"=>$clientObj->id,"nom"=>$clientObj->nom,"prenom"=>$clientObj->prenom,"adresse"=>$clientObj->rue,"ville"=>$clientObj->ville,"mail"=>$clientObj->mail,"tel"=>$clientObj->tel];
				array_push($clients['resultat'], $client);
			}
			if($clients['resultat']==[]){
				$clients['message']="Aucun client trouvé";
			}
			$this->render("formRecherche",$clients);
		}else{
			$this->render("formRecherche");
		}
	}

	public function modifier(){
		if($_SESSION['droits']>=1){
			if(!isset($_POST['nom'])){
				$clientObj=Client::findByID($_GET['id']);
				$data=["id"=>$clientObj->id,"nom"=>$clientObj->nom,"prenom"=>$clientObj->prenom,"rue"=>$clientObj->rue,"ville"=>$clientObj->ville,"cp"=>$clientObj->cp,"mail"=>$clientObj->mail,"tel"=>$clientObj->tel];
				$this->render("formModificationClient",$data);
			}else{
				if(false){/* Gérer le erreur de saisie */
					$data=["erreurSaisies"=>"Il y a des erreurs de saisie"];
					$this->render("formModificationClient",$data);
				}else{
					$updateClient= new Client($_POST['nom'], $_POST['prenom'], $_POST['rue'], $_POST['ville'], $_POST['cp'], $_POST['mail'], $_POST['tel'], null, $_GET['id']);
					Client::update($updateClient);
					Socket::store('centrale','update','client',$updateClient);
					$_POST = array();
					$this->afficherParId();
				}
			}
		}
	}
}
?>
