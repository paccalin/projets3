<!DOCTYPE html> 
<html>
	<head>
		<meta http-equiv="content-type" content="text/html; charset=utf-8" />
		<title>ShowRoom</title>
		<link rel="stylesheet" type="text/css" href="css/style.css" />
		<link rel="stylesheet" type="text/css" href="css/diapo.css" />
		<link rel="stylesheet" type="text/css" href="css/mosaic.css" />
		<link rel="stylesheet" type="text/css" href="css/menuDefil.css" />
		<link rel="stylesheet" type="text/css" href="css/animate.css" />
		<link rel="icon" type="image/png" href="images/favicon.png" />

		<script type='text/javascript' src='./js/jquery.js'></script>
		<script type='text/javascript' src='./js/jquery-ui.js'></script>
		<script type='text/javascript' src='./js/picture.js'></script>
		
	</head>
	<?php
		if(!isset($_SESSION['droits'])){
			$_SESSION['droits']=0;
			$_SESSION['identifiant']="";
		}
		/*
		print("  //code à enlever dans head.php//  ");
		print_r($_SESSION);
		*/
	?>
