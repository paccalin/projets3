<?php
class DevisController extends Controller{
	/*
	public function show(){
		$constructeurs = Constructeur::FindAll();
		
		$modeles = Modele::FindAll();
		
		//$modele->constructeur;
		
		$data = ['constructeurs'=>$constructeurs, 'modeles'=>$modeles];
		
		$this->render("show", $data);
	}
	*/
	
	public function creer(){	
		if($_SESSION['droits']>=1){
			if(!isset($_POST['constructeur'])){//Mettre le premier champ du formulaire de création
				
					$constructeurs = Constructeur::FindAll();
				
					$modeles = Modele::FindAll();

					$options = Option::FindAll();					

					$data["Devis/creer"] = array();
					
					$data["Devis/creer"] = ['constructeurs'=>$constructeurs, 'modeles'=>$modeles, 'options'=>$options];
					
					$this->render("formCreationDevis",$data);
			}else{
				$data=array();
				$data['erreursSaisie']=array();
				if(false){
					array_push($data['erreurSaisies'],"Erreur de saisie 1");
				}
				if(false){
					array_push($data['erreurSaisies'],"Erreur de saisie 2");
				}
				if(true){
					array_push($data['erreurSaisies'],"Erreur de saisie 3");
				}
				if($data['erreurSaisies']!=[]){	
					$this->render("formCreationDevis",$data);
				}else{
					/* $devis = new Devis() + insertDb */
				}
			}
		}else{
			$this->render("erreurAutorisation");
		}
	}

	public function afficherTous(){
		$data=array();
		$this->render("visualisationDevisTous",$data);
	}
	
	public function afficherParId(){
		$data=array();
		$this->render("visualisationDevisParId",$data);
	}

	public function rechercher(){
		if(!isset($_POST['recherche'])){
			$this->render("rechercheDevis");
		}
	}
}
