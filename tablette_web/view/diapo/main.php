<?php
if (isset($data["Components/main"]))
	$windowData = $data["Components/main"];
else
	$windowData = array();

include_once("Components/Diapo.php");

if (isset($windowData["photoList"]))
	$photoList = $windowData["photoList"];
else
	$photoList = array();

echo "<div id='DiapoView'>";
	echo "<div id='leftContainer'>";
	    echo "<div id='diapo'>";
	        echo showDiapo($photoList);
	    echo "</div>";
	    echo "<div id='bandeImg'>";
	    	echo showBandeImg($photoList);
	    echo "</div>";
	echo "</div>";

	echo "<div id='desc'>";
		echo "Mdèr";
	echo "</div>";
echo "</div>";
?>