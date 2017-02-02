<?php
	class PanierController extends Controller{
		
		public function creer(){
			
		}
		
		public function rechercher(){
			
		}
		
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
			if(isset($_GET['retour'])){
				header('Location: ./?r='.$_GET['retour']);
			}else{
				header('Location: ./?r=panier/showPanierClient');
			}
		}
	}
?>