<?php
class ReglagesController extends Controller{
	public function AfficherMiseAJour(){
		$data['statut']='non connecte';/* non connecte - connecte */
		$data['nbMaj']=Socket::compteMajEnAttente('tablette');
		$data['derniereConnexion']='-';
		$data['derniereMaj']='-';
		$this->render('afficherMiseAJour',$data);
	}

	public function MettreAJour(){
		$sockets=Socket::findAllFor('tablette');
		foreach($sockets as $socket){
			Socket::read($socket);
		}
		header('Location: ./?r=reglages/AfficherMiseAjour'); /* Commenter pour le debug */
	}
	
	public function AfficherIP(){
		if(!empty($_SERVER['HTTP_CLIENT_IP'])){
			$data['ip'] = $_SERVER['HTTP_CLIENT_IP'];
		}elseif(!empty($_SERVER['HTTP_X_FORWARDED_FOR'])){
			$data['ip'] = $_SERVER['HTTP_X_FORWARDED_FOR'];
		}else{
			$data['ip'] = $_SERVER['REMOTE_ADDR'];
		}
		$this->render('afficherIP',$data);
	}
}
?>
