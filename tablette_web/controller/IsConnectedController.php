<?php 
/* Droits des utilisateurs:
	0:non connecté
	1:connecté
	2:administrateur
	3:super-administrateur
 */
session_start();
if(!isset($_SESSION['droits'])){
	$_SESSION['droits'] = 0;
	$_SESSION['identifiant'] = "";
}
echo json_encode($_SESSION['droits']);
?>
