<?php

	function showTiles($pPhotoList){
		$returnValue = "";
		foreach ($pPhotoList as $aPhoto) {
			$returnValue .= showTile($aPhoto);
		}
		return $returnValue;		
	}

	function showTile($pAPhoto){
		$returnValue = "";
		$returnValue .= "<div class='aTile'>";
		$returnValue .= "<a href='?r=Diapo/view_vehicle&vid=".$pAPhoto->vehicule->id."'>";
		$returnValue .= "<img class='diapoImg' src='".$pAPhoto->path."'>";
		$returnValue .= "</a>";
		$returnValue .= "</div>";
		return $returnValue;
	}

?>