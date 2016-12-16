<?php
class DevisController extends Controller{
	public function show(){
		$constructeurs = Constructeur::FindAll();
		
		$modeles = Modele::FindAll();
		
		//$modele->constructeur;
		
		$data = ['constructeurs'=>$constructeurs, 'modeles'=>$modeles];
		
		$this->render("show", $data);
	}
}
