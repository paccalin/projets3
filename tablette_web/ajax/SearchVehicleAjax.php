<?php

class SearchVehicleAjax extends Controller {
	public function index(){

		$constructeur = null;
		if(parameters()['constructeur'] != -1){
			$constructeur = Constructeur::FindById(parameters()['constructeur']);
			echo("why?");
		}

		$modele = null;
		if(parameters()['modele'] != -1 && parameters()['modele'] != -1)
			$modele = Modele::FindById(parameters()['modele']);

		$optionTypeList = array();
		if(isset(parameters()['optionTypes']))
			foreach (parameters()['optionTypes'] as $aTypeId) {
				$optionTypeList[] = TypeOption::FindById($aTypeId);
			}

		$correspondingVecicles = Vehicule::AdvancedSearch(
			$constructeur,
			$modele,
			$optionTypeList);

		if(isset(parameters()['searchtxt']) && parameters()['searchtxt'] !=""){
			$textSearchResults = Vehicule::SearchByTxt(parameters()['searchtxt']);
			$correspondingVecicles = $this->phpJoinVehicles($correspondingVecicles, $textSearchResults);
		}
		
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

	private function phpJoinVehicles($pFirstArray, $pSecondArray){
		$result = array();
		foreach ($pFirstArray as $aVehicule) {
			foreach ($pSecondArray as $aComparingVehicule) {
				if($aVehicule->id == $aComparingVehicule->id){
					array_push($result, $aVehicule);
				}
			}
		}
		return $result;
	}
}


?>