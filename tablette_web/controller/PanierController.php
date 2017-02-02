<?php
	class PanierController extends Controller{
		
		public function afficherTous(){
			$data['paniers']=Panier::FindAll();
			$this->render("visualisationPanierTous",$data);
		}
		
		public function showPanierClient(){
			$data['joinOptionsPanier']=Panier::FindJoinOptionsByClientId($_SESSION['client']);
			$this->render("visualisationPanierClient",$data);
		}
		
		public function ajouterOption(){
			Panier::ajouterOption($_GET['option']);
			header('Location: ./?r='.$_GET['retour']);
		}
	}
?>