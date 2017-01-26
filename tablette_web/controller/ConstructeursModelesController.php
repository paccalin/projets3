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

	public function afficherModele(){
		$data['modele']=Modele::findByID($_GET['modele']);
		$data['constructeur']=$data['modele']->constructeur;
		$data['joinModeleOption']=Option::findJoinModeleOptionByModeleID($_GET['modele']);
		$this->render("tableauAffichageModele",$data);
	}

	public function modifierModele(){
		$data=array();
		$data['modele']=Modele::findByID($_GET['modele']);
		$data['constructeur']=$data['modele']->constructeur;
		//Afichage des join options
		$data['joinModeleOption']=Option::findJoinModeleOptionByModeleID($_GET['modele']);
		if(!isset($_POST['submit'])){
			$this->render("affichageModele",$data);
			if(isset($_POST['cancel'])){
				//                                *** GERER L'ANNULATION
			}
		}else{
			$data['erreursSaisie']=[];
			if(true){
				array_push($data['erreursSaisie'],'Traitement à faire -> voir constructeurModeleController/afficherMofifierModele()');
			}
			if($data['erreursSaisie']!=[]){
				$this->render("affichageModele",$data);
			}else{
				/*
					Faire le traitement: boucler sur les options avec juste une seule des propriétés modifiées
				*/
				$joins=[];
				foreach ($_POST as $post=>$postValue){
					if($post!="submit"){
						array_push($joins,["id"=>$post,"tarif"=>$postValue]);
					}
				}
				Option::updateJoinModeleOption($data['option'],$joins);
				$data['option'] = Option::findByID($_GET['option']);
				$data['joinModeleOption']=Option::findJoinModeleOptionByOptionID($_GET['option']);
				$this->render("affichageModele",$data);
			}
		}
	}
	
	public function afficherConstructeur(){
		$data['constructeur']=Constructeur::findByID($_GET['constructeur']);
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
					Socket::store('centrale','update','constructeur',$constructeur);
					header('Location: ./?r=constructeursModeles/afficherConstructeur&constructeur='.$_GET['constructeur']);
				}
			}
		}else{
			$this->render("erreurAutorisation");
		}
	}
	
	public function ajouter(){
		if($_SESSION['droits']>=2){
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
							Socket::store('centrale','insert','constructeur',$constructeur);
							$this->afficher();
						}
					}else{
						if(!isset($_POST['cancel'])){
							$this->render("formAjoutConstructeur");
						}else{
							header('Location: ./?r=constructeursModeles/afficher');
						}
					}
				}
				elseif($_GET['ajout']=="modele"){
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
							$this->render("formAjoutModele",$data);
						}else{
							$modele = new Modele($_POST['libelle'],Constructeur::FindByID($_POST['constructeur_id']));
							Modele::insert($modele);
							Socket::store('centrale','insert','modele',$modele);
							$this->afficher();
						}
					}else{
						$data['constructeurs']=Constructeur::findAll();
						if(!isset($_POST['cancel'])){
							$this->render("formAjoutModele",$data);
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
