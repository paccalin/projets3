<!DOCTYPE html> 
<html>
	<head>
		<meta http-equiv="content-type" content="text/html; charset=utf-8" />
		<title>ShowRoom</title>
		<link rel="icon" href="images/favicon.png">
		<link rel="stylesheet" type="text/css" href="css/style.css" />
		<link rel="stylesheet" type="text/css" href="css/diapo.css" />
		<link rel="stylesheet" type="text/css" href="css/menuDefil.css" />
		<link rel="stylesheet" type="text/css" href="css/index.css" />
		<link rel="stylesheet" type="text/css" href="css/animate.css" />
		<link rel="stylesheet" type="text/css" href="css/mosaic.css" />

		<script type='text/javascript' src='./js/jquery.js'></script>
		<script type='text/javascript' src='./js/jquery-ui.js'></script>
		<script type='text/javascript' src='./js/picture.js'></script>
		
	</head>
	<?php
		//$_SESSION=[];
		if(empty($_SESSION)){
			$_SESSION['droits']=0;
			$_SESSION['utilisateur']=-1;
			$_SESSION['client']=-1;
			$_SESSION['mode']='utilisateur';
		}
		/*
		print("  --code à enlever dans head.php--  ");
		print_r($_SESSION);
		*/
	?>
