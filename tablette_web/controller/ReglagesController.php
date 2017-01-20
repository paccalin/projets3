<?php
class ReglagesController extends Controller{
	public function AfficheMiseAJour(){
		$data['statut']='non connecte';/* non connecte - connecte */
		$data['nbMaj']=Socket::compteMajEnAttente('tablette');
		$data['derniereConnexion']='X';
		$data['derniereMaj']='X';
		$this->render('afficheMiseAJour',$data);
	}

	public function MettreAJour(){
		$sockets=Socket::findAllFor('tablette');
		foreach($sockets as $socket){
			Socket::read($socket);
		}
		header('Location: ./?r=reglages/AfficheMiseAjour');
	}
}
?>
