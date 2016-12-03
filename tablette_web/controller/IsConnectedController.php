<?php 
/* Droits des utilisateurs:
	0:non connecté
	1:connecté
	2:administrateur
	3:super-administrateur
 */
session_start();
if(!isset($_SESSION['droits'])){
	$_SESSION['droits'] = 1;
}
echo json_encode($_SESSION['droits']);

?>
