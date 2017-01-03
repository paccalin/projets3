<?php

class DiapoController extends Controller {
	public function index(){
		$this->view_diapo();
	}

	public function view_diapo($pImgList = null){
		$d = array();
		$d["Diapo/main"] = array();
		
		if(isset(parameters()["dimg"])){
			throw new Exception("Not implemented get parameters handeling in method: controller/DiapoController.php DiapoController->view_diapo()");
		}elseif($pImgList != null){
			$d["Diapo/main"]["photoList"] = array();
			foreach ($pImgList as $anImg){
				array_push($d["Diapo/main"]["photoList"], $anImg);
			}
		}else{
			$d["Diapo/main"]["photoList"] = Photo::FindAll();
		}
		$this->render("main", $d);
	}

	public function view_vehicle(){
		if(isset(parameters()["vid"])){
			$imgList = Photo::FindByVehicule(parameters()["vid"]);
			$this->view_diapo($imgList);
		}
		else
			$this->view_diapo();
	}
}
?>