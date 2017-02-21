<?php

class OptionController extends Controller{
	
	public function afficherTous(){
		if($_SESSION['droits']>=1){
			$data['options'] = Option::findAll();
			$this->render("afficherTous",$data);
		}else{
			$this->render("erreurAutorisation");
		}
	}	
	
	public function visualiserParType(){
		if(isset($_GET['retour'])){
			$data['retour']=$_GET['retour'];
		}else{
			$data['retour']='option/afficherTous';
		}
		$data['typeOption']=TypeOption::FindById($_GET['type']);
		$data['options']=Option::FindByTypeOptionId($_GET['type']);
		$this->render("visualiserParType",$data);
	}

	public function creer(){
		$data=array();
		/* Mettre les modeles dans $data pour créer les join_modele_option */
		if($_SESSION['droits']>=2){
			$data['typeOption']=TypeOption::FindAll();
			if(!isset($_POST['submit'])){
				if(!isset($_POST['cancel'])){
					$this->render("formCreationOption",$data);
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
					$option = new Option($_POST['libelle'],TypeOption::FindById($_POST['typeOption_id']),$_POST['description'],$_POST['prixDeBase']);
					Option::insert($option);
					Socket::store('centrale','insert','option',$option);
					header('Location: ./?r=option/visualiser&option='.$option->id);
				}
			}
		}else{
			$this->render("erreurAutorisation");
		}
	}
	
	public function visualiser(){
		if($_SESSION['droits']>=1){
			if(isset($_GET['retour'])){
				$data['retour']=$_GET['retour'];
			}else{
				$data['retour']='option/afficherTous';
			}
			$data['option'] = Option::findByID($_GET['option']);
			$data['moyenneTarif'] = Option::moyenneTarifByID($_GET['option']);
			$data['joinTypeModeleOption']=Option::findJoinTypeModeleOptionByOptionID($_GET['option']);
			$this->render("visualiserOption",$data);
		}else{
			$this->render("erreurAutorisation");
		}	
	}
	
	public function modifier(){
		if($_SESSION['droits']>=2){
			$data['option'] = Option::findByID($_GET['option']);
			$data['moyenneTarif'] = number_format(Option::moyenneTarifByID($_GET['option']), 0,'','');
			$data['typeOption'] = TypeOption::FindAll();
			$data['joinTypeModeleOption']=Option::findJoinTypeModeleOptionByOptionID($_GET['option']);
			if(!isset($_POST['submit'])){
				$this->render("modifierOption",$data);
				if(isset($_POST['cancel'])){
					//                                *** GERER L'ANNULATION
				}
			}else{
				$data['erreursSaisie']=[];
				foreach($_POST as $key=>$value){
					if($key!='submit'){
						if(substr($key, 0, 3)=='opt'){
							if(!is_numeric($value)){
								$typeModele=TypeModele::FindByJoinOptionId(substr($key, 3))[0];
								array_push($data['erreursSaisie'],'Le coût de l\'option pour la catégorie '.$typeModele->libelle.' doit être un nombre');
							}elseif($value<=0){
								$typeModele=TypeModele::FindByJoinOptionId(substr($key, 3))[0];
								array_push($data['erreursSaisie'],'Le coût de l\'option pour la catégorie '.$typeModele->libelle.' doit être un nombre positif');
							}
						}
						
					}
				}
				if($data['erreursSaisie']!=[]){
					$this->render("modifierOption",$data);
				}else{
					$joins=[];
					foreach ($_POST as $post=>$postValue){
						if($post!="submit"){
							if(substr($post, 0, 3)=='opt'){
								array_push($joins,["id"=>substr($post, 3),"tarif"=>$postValue]);
							}
						}
					}
					//print_r($_POST);
					$optionU = new Option($_POST['libelle'],TypeOption::FindById($_POST['typeOption_id']),$_POST['description'],$_POST['prixDeBase'],null,$data['option']->id);
					Option::update($optionU);
					Option::updateJoinTypeModeleOption($data['option'],$joins);
					$data['option'] = Option::findByID($_GET['option']);
					$data['moyenneTarif'] = number_format(Option::moyenneTarifByID($_GET['option']), 0,'','');
					$data['joinTypeModeleOption']=Option::findJoinTypeModeleOptionByOptionID($_GET['option']);
					$this->render("visualiserOption",$data);
				}
			}
		}else{
			$this->render("erreurAutorisation");
		}	
	}
}

?>
