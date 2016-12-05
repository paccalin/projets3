<?php

class ChoiceController extends Controller{
	public function viewInsert(){
		$href="?r=choice/";
		
		if(isset($_POST['submit'])){
			if(isset($_POST['choice'])){
				
				$insert = $_POST['choice'];
				
				if(True/*{$_SESSION['connecter'] == true}*/){
						
					//si utilisateur connecter alors verif si insert == $choix
					if($insert == "client"){
						$this->render('insertClient');
					}else if($insert == "rdv"){
						$this->render('insertRDV');
					}else if($insert == "devis"){
						$this->render('insertDevis');
					}
					
					/*
					//si utilisateur admin veri si $insert == $choix
					if({utilisateur_droits} == "administrateur"){
						if($insert == "vehicule"){
							$this->render('insertVehicule');
						}else if($insert == "photo"){
							$this->render('insertPhoto');
						}else if($insert == "option"){
							$this->render('insertOption');
						}else if($insert == "brand"){
							$this->render('insertConstructeur');
						}else if($insert == "modele"){
							$this->render('insertModele');
						}
					}
					//si super adminstrateur verif si $insert == $choix
					if({utilisateur_droits} == "super_administrateur"){
						if($insert == "user"){
							$this->render('insertUtilisateur');
						}
					}		
					*/
					
					//si render n'est pas renseigné alors redirection vers index.php avec la page home
					// le but étant d'éviter n'importe qui à partir de l'url de ce connecter
					/*if($this->render() == null){
						home();
					}*/
					
				}else{
					home();
				}
			}
		}
	}
}





function home(){
	header('Location: ./');
}
?>