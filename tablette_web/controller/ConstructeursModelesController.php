<?php

class ConstructeursModelesController extends Controller{
	public function afficher(){
		$data=array();
		$constructeurs=Constructeur::findAll();
		$oldConstructeur = new Constructeur("");
		foreach($constructeurs as $constructeur){
			$modeles=Modele::findByConstructeurID($constructeur->id);
			if($modeles==[]){
				array_push($data,["constructeur"=>$constructeur,"modele"=>null]);
			}
			foreach($modeles as $modele){
				/* 2 affichages différents: en haut plus lisible en bas plus aéré*/
				//array_push($data,["constructeur"=>$constructeur,"modele"=>$modele]);
				if($constructeur!=$oldConstructeur){
					array_push($data,["constructeur"=>$constructeur,"modele"=>$modele]);
					$oldConstructeur=$constructeur;
				}else{
					$emptyConstructeur = new Constructeur("");
					array_push($data,["constructeur"=>$emptyConstructeur,"modele"=>$modele]);
				}
				
			}
		}
		$this->render("tableauAffichageConstructeursModeles",$data);
	}

	public function rechercher(){
		$this->render("formRecherche");
	}

	public function afficherModele(){
		$data['modele']=Modele::findByID($_GET['modele']);
		$data['joinTypeModeleOption']=Option::findJoinTypeModeleOptionByTypeModeleId($data['modele']->typeModele->id);
		$this->render("tableauAffichageModele",$data);
	}

	public function modifierModele(){
		if($_SESSION['droits']>=2){
			$data=array();
			$modele = Modele::findByID($_GET['modele']);
			$data['modele']=$modele;
			$data['constructeurs']=Constructeur::FindAll();
			$data['typeModele']=TypeModele::FindAll();
			if(!isset($_POST['submit'])){
				$this->render("formModificationModele",$data);
				if(isset($_POST['cancel'])){
					//
				}
			}else{
				$data['erreursSaisie']=[];
				if($_POST['typeModele_id']=="null"){
					array_push($data['erreursSaisie'],"Aucun type de modèle n'est sélectionné");
				}
				if($_POST['constructeur_id']=="null"){
					array_push($data['erreursSaisie'],"Aucun constructeur n'est sélectionné");
				}
				if($_POST['libelle']==""){
					array_push($data['erreursSaisie'],"Le libelle est une chaîne vide");
				}
				if($data['erreursSaisie']!=[]){
					$this->render("formModificationModele",$data);
				}else{
					$newModele = new Modele($_POST['libelle'],Constructeur::FindById($_POST['constructeur_id']),TypeModele::FindById($_POST['typeModele_id']),$modele->dateInsertion,$modele->id);
					Modele::update($newModele);
					header('Location: ?r=constructeursModeles/afficherModele&modele='.$newModele->id);
				}
			}
		}else{
			$this->render('erreurAutorisation');
		}
		
	}
	
	public function afficherConstructeur(){
		$data['constructeur']=Constructeur::findByID($_GET['constructeur']);
		$data['modeles']=Modele::FindByConstructeurId($_GET['constructeur']);
		$this->render("affichageConstructeur",$data);
	}
	
	public function modifierConstructeur(){
		if($_SESSION['droits']>=2){
			if(!isset($_POST['submit'])){
				if(isset($_POST['cancel'])){
					header('Location: ./?r=constructeursModeles/afficherConstructeur&constructeur='.$_GET['constructeur']);
				}else{
					$_POST['libelle']=Constructeur::findByID($_GET['constructeur'])->libelle;
					$this->render("formModificationConstructeur");
				}
			}else{
				$data['erreursSaisie']=[];
				if(strlen(trim($_POST['libelle']))==0){
					array_push($data['erreursSaisie'],'Le libelle ne doit pas être une chaîne vide');
				}
				if(Constructeur::findByLibelle($_POST['libelle'])){
					array_push($data['erreursSaisie'],'Il y a déjà un constructeur à nom');
				}
				if($data['erreursSaisie']!=[]){
					$this->render("formModificationConstructeur",$data);
				}else{
					$constructeur = new Constructeur($_POST['libelle'], null, $_GET['constructeur']);
					Constructeur::update($constructeur);
					Socket::store('centrale','update','constructeur',$constructeur->toJson());
					header('Location: ./?r=constructeursModeles/afficherConstructeur&constructeur='.$_GET['constructeur']);
				}
			}
		}else{
			$this->render("erreurAutorisation");
		}
	}
	
	public function afficherTypeModele(){
		$data['typeModele']=TypeModele::FindById($_GET['id']);
		$data['modeles']=Modele::FindByTypeModeleId($_GET['id']);
		$data['joinOption']=Option::findJoinTypeModeleOptionByTypeModeleId($_GET['id']);
		$this->render("tableauAffichageTypeModele",$data);
	}
	
	public function modifierTypeModele(){
		if($_SESSION['droits']>=2){
			$data['typeModele']=TypeModele::FindById($_GET['id']);
			$data['joinTypeModeleOption']=Option::findJoinTypeModeleOptionByTypeModeleId($_GET['id']);
			if(!isset($_POST['submit'])){
				if(isset($_POST['cancel'])){
					header('Location: ./?r=constructeursModeles/afficherTypeModele&id='.$_GET['id']);
				}else{
					$this->render("formModificationTypeModele",$data);
				}
			}else{
				$data['erreursSaisie']=[];
				foreach($_POST as $key=>$value){
					if($key!='submit'){
						if($key=='libelle' and $value==''){
							array_push($data['erreursSaisie'],'Le libelle doit être spécifié');
						}
						if($key=='libelle' and (TypeModele::findByLibelle($value)!=null and $value!=$data['typeModele']->libelle)){
							array_push($data['erreursSaisie'],'Il y a déjà un type de modèle à nom');
						}
						if($key=='prixDeBase' and strlen(trim($value))==0){
							array_push($data['erreursSaisie'],'Le prix doit être spécifié');
						}elseif($key=='prixDeBase' and $value<=0){
							array_push($data['erreursSaisie'],'Le prix doit être un nombre positif');
						}
						if(substr($key, 0, 3)=='opt'){
							if(!is_numeric($value)){
								$option=Option::FindByJoinOptionId(substr($key, 3))[0];
								array_push($data['erreursSaisie'],'Le coût de l\'option '.$option->libelle.' doit être un nombre');
							}elseif($value<=0){
								$option=Option::FindByJoinOptionId(substr($key, 3))[0];
								array_push($data['erreursSaisie'],'Le coût de l\'option '.$option->libelle.' doit être un nombre positif');
							}
						}
						
					}
				}
				if($data['erreursSaisie']!=[]){
					$this->render("formModificationTypeModele",$data);
				}else{
					$joins=[];
					foreach ($_POST as $post=>$postValue){
						if($post!="submit"){
							if(substr($post, 0, 3)=='opt'){
								array_push($joins,["id"=>substr($post, 3),"tarif"=>$postValue]);
							}
						}
					}
					$typeModele = new typeModele($_POST['libelle'], null, $_GET['id']);
					TypeModele::update($typeModele);
					Option::updateJoinTypeModeleOption($joins);
					Socket::store('centrale','update','typemodele',$typeModele->toJson());
					header('Location: ./?r=constructeursModeles/afficherTypeModele&id='.$_GET['id']);
				}
			}
		}else{
			$this->render("erreurAutorisation");
		}
	}
	
	public function ajouter(){
		if($_SESSION['droits']>=2){
			$data['retour']=gereRetour('constructeursModeles/afficher');
			if(!isset($_GET['ajout'])){
				$this->render("choixAjout");
			}else{
				if($_GET['ajout']=="constructeur"){
					if(isset($_POST['submit'])){
						$data['erreursSaisie']=array();
						if(strlen(trim($_POST['libelle']))==0){
							array_push($data['erreursSaisie'],'Le libelle ne doit pas être une chaîne vide');
						}
						if(Constructeur::FindByLibelle($_POST['libelle'])!=[]){
							array_push($data['erreursSaisie'],'Il y a déjà un constructeur à ce nom');
						}
						if($data['erreursSaisie']!=[]){
							$this->render("formAjoutConstructeur",$data);
						}else{
							$constructeur= new Constructeur($_POST['libelle']);
							Constructeur::insert($constructeur);
							Socket::store('centrale','insert','constructeur',$constructeur->toJson());
							$this->afficher();
						}
					}else{
						if(!isset($_POST['cancel'])){
							$this->render("formAjoutConstructeur",$data);
						}else{
							header('Location: ./?r=constructeursModeles/afficher');
						}
					}
				}elseif($_GET['ajout']=="modele"){
					if(isset($_POST['submit'])){
						$data['erreursSaisie']=array();
						if(strlen(trim($_POST['libelle']))==0){
							array_push($data['erreursSaisie'],'Le libelle ne soit pas être une chaîne vide');
						}
						if(Modele::FindByLibelle($_POST['libelle'])!=[]){
							array_push($data['erreursSaisie'],'Il y a déjà un modèle à ce nom');
						}
						if($_POST['constructeur_id']== 'null'){
							array_push($data['erreursSaisie'],'Veuillez choisir un constructeur valide');
						}
						if($data['erreursSaisie']!=[]){
							$data['constructeurs']=Constructeur::findAll();
							$data['typeModele']=TypeModele::findAll();
							$this->render("formAjoutModele",$data);
						}else{
							$modele = new Modele($_POST['libelle'],Constructeur::FindByID($_POST['constructeur_id']),TypeModele::FindById($_POST['typeModele_id']));
							Modele::insert($modele);
							Socket::store('centrale','insert','modele',$modele->toJson());
							header('Location: ./?r=constructeursModeles/afficherModele&modele='.$modele->id);
							//$this->afficher();
						}
					}else{
						$data['constructeurs']=Constructeur::findAll();
						$data['typeModele']=TypeModele::findAll();
						if(!isset($_POST['cancel'])){
							$this->render("formAjoutModele",$data);
						}else{
							header('Location: ./?r=constructeursModeles/afficher');
						}
					}
				}elseif($_GET['ajout']=="typeModele"){
					if(isset($_POST['submit'])){
						$data['erreursSaisie']=array();
						if(strlen(trim($_POST['libelle']))==0){
							array_push($data['erreursSaisie'],'Le libelle ne soit pas être une chaîne vide');
						}
						if(TypeModele::FindByLibelle($_POST['libelle'])!=[]){
							array_push($data['erreursSaisie'],'Il y a déjà un type de modèle à ce nom');
						}
						if($data['erreursSaisie']!=[]){
							$this->render("formAjoutTypeModele",$data);
						}else{
							$typeModele = new TypeModele($_POST['libelle']);
							TypeModele::insert($typeModele);
							Socket::store('centrale','insert','typeModele',$typeModele->toJson());
							header('Location: ./?r=constructeursModeles/afficherTypeModele&id='.$typeModele->id);
							//$this->afficher();
						}
					}else{
						$data['constructeurs']=Constructeur::findAll();
						$data['typeModele']=TypeModele::findAll();
						if(!isset($_POST['cancel'])){
							$this->render("formAjoutTypeModele",$data);
						}else{
							header('Location: ./?r=constructeursModeles/afficher');
						}
					}
				}
			}
		}else{
			$this->render("erreurAutorisation");
		}
	}
}

?>
