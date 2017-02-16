<?php
	class PanierController extends Controller{
		
		public function creer(){
			
		}
		
		public function rechercher(){
			if(isset($_GET['retour'])){
				$data['retour']=$_GET['retour'];
			}else{
				$data['retour']='panier/afficherTous';
			}
			$this->render('formRecherchePanier',$data);
		}
		
		public function afficherTous(){
			$data['paniers']=Panier::FindAll();
			$this->render("visualisationPanierTous",$data);
		}
		
		public function afficherParId(){
			$panier = Panier::FindById($_GET['panier']);
			$data['joinOptionsPanier'] = Panier::FindJoinOptionsById($panier->id);
			$data['total']=$panier->getCoutTotal();
			$this->render('visualisationPanierParId',$data);
		}
		
		public function showPanierClient(){
			$panier = Panier::FindByClientId($_SESSION['client']);
			$data['joinOptionsPanier']=Panier::FindJoinOptionsById($panier->id);
			$data['total']=$panier->getCoutTotal();
			$this->render("visualisationPanierClient",$data);
		}
		
		public function ajouterOption(){
			if($_SESSION['mode']=='client'){
				$panier = Panier::findByClientId($_SESSION['client']);
			}else{
				$panier = Panier::findById($_GET['paniers']);
			}
			$panier->ajouterOption($_GET['option']);
			if(isset($_GET['retour'])){
				header('Location: ./?r='.$_GET['retour']);
			}else{
				header('Location: ./?r=panier/showPanierClient');
			}
		}
	}
?>