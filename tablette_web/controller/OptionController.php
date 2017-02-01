<?php

class OptionController extends Controller{

	public function afficherTous(){
		if($_SESSION['droits']>=1){
			$optionsObj = Option::findAll();
			$data['options'] = array();
			foreach($optionsObj as $optionObj){
				array_push($data['options'],["id"=>$optionObj->id,"libelle"=>$optionObj->libelle,"prixDeBase"=>$optionObj->prixDeBase]);
			}
			$this->render("afficherTous",$data);
		}else{
			$this->render("erreurAutorisation");
		}
	}	

	public function creer(){
		$data=array();
		/* Mettre les modeles dans $data pour créer les join_modele_option */
		if($_SESSION['droits']>=2){
			if(!isset($_POST['submit'])){
				if(!isset($_POST['cancel'])){
					$this->render("formCreationOption");
				}else{
					header('Location: ./?r=option/afficherGerer');
				}
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
					Socket::store('centrale','insert',self::$tableName,$option);
					header('Location: ./?r=option/visualiserModifier&option='.$option->id);
				}
			}
		}else{
			$this->render("erreurAutorisation");
		}
	}
	
	public function visualiser(){
		if($_SESSION['droits']>=1){
			$data['option'] = Option::findByID($_GET['option']);
			$data['moyenneTarif'] = Option::moyenneTarifByID($_GET['option']);
			$data['joinModeleOption']=Option::findJoinModeleOptionByOptionID($_GET['option']);
			$this->render("visualiserOption",$data);
		}else{
			$this->render("erreurAutorisation");
		}	
	}
	
	public function modifier(){
		if($_SESSION['droits']>=2){
			$data['option'] = Option::findByID($_GET['option']);
			$data['moyenneTarif'] = number_format(Option::moyenneTarifByID($_GET['option']), 0,'','');
			$data['joinModeleOption']=Option::findJoinModeleOptionByOptionID($_GET['option']);
			if(!isset($_POST['submit'])){
				$this->render("modifierOption",$data);
				if(isset($_POST['cancel'])){
					//                                *** GERER L'ANNULATION
				}
			}else{
				$data['erreursSaisie']=[];
				foreach($_POST as $key=>$value){
					if($key!='submit'){
						if(!is_numeric($value)){
							$modele=Modele::FindByJoinOptionId($key)[0];
							array_push($data['erreursSaisie'],'Le coût de l\'option pour le modèle '.$modele->libelle.' doit être un nombre');
						}elseif($value<=0){
							$modele=Modele::FindByJoinOptionId($key)[0];
							array_push($data['erreursSaisie'],'Le coût de l\'option pour le modèle '.$modele->libelle.' doit être un nombre positif');
						}
					}
				}
				if($data['erreursSaisie']!=[]){
					$this->render("modifierOption",$data);
				}else{
					$joins=[];
					foreach ($_POST as $post=>$postValue){
						if($post!="submit"){
							array_push($joins,["id"=>$post,"tarif"=>$postValue]);
						}
					}
					Option::updateJoinModeleOption($data['option'],$joins);
					$data['option'] = Option::findByID($_GET['option']);
					$data['moyenneTarif'] = number_format(Option::moyenneTarifByID($_GET['option']), 0,'','');
					$data['joinModeleOption']=Option::findJoinModeleOptionByOptionID($_GET['option']);
					$this->render("visualiserOption",$data);
				}
			}
		}else{
			$this->render("erreurAutorisation");
		}	
	}
}

?>
