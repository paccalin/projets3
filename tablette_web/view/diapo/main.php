<?php
if (isset($data["Diapo/main"]))
	$windowData = $data["Diapo/main"];
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
		echo showDesc($photoList);
	echo "</div>";
echo "</div>";
?>
<script type='text/javascript' src='./js/diapo.js'></script>