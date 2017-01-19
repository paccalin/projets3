<?php
class ReglagesController extends Controller{
	
	public function miseAJour(){
		$data['statut']='non connecte';/* non connecte - connecte */
		$this->render('miseAJour',$data);
	}
}
?>