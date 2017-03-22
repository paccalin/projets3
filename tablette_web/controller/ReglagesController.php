<?php
class ReglagesController extends Controller{

	public function index(){
		$data['nbMaj']=Socket::compteMajEnAttente('tablette');
		$data['nbEnv']=Socket::compteMajEnAttente('centrale');
		$data['derniereConnexion']='-';
		$data['derniereMaj']='-';
		$data['central']='http://192.168.1.41/projets3/tablette_web/ajax/testConnexion.php'; /* fichier de test pour le ping */
		$data['ipCentral']='192.168.1.41'; /* adresse IP de l'app centrale */
		$data['ip']=getIp();
		$this->render('afficherMiseAJour',$data);
	}

	public function MettreAJour(){
		$sockets=Socket::findAllFor('tablette');
		$data['trace'] = Socket::readMultiple($sockets,0);
		//print_r($data['traces']);
		$this->render('afficherFinInstallationMaj',$data);
	}
	
	public function AfficherIP(){
		$data['ip']=getIp();
		$this->render('afficherIP',$data);
	}
}
?>
