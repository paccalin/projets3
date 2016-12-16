<?php

class DiapoController extends Controller {

	public function view_diapo(){
		$d = array();
		$d["Diapo/main"] = array();
		$d["Diapo/main"]["photoList"] = Photo::FindAll();
		$this->render("main", $d);
	}
}
?>