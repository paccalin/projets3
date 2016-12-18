<?php

class RendezVousController extends Controller{
	public function creer(){
		if($_SESSION['droits']>=1){
			$this->render("formCreationRendezvous");
		}else{
			$this->render("erreurAutorisation");
		}
	}
	public function visualiser(){
		$rdv=array();
		$rdv1=['Démarchage','Jacques Ahdi','10/1/2017','10h30'];
		$rdv2=['Accompagenemnt','Jean Sérien','20/04/2017','16h00'];
		$rdv3=['Vente à domicile','Risitas issou','20/12/2016','11h00'];
		array_push($rdv,$rdv1);
		array_push($rdv,$rdv2);
		array_push($rdv,$rdv3);
		$this->render("visualisationRendezvous",$rdv);
	}
}
?>
