<?php

class RendezvousController extends Controller{
	public function creer(){
		if($_SESSION['droits']>=1){
			$this->render("formCreationRendezvous");
		}else{
			$this->render("erreurAutorisation");
		}
	}

	public function afficherTous(){
		$rdvsObjet=Rendezvous::FindByUtilisateurID(Utilisateur::FindByPseudo($_SESSION['identifiant'])->id);
		$data=array();
		foreach($rdvsObjet as $rdvObjet){
			array_push($data,["libelle"=>$rdvObjet->libelle,"client"=>$rdvObjet->client->nom." ".$rdvObjet->client->prenom,"date"=>Rendezvous::DbDateToFrDate($rdvObjet->date),"durée"=>$rdvObjet->duree]);
		}
		$this->render("visualisationRendezvous",$data);
	}

	public function rechercher(){
		$this->render("rechercherRendezvous");
	}
}
?>
