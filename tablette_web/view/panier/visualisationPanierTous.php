<a href='.?r=panier/creer' class='lien'><img src="./images/plus.png" class="imageButton" class="ajout" alt="Créer panier"></a>
<a href='.?r=panier/rechercher' class='lien'><img src="./images/loupe.png" class="imageButton" class="recherche" alt="Rechercher panier"></a>
<table class='tableAffichage'>
	<tr><th>Client</th><th>Nombre d'options</th><th>Actif</th></tr>
	<?php
		foreach($data['paniers'] as $panier){
			echo "<tr><td><a href='./?r=panier/afficherParID&devis=".$panier->id."'>".$panier->client->nom." ".$panier->client->prenom."</a></td>";
			if($panier->actif==1){
				echo "<td><a href='./?r=panier/afficherParID&devis=".$panier->id."'>oui</a></td></tr>";
			}else{
				echo "<td><a href='./?r=panier/afficherParID&devis=".$panier->id."'>non</a></td></tr>";
			}
		}
	?>
</table>
