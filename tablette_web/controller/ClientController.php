<?php
class ClientController extends Controller{

	public function creer(){
		if($_SESSION['droits']>=1){
			$data['retour']=gereRetour('client/afficherTous');
			if(!isset($_POST['nom'])){
				$this->render("formCreationClient",$data);
			}else{
				$data=array();
				$data['erreursSaisie']=array();
				if(false){/* Gestion des erreurs de saisie */
					array_push($data['erreurSaisies'],"Erreur de saisie 1");
				}
				foreach($_POST as $key=>$value){
					if($key=='nom'){
						if($value==''){
							array_push($data['erreursSaisie'],"Le champ \"Nom\" est obligatoire");
						}else{
							if(!preg_match("#[a-zA-Z -]#", $value)){
								array_push($data['erreursSaisie'],"Le champ \"Nom\" doit être de type littéral");
							}
						}
					}	
					if($key=='prenom'){
						if($value==''){
							array_push($data['erreursSaisie'],"Le champ \"Prénom\" est obligatoire");
						}else{
							if(!preg_match("#[a-zA-Z -]#", $value)){
									array_push($data['erreursSaisie'],"Le champ \"Prénom\" doit être un de type littéral");
							}
						}
					}
					if($key=='rue'){
						if($value==''){
							array_push($data['erreursSaisie'],"Le champ \"Rue\" est obligatoire");
						}else{
							if(!preg_match("#\s#", $value)){
								array_push($data['erreursSaisie'],"Le champ \"Rue\" doit être de type littéral avec des numéros");								
							}
						}
					}
					if($key=='ville'){
						if($value==''){
							array_push($data['erreursSaisie'],"Le champ \"Ville\" est obligatoire");
						}else{
							if(!preg_match("#[a-zA-Z -]#", $value)){
								array_push($data['erreursSaisie'],"Le champ \"Ville\" doit être de type littéral");	
							}
						}
					}
					if($key=='cp'){
						if($value==''){
							array_push($data['erreursSaisie'],"Le champ \"CP\" est obligatoire");
						}else{
							if(!preg_match("#^[0-9]{5}$#", $value)){
								array_push($data['erreursSaisie'],"Le champ \"CP\" doit être de type numérique (5 chiffres en France)");	
							}
						}
					}
					if($key=='mail'){
						//mail obligatoire?
						if($value!=''){
							if(!preg_match("#^[a-zA-Z0-9_.+-]+@[a-zA-Z0-9-]+\.[a-zA-Z0-9-.]+$#", $value)){
								array_push($data['erreursSaisie'],"Le champ \"Mail\" doit être de type nom@domaine.extention");	
							}
						}
					}
					if($key=='telephone'){
						if($value==''){
							array_push($data['erreursSaisie'],"Le champ \"Telephone\" est obligatoire");
						}else{
							if(!preg_match("#([+0-9]{1,4})[1-9]([0-9]{2}){4}#", $value)){
									array_push($data['erreursSaisie'],"Le champ \"Téléphone\" doit être de type +code ou 0 ainsi qu'une suite de 9 chiffres");
							}
						}
					}				
				}
				if($data['erreursSaisie']!=[]){
					$this->render("formCreationClient",$data);
				}else{
					$newClient = new Client($_POST['nom'],$_POST['prenom'],$_POST['rue'],$_POST['ville'],$_POST['cp'],$_POST['mail'],$_POST['telephone']);
					Client::insert($newClient);
					Socket::store('centrale','insert','client',$newClient->toJson());
					//print_r($newClient);
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
		$data['client']=Client::findByID($_GET['id']);
		$data['vehicules']=Vehicule::FindByProprietaireID($_GET['id']);
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
				$data['erreursSaisie']=[];
				foreach($_POST as $key=>$value){
					if($key=='nom'){
						if($value==''){
							array_push($data['erreursSaisie'],"Le champ \"Nom\" est obligatoire");
						}else{
							if(!preg_match("#[a-zA-Z -]#", $value)){
								array_push($data['erreursSaisie'],"Le champ \"Nom\" doit être de type littéral");
							}
						}
					}	
					if($key=='prenom'){
						if($value==''){
							array_push($data['erreursSaisie'],"Le champ \"Prénom\" est obligatoire");
						}else{
							if(!preg_match("#[a-zA-Z -]#", $value)){
									array_push($data['erreursSaisie'],"Le champ \"Prénom\" doit être de type littéral");
							}
						}
					}
					if($key=='rue'){
						if($value==''){
							array_push($data['erreursSaisie'],"Le champ \"Rue\" est obligatoire");
						}else{
							if(!preg_match("#\s#", $value)){
								array_push($data['erreursSaisie'],"Le champ \"Rue\" doit être de type littéral avec des numéros");								
							}
						}
					}
					if($key=='ville'){
						if($value==''){
							array_push($data['erreursSaisie'],"Le champ \"Ville\" est obligatoire");
						}else{
							if(!preg_match("#[a-zA-Z -]#", $value)){
								array_push($data['erreursSaisie'],"Le champ \"Ville\" doit être de type littéral");	
							}
						}
					}
					if($key=='cp'){
						if($value==''){
							array_push($data['erreursSaisie'],"Le champ \"CP\" est obligatoire");
						}else{
							if(!preg_match("#^[0-9]{5}$#", $value)){
								array_push($data['erreursSaisie'],"Le champ \"CP\" doit être de type numérique (5 chiffres en France)");	
							}
						}
					}
					if($key=='mail'){
						if($value==''){
							array_push($data['erreursSaisie'],"Le champ \"Mail\" est obligatoire");
						}else{
							if(!preg_match("#^[a-zA-Z0-9_.+-]+@[a-zA-Z0-9-]+\.[a-zA-Z0-9-.]+$#", $value)){
								array_push($data['erreursSaisie'],"Le champ \"Mail\" doit être de type nom@domaine.extention");	
							}
						}
					}
					if($key=='telephone'){
						if($value==''){
							array_push($data['erreursSaisie'],"Le champ \"Telephone\" est obligatoire");
						}else{
							if(!preg_match("#([+0-9]{1,4})[1-9]([0-9]{2}){4}#", $value)){
									array_push($data['erreursSaisie'],"Le champ \"Téléphone\" doit être de type +code ou 0 ainsi qu'une suite de 9 chiffres");
							}
						}
					}				
				}
				if($data['erreursSaisie']!=[]){/* Gérer les erreurs de saisie */
					$this->render("formModificationClient",$data);
				}else{
					$updateClient= new Client($_POST['nom'], $_POST['prenom'], $_POST['rue'], $_POST['ville'], $_POST['cp'], $_POST['mail'], $_POST['tel'], null, $_GET['id']);
					Client::update($updateClient);
					Socket::store('centrale','update','client',$updateClient->toJson());
					$_POST = array();
					$this->afficherParId($_GET['id']);
				}
			}
		}
	}
}
?>
