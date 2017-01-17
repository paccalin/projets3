<?php

class SearchController extends Controller {
	public function index(){
		$this->view_page();
	}

	public function view_page(){
		$d = array();
		$d["Search/main"] = array();
		$d["Search/main"]["constructeurs"] = Constructeur::FindAll();
		$d["Search/main"]["modeles"] = Modele::FindAll();

		if(isset(parameters()["picId"]))
			throw new Exception("not implemented conditionned method: SearchController->viewPage() ");
		else
			$d["Search/main"]["photoList"] = Photo::FindAll();

		$this->render("main", $d);
	}
}

?>