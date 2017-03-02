<?php

	function showSearchBar($pConstructeurList, $pModeleList, $pOptionTypes){
		$returnValue = "";
		$returnValue .= "<div class='searchBar'>";
		$returnValue .= "<form id='globalSearch'>";
      	$returnValue .= "<span class='icon'><i class='fa fa-search'></i></span>";


      	$returnValue .= "<input type='search' id='searchtxt' name='searchtxt' placeholder='Search...' />";
            $returnValue .= "<br/><br/>";


            $returnValue .= "<h3>Marque et modèles: </h3>";
      	$returnValue .= "<select id='constructeur' name='constructeur'>";
            $returnValue .= "<option value='-1' class='-1'>Tout les constructeurs</option>";
      	foreach ($pConstructeurList as $aConstructeur) {
      		$returnValue .= "<option value='".$aConstructeur->id."' class='".$aConstructeur->libelle."'>".$aConstructeur->libelle."</option>";
      	}
      	$returnValue .= "</select>";

      	$returnValue .= "<select id='modele' name='modele'>";
            $returnValue .= "<option value='-1' class='-1'>Tout les modèles</option>";
      	foreach ($pModeleList as $aModele) {
      		$returnValue .= "<option value='".$aModele->id."' class='".$aModele->constructeur->libelle."'>".$aModele->libelle."</option>";
      	}
      	$returnValue .= "</select>";
            $returnValue .= "<br/><br/>";


            $returnValue .= "<h3>Types de produits: </h3>";

            foreach ($pOptionTypes as $aType) {
                  $returnValue .= "<input type='checkbox' name='optionTypes[]' id='".$aType->id."' value='".$aType->id."' checked>";
                  $returnValue .= "<label for='".$aType->id."'>".$aType->libelle."</label>";
            }



      	$returnValue .= "</form>";
		$returnValue .= "</div>";
		return $returnValue;
	}

?>
