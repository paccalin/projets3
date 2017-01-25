<?php
	if($data['statut']=='non connecte'){
		echo "<p>L'application Python n'est pas connectée</p>";
		echo "<p>Pour créer une connexion avec l'application Python, rentrer l'adresse IP de la tablette dans les réglages de l'application Python</p>";
		echo "<p>L'adresse est visible dans les options en dessous</p>";
	}elseif($data['statut']=='connecte'){
		echo "<p>L\'application Python est connectée</p>";
	}
?>
<br/>
<p>Données en attentes de mise à jour : <?php echo $data['nbMaj'];?></p>
<p>Dernière connexion  : <?php echo $data['derniereConnexion'];?></p>
<p>Dernière mise à jour : <?php echo $data['derniereMaj'];?></p>
<p><a href='./?r=reglages/MettreAJour' class='lien'>Effectuer une mise à jour</a></p>
<p><a href='./?r=reglages/AfficherIP' class='lien'>Afficher l'adresse IP</a></p>
<br/>
<p><i>Cette partie est en cours de développement, les fonctionnalités ne sont pas encore déployées sur cette version</i></p>
