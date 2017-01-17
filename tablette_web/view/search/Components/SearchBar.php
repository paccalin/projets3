<?php

	function showSearchBar($pConstructeurList, $pModeleList){
		$returnValue = "";
		$returnValue .= "<div class='searchBar'>";
		$returnValue .= "<form>";
		$returnValue .= "<span class='icon'><i class='fa fa-search'></i></span>";

      	$returnValue .= "<input type='search' id='searchtxt' placeholder='Search...' />";

      	$returnValue .= "<select id='constructeur' name='constructeur'>";
      	foreach ($pConstructeurList as $aConstructeur) {
      		$returnValue .= "<option value='".$aConstructeur->id." class='".$aConstructeur->libelle."'>".$aConstructeur->libelle."</option>";
      	}
      	$returnValue .= "</select>";

      	$returnValue .= "<select id='modele' name='modele'>";
      	foreach ($pModeleList as $aModele) {
      		$returnValue .= "<option value='".$aModele->id."' class='".$aModele->constructeur->libelle."'>".$aModele->libelle."</option>";
      	}
      	$returnValue .= "</select>";

      	$returnValue .= "</form>";
		$returnValue .= "</div>";
		return $returnValue;
	}

?>
