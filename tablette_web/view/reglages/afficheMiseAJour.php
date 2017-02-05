<?php
	if($data['statut']=='non connecte'){
		echo '<p>L\'application centrale n\'est pas connectée</p>';
	}elseif($data['statut']=='connecte'){
		echo '<p>L\'application centrale est connectée</p>';
	}
?>
<p>Données en attentes de mise à jour : <?php echo $data['nbMaj'];?></p>
<p>Dernière connexion  : <?php echo $data['derniereConnexion'];?></p>
<p>Dernière mise à jour : <?php echo $data['derniereMaj'];?></p>
<p><a href='./?r=reglages/MettreAJour' class='lien'><input type='button' value='Effectuer une mise à jour' class='otherButton'/></a></p>
