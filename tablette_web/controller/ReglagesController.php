<?php
class ReglagesController extends Controller{

	public function index(){
		$data['statut']='non connecte';/* non connecte - connecte */
		$data['nbMaj']=Socket::compteMajEnAttente('tablette');
		$data['nbEnv']=Socket::compteMajEnAttente('centrale');
		$data['derniereConnexion']='-';
		$data['derniereMaj']='-';
		$data['central']='http://192.168.1.136/projets3/tablette_web/ajax/testConnexion.php';
		$data['ipCentral']='192.168.1.136';
		$data['ip']=getIp();
		$this->render('afficherMiseAJour',$data);
	}

	public function MettreAJour(){
		$sockets=Socket::findAllFor('tablette');
		foreach($sockets as $socket){
			Socket::read($socket);
		}
		header('Location: ./?r=reglages/index'); /* Commenter pour le debug */
	}
	
	public function AfficherIP(){
		$data['ip']=getIp();
		$this->render('afficherIP',$data);
	}
}
?>
