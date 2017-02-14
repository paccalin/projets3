<?php

class SearchVehicleAjax extends Controller {
	public function index(){
		if(isset(parameters()['searchtxt']) && parameters()['searchtxt'] != "")
		{
			echo(parameters()['searchtxt']);
		}
		if(isset(parameters()['constructeur']) && parameters()['constructeur'] != "")
		{
			echo(parameters()['constructeur']);
		}
		if(isset(parameters()['modele']) && parameters()['modele'] != "")
		{
			echo(parameters()['modele']);
		}
		if(isset(parameters()['cbox1']) && parameters()['cbox1'] != "")
		{
			echo(parameters()['cbox1']);
		}
		if(isset(parameters()['cbox2']) && parameters()['cbox2'] != "")
		{
			echo(parameters()['cbox2']);
		}

		$this->showVehicles(Photo::FindAll());
	}

	private function showVehicles($pPhotoList){
		include_once("view/search/Components/Tiles.php");
		echo showTiles($pPhotoList);
	}
}

?>