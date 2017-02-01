<?php
	class PanierController extends Controller{
		
		public function afficherTous(){
			$data['paniers']=Panier::FindAll();
			$this->render("visualisationPanierTous",$data);
		}
		
		public function showPanierClient(){
			$data['paniers']=Panier::FindByClientId($_SESSION['client']);
			$this->render("visualisationPanierParId",$data);
		}
		
		public function ajouterOption(){
			
		}
	}
?>