<a href='.?r=panier/creer' class='lien'><img src="./images/plus.png" class="imageButton" class="ajout" alt="Créer panier"></a>
<a href='.?r=panier/rechercher' class='lien'><img src="./images/loupe.png" class="imageButton" class="recherche" alt="Rechercher panier"></a>
<table class='tableAffichage'>
	<tr><th>Client</th><th>Nombre d'options</th><th>Coût total</th></tr>
	<?php
		foreach($data['paniers'] as $panier){
			echo "\n\t\t<tr><td><img src='./images/plus.png' class='petitBouton'><a href='./?r=panier/afficherParId&panier=".$panier->id."'>".$panier->client->nom." ".$panier->client->prenom."</a></td><td>".$panier->getNbOptions()."</td><td>".number_format($panier->getCoutTotal(), 0,'',' ')." €</td></tr>";
		}
		echo "\n\t";
	?>
</table>
