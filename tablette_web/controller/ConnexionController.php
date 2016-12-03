<?php
class ConnexionController extends Controller{
	public function formConnexion(){
		$this->render("formConnexion");
	}
	public function verifieConnexion(){
		if(isset($_POST['cancel'])){
			header('Location: ./?r=site/index');
		}elseif(isset($_POST['submit'])){
			/*intégrer la fonction de connexion */
			header('Location: ./?r=site/index');
		}
		
	}
}
?>
