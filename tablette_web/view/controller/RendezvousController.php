<?php

class RendezvousController extends Controller{
	public function creer(){
		if($_SESSION['droits']>=1){
			if(!isset($_POST['libelle'])){
				$this->render("formCreationRendezvous");
			}else{
				$data=array();
				$data['erreurSaisies']=array();
				if(false){/* Gérer avec la fonction time() mais un truc coince -> time() ne correspond pas au temps actuel pour une raison*/
					array_push($data['erreurSaisies'],"La date du rendez-vous doit être postérieure à la date actuelle");
				}
				if(false){/* Trouver le rdv avec l'id du user */
					array_push($data['erreurSaisies'],"Vous avez déjà un rendez-vous prévu sur cette plage de temps");
				}
				if(false){/*  */
					array_push($data['erreurSaisies'],"Ce client a déjà un rendez-vous avec l'entreprise sur cette plage de temps");
				}
				if(false){/* regex: ?h, ?h?, ?m, ?:? */
					array_push($data['erreurSaisies'],"Le format de la durée est incorrect, formats acceptés: ?h, ?h?, ?m, ?:?");
				}
				if($data['erreurSaisies']!=[]){
					$this->render("formCreationRendezvous",$data);
				}else{
					array_push($data['erreurSaisies'],"Formulaire correct mais traitement non terminé");
					$this->render("formCreationRendezvous",$data);
					//$rendezvous = new Rendezvous($_POST['libelle'],Client::findByID($_POST['idClient']),Utilisateur::findByPseudo($_SESSION['identifiant']),$_POST['date'],$_POST['duree']);
				}
			}
		}else{
			$this->render("erreurAutorisation");
		}
	}

	public function afficherTous(){
		$rdvsObjet=Rendezvous::FindByUtilisateurID($_SESSION['utilisateur']);
		$data=array();
		foreach($rdvsObjet as $rdvObjet){
			array_push($data,["libelle"=>$rdvObjet->libelle,"client"=>$rdvObjet->client->nom." ".$rdvObjet->client->prenom,"date"=>Rendezvous::DbDateToFrDate($rdvObjet->date),"durée"=>$rdvObjet->duree]);
		}
		$this->render("visualisationRendezvous",$data);
	}

	public function rechercher(){
		$this->render("rechercheRendezvous");
	}
}
?>
