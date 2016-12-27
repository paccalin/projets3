<?php

class OptionController extends Controller{

	public function afficherGerer(){
		if($_SESSION['droits']>=1){
			$optionsObj = Option::findAll();
			$data['options'] = array();
			foreach($optionsObj as $optionObj){
				array_push($data['options'],["id"=>$optionObj->id,"libelle"=>$optionObj->libelle,"prixDeBase"=>$optionObj->prixDeBase]);
			}
			$this->render("gererOption",$data);
		}else{
			$this->render("erreurAutorisation");
		}
	}	

	public function creer(){
		$data=array();
		/* Mettre les modeles dans $data pour créer les join_modele_option */
		if($_SESSION['droits']>=2){
			if(!isset($_POST['libelle'])){
				$this->render("formCreationOption");
			}else{
				$data['erreursSaisie']=[];
				if(Option::FindByLibelle($_POST['libelle'])!=[]){
					array_push($data['erreursSaisie'],'Cette option existe déjà');
				}
				if(strlen(trim($_POST['libelle']))==0){
						array_push($data['erreursSaisie'],'Le libelle doit être spécifié');
				}
				if(strlen(trim($_POST['description']))==0){
						array_push($data['erreursSaisie'],'La description doit être spécifiée');
				}
				if(strlen(trim($_POST['prixDeBase']))==0){
						array_push($data['erreursSaisie'],'Le prix doit être spécifié');
				}elseif($_POST['prixDeBase']<=0){
						array_push($data['erreursSaisie'],'Le prix doit être un nombre positif');
				}
				if($data['erreursSaisie']!=[]){
					$this->render("formCreationOption",$data);
				}else{
					$option = new Option($_POST['libelle'],$_POST['description'],$_POST['prixDeBase']);
					Option::insert($option);
					$this->afficherGerer();
				}
			}
		}else{
			$this->render("erreurAutorisation");
		}
	}

	public function visualiser(){
		/* Mettre les modeles dans $data pour créer les join_modele_option */
		if($_SESSION['droits']>=1){
			$optionObj = Option::findByID($_GET['option']);
			$data['option'] = ["libelle"=>$optionObj->libelle,"description"=>$optionObj->desc,"prixDeBase"=>$optionObj->prixDeBase,"prixMoyen"=>
number_format(Option::moyenneTarifByID($_GET['option']), 0,'','')];
			$data['joinVehiculeOption']=Option::findJoinModeleOptionByOptionID($_GET['option']);
			$this->render("formVisualiserOption",$data);
		}else{
			$this->render("erreurAutorisation");
		}	
	}

	public function modifier(){
		/* Mettre les modeles dans $data pour créer les join_modele_option */
		if($_SESSION['droits']>=2){
			$optionObj = Option::findByID($_GET['option']);
			$data['option'] = ["libelle"=>$optionObj->libelle,"description"=>$optionObj->desc,"prixDeBase"=>$optionObj->prixDeBase,"prixMoyen"=>"X"];
			$this->render("formModifierOption",$data);
		}else{
			$this->render("erreurAutorisation");
		}	
	}

}

?>
