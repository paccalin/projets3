<?php
class VehiculeController extends Controller{

	public function creer(){
		if($_SESSION['droits']>=1){
			$data['retour']=gereRetour('option/afficherTous');
			$data['modeles'] = Modele::FindAll();
			$data['clients'] = Client::FindAll();
			if(!isset($_POST['submit'])){
				$this->render('formCreationVehicule',$data);
			}else{
				$data['erreursSaisie'] = [];
				if($_POST['modele_id']=='null'){
					array_push($data['erreursSaisie'],"Aucun modèle n'est sélectionné");
				}
				if($_POST['client_id']=='null'){
					array_push($data['erreursSaisie'],"Aucun client n'est sélectionné");
				}
				if(strlen($_POST['immat'])!=7 AND strlen($_POST['immat'])!=8){
					array_push($data['erreursSaisie'],"L'immaticulation n'est pas correcte");
				}
				if(Vehicule::FindByImmatriculation($_POST['immat'])!=null){
					array_push($data['erreursSaisie'],"Il y a déjà un véhicule avec cette immatriculation");
				}
				if($data['erreursSaisie'] != []){
					$this->render('formCreationVehicule',$data);
				}else{
					$newVehicule = new Vehicule(Modele::FindById($_POST['modele_id']), Client::FindById($_POST['client_id']), $_POST['immat']);
					Vehicule::insert($newVehicule);
					Socket::store('centrale','insert','vehicule',$newVehicule->toJson());
					header('Location: ./?r=vehicule/visualiser&id='.$newVehicule->id);
				}
			}
		}
	}

	public function afficherTous(){
		$data['vehicules'] = Vehicule::FindAll();
		$this->render('afficherTous',$data);
	}

	public function visualiser(){
		$data['vehicule'] = Vehicule::FindById($_GET['id']);
		//$data['options'] = Vehicule::FindOptions($_GET['vehicule']);
		$data['retour']=gereRetour('vehicule/afficherTous');
		$this->render('visualiserVehicule',$data);
	}

	public function rechercher(){
		
	}
	
	public function modifier(){
		if($_SESSION['droits']>=1){
			$data['modeles'] = Modele::FindAll();
			$data['clients'] = Client::FindAll();
			$data['vehicule'] = Vehicule::FindById($_GET['id']);
			if(!isset($_POST['submit'])){
				if(isset($_POST['cancel'])){
					header('Location: ./?r=vehicule/visualiser&id='.$_GET['id']);
				}
				$this->render('formModificationVehicule',$data);
			}else{
				$data['erreursSaisie'] = [];
				if($_POST['modele_id']=='null'){
					array_push($data['erreursSaisie'],"Aucun modèle n'est sélectionné");
				}
				if($_POST['client_id']=='null'){
					array_push($data['erreursSaisie'],"Aucun client n'est sélectionné");
				}
				if(strlen($_POST['immat'])!=7 AND strlen($_POST['immat'])!=8){
					array_push($data['erreursSaisie'],"L'immaticulation n'est pas correcte");
				}
				if(Vehicule::FindByImmatriculation($_POST['immat'])!=null and $_POST['immat']!=$data['vehicule']->immatriculation){
					array_push($data['erreursSaisie'],"Il y a déjà un véhicule pour cette immatriculation");
				}
				if($data['erreursSaisie'] != []){
					$this->render('formCreationVehicule',$data);
				}else{
					$modele = Modele::FindById($_POST['modele_id']);
					$client = Client::FindById($_POST['client_id']);
					$vehicule = new Vehicule($modele, $client, $_POST['immat'], null, $_GET['id']);
					Vehicule::update($vehicule);
					header('Location: ./?r=vehicule/visualiser&id='.$_GET['id']);
				}
			}
		}
	}
	
	public function supprimer(){
		if($_SESSION['droits']>=1){
			$vehicule = Vehicule::FindById($_GET['id']);
			$data['vehicule'] = $vehicule;
			if(!isset($_POST['submit'])){
				if(isset($_POST['cancel'])){
					header('Location: ./?r=vehicule/visualiser&id='.$_GET['id']);
				}
				$this->render('formConfirmerSuppression',$data);
			}else{
				Vehicule::delete($vehicule);
				$this->afficherTous();
			}
		}
	}

}
?>
