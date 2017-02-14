<?php

	function showSearchBar($pConstructeurList, $pModeleList){
		$returnValue = "";
		$returnValue .= "<div class='searchBar'>";
		$returnValue .= "<form>";
		$returnValue .= "<span class='icon'><i class='fa fa-search'></i></span>";


      	$returnValue .= "<input type='search' id='searchtxt' placeholder='Search...' />";
            $returnValue .= "<br/><br/>";


            $returnValue .= "<h3>Marque et modèles: </h3>";
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
            $returnValue .= "<br/><br/>";


            $returnValue .= "<h3>Types de produits: </h3>";
            $returnValue .= "<input type='checkbox' id='cbox1' value='first_checkbox'> This is the first checkbox</label>";

            $returnValue .= "<input type='checkbox' id='cbox2' value='second_checkbox'> <label for='cbox2'>This is the second checkbox</label>";



      	$returnValue .= "</form>";
		$returnValue .= "</div>";
		return $returnValue;
	}

?>
