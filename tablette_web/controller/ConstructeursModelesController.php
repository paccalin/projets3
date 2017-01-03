<?php

class ConstructeursModelesController extends Controller{
	public function afficher(){
		$data=array();
		$constructeurs=Constructeur::findAll();
		$oldConstructeur= new Constructeur("");
		foreach($constructeurs as $constructeur){
			$modeles=Modele::findByConstructeurID($constructeur->id);
			if($modeles==[]){
				array_push($data,["constructeur"=>$constructeur->libelle,"modele"=>"<i>Aucun modèle</i>"]);
			}
			foreach($modeles as $modele){
				/* 2 affichages différents: en haut plus lisible en bas plus aéré*/
				//array_push($data,["constructeur"=>$constructeur->libelle,"modele"=>$modele->libelle]);
				if($constructeur!=$oldConstructeur){
					array_push($data,["constructeur"=>$constructeur->libelle,"modele"=>$modele->libelle]);
					$oldConstructeur=$constructeur;
				}else{
					array_push($data,["constructeur"=>"","modele"=>$modele->libelle]);
				}
				
			}
		}
		$this->render("tableauAffichageConstructeursModeles",$data);
	}

	public function ajouter(){
		if($_SESSION['droits']>=2){
			if(!isset($_GET['ajout'])){
				$this->render("choixAjout");
			}else{
				if($_GET['ajout']=="constructeur"){
					if(isset($_POST['libelle'])){
						$data['erreursSaisie']=array();
						if(strlen(trim($_POST['libelle']))==0){
							array_push($data['erreursSaisie'],'Le libelle ne soit pas être une chaîne vide');
						}
						if(Constructeur::FindByLibelle($_POST['libelle'])!=[]){
							array_push($data['erreursSaisie'],'Il y a déjà un constructeur à ce nom');
						}
						if($data['erreursSaisie']!=[]){
							$this->render("formAjoutConstructeur",$data);
						}else{
							$constructeur= new Constructeur($_POST['libelle']);
							Constructeur::insert($constructeur);
							$this->afficher();
						}
					}else{
						$this->render("formAjoutConstructeur");
					}
				}
				elseif($_GET['ajout']=="modele"){
					if(isset($_POST['libelle'])){
						$data['erreursSaisie']=array();
						if(strlen(trim($_POST['libelle']))==0){
							array_push($data['erreursSaisie'],'Le libelle ne soit pas être une chaîne vide');
						}
						if(Modele::FindByLibelle($_POST['libelle'])!=[]){
							array_push($data['erreursSaisie'],'Il y a déjà un modèle à ce nom');
						}
						if($data['erreursSaisie']!=[]){
							$data['constructeurs']=array();
							$constructeursObj=Constructeur::findAll();
							foreach($constructeursObj as $constructeurObj){
								array_push($data['constructeurs'],["id"=>$constructeurObj->id,"libelle"=>$constructeurObj->libelle]);
							}
							$this->render("formAjoutModele",$data);
						}else{
							$modele = new Modele($_POST['libelle'],Constructeur::FindByID($_POST['constructeur_id']));
							Modele::insert($modele);
							$this->afficher();
						}
					}else{
						$data['constructeurs']=array();
						$constructeursObj=Constructeur::findAll();
						foreach($constructeursObj as $constructeurObj){
							array_push($data['constructeurs'],["id"=>$constructeurObj->id,"libelle"=>$constructeurObj->libelle]);
						}
						$this->render("formAjoutModele",$data);
					}
				}
			}
		}else{
			$this->render("erreurAutorisation");
		}
	}
}

?>
