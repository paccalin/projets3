<?php
	if($data['statut']=='non connecte'){
		echo 'L\'application Python n\'est pas connectée';
	}elseif($data['statut']=='connecte'){
		echo 'L\'application Python est connectée';
	}
?>