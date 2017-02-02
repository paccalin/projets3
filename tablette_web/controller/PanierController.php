<?php
	class PanierController extends Controller{
		
		public function afficherTous(){
			$data['paniers']=Panier::FindAll();
			$this->render("visualisationPanierTous",$data);
		}
		
		public function showPanierClient(){
			$panier = Panier::FindByClientId($_SESSION['client']);
			$data['joinOptionsPanier']=Panier::FindJoinOptionsById($panier->id);
			$data['total']=$panier->getCoutTotal();
			$this->render("visualisationPanierClient",$data);
		}
		
		public function ajouterOption(){
			Panier::ajouterOption($_GET['option']);
			header('Location: ./?r='.$_GET['retour']);
		}
	}
?>