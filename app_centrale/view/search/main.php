<?php
if (isset($data["Search/main"]))
	$windowData = $data["Search/main"];
else
	$windowData = array();


include_once("Components/Tiles.php");
include_once("Components/SearchBar.php");

if (isset($windowData["photoList"]))
	$photoList = $windowData["photoList"];
else
	$photoList = array();

echo "<div id='searchView'>";
	echo showSearchBar($windowData["constructeurs"], $windowData["modeles"], $windowData["optionTypes"]);

	echo("<div class='mosaicContainer'>");
	echo showTiles($photoList);
	echo("</div>");

echo "</div>";
?>