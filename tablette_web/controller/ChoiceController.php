<?php

class ChoiceController extends Controller{
	public function viewInsert(){
		$href="?r=choice/";
		
<<<<<<< HEAD
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
					
					//si render n'est pas renseign� alors redirection vers index.php avec la page home
					// le but �tant d'�viter n'importe qui � partir de l'url de ce connecter
					/*if($this->render() == null){
						home();
					}*/
					
				}else{
=======
		if(isset($_POST['insert'])){
			$insert = $_POST['insert'];
			if($_SESSION['droits'] >= 1){ /* connect�, admin, super-admin, ou plus si affinit� */
				//si utilisateur connecter alors verif si insert == $choix
				if($insert == "client"){
					$this->render('insertClient');
				}else if($insert == "rdv"){
					$this->render('insertRDV');
				}else if($insert == "devis"){
					$this->render('insertDevis');
				}
				//si utilisateur admin veri si $insert == $choix
				if($_SESSION['droits'] >= 2){ /* admin, super-admin, ou plus */
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
					//si super adminstrateur verif si $insert == $choix
					if($_SESSION['droits'] >= 3){ /* super admin ou plus si il y a encore un autre r�le*/
						if($insert == "user"){
							$this->render('insertUtilisateur');
						}
					}
				

				}
				
				//si render n'est pas renseign� alors redirection vers index.php avec la page home
				// le but �tant d'�viter n'importe qui � partir de l'url de ce connecter
				/*if($this->render() == null){
>>>>>>> 992220dd1daa25de20d50a0e47fdc64fcd1d8360
					home();
				}
			}
		}
	}
}





function home(){
	header('Location: ./?r=site/index');
}
?>