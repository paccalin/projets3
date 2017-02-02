<a href='.?r=panier/creer' class='lien'><img src="./images/plus.png" class="imageButton" class="ajout" alt="Créer panier"></a>
<a href='.?r=panier/rechercher' class='lien'><img src="./images/loupe.png" class="imageButton" class="recherche" alt="Rechercher panier"></a>
<table class='tableAffichage'>
	<tr><th>Client</th><th>Nombre d'options</th></tr>
	<?php
		foreach($data['paniers'] as $panier){
			echo "<tr><td><img src='./images/plus.png' class='petitBoutonAjouter'><a href='./?r=panier/afficherParID&panier=".$panier->id."'>".$panier->client->nom." ".$panier->client->prenom."</a></td></tr>";
		}
	?>
</table>
