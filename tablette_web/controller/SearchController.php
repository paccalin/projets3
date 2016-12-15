<?php

class SearchController extends Controller {

	public function view_page(){
		$d = array();
		$d["Search/main"] = array();

		if(isset(parameters()["picId"]))
			throw new Exception("not implemented conditionned method: SearchController->viewPage() ");
		else
			$d["Search/main"]["photoList"] = Photo::FindAll();

		$this->render("main", $d);
	}
}

?>