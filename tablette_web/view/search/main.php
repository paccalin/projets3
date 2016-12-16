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

echo showSearchBar();
echo showTiles($photoList);
?>