<?php

class SearchVehicleAjax extends Controller {
	public function index(){

		$constructeur = null;
		if(parameters()['constructeur'] != -1)
			$constructeur = Constructeur::FindById(parameters()['constructeur']);

		$modele = null;
		if(parameters()['modele'] != -1 && parameters()['modele'] != -1)
			$modele = Modele::FindById(parameters()['modele']);

		$optionTypeList = array();
		if(isset(parameters()['optionTypes']))
			foreach (parameters()['optionTypes'] as $aTypeId) {
				$optionTypeList[] = TypeOption::FindById($aTypeId);
			}

		$correspondingVecicles = Vehicule::AdvancedSearch(
			parameters()['searchtxt'],
			$constructeur,
			$modele,
			$optionTypeList);
		
		$photoToshow = array();
		foreach ($correspondingVecicles as $aVehicule) {
			$photoToshow[] = Photo::FindByVehicule($aVehicule->id);
		}

		$this->showVehicles($photoToshow);
	}

	private function showVehicles($pNonFlatPhotoList){

		$photoToshow = flattenArray($pNonFlatPhotoList);
		$photoToshow = $this->deletePhotoArrayDuplicate($photoToshow);

		include_once("view/search/Components/Tiles.php");
		echo showTiles($photoToshow);
	}

	private function deletePhotoArrayDuplicate($pPhotoArray){
		$tmp = array();
		foreach($pPhotoArray as $i => $aPhoto)
		    $tmp[$i] = $aPhoto->id;

		// Find duplicates in temporary array
		$tmp = array_unique($tmp);

		// Remove the duplicates from original array
		foreach($pPhotoArray as $i => $aPhoto)
		{
		    if (!array_key_exists($i, $tmp))
		        unset($pPhotoArray[$i]);
		}

		return $pPhotoArray;
	}
}

?>