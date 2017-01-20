<?php
	if($data['statut']=='non connecte'){
		echo '<p>L\'application Python n\'est pas connectée</p>';
	}elseif($data['statut']=='connecte'){
		echo '<p>L\'application Python est connectée</p>';
	}
?>
<p>Données en attentes de mise à jour : <?php echo $data['nbMaj'];?></p>
<p>Dernière connexion  : <?php echo $data['derniereConnexion'];?></p>
<p>Dernière mise à jour : <?php echo $data['derniereMaj'];?></p>
<p><a href='./?r=reglages/MettreAJour' class='lien'>Effectuer une mise à jour</a></p>
