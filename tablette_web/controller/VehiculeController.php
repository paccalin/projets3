<?php
class VehiculeController extends Controller{

	public function creer(){
		
	}

	public function afficherTous(){
		$data['vehicules'] = Vehicule::FindAll();
		$this->render('afficherTous',$data);
	}

	public function visualiser(){
		$data['vehicule'] = Vehicule::FindById($_GET['vehicule']);
		//$data['options'] = Vehicule::FindOptions($_GET['vehicule']);
		$data['retour']=gereRetour('vehicule/afficherTous');
		$this->render('visualiserVehicule',$data);
	}

	public function rechercher(){
		
	}

}
?>
