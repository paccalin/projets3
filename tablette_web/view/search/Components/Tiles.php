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
		$returnValue .= "<img class='diapoImg' src='".$pAPhoto->path."'>";
		$returnValue .= "</div>";
		return $returnValue;
	}

?>