<?php

	function showTiles($pPhotoList){
		$returnValue = "";
		$returnValue .= "<div class='mosaicContainer'>";
		foreach ($pPhotoList as $aPhoto) {
			$returnValue .= showTile($aPhoto);
		}
		$returnValue .= "</div>";
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