<?php

class DiapoController extends Controller {

	public function view_diapo(){
		$d = array();
		$d["Components/main"] = array();
		$d["Components/main"]["photoList"] = Photo::FindAll();
		$this->render("main", $d);
	}
}
?>