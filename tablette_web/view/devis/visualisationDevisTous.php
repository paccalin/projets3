<table class='tableAffichage'>
	<tr><th>Client</th><th>Modèle</th><th>Actif</th></tr>
	<?php
		foreach($data['devis'] as $devis){
			echo "<tr><td><a href='./?r=devis/afficherParID&devis=".$devis->id."'>".$devis->client->nom." ".$devis->client->prenom."</a></td><td>".$devis->modele->libelle."</td>";
			if($devis->actif==1){
				echo "<td>oui</td></tr>";
			}else{
				echo "<td>non</td></tr>";
			}
		}
	?>
</table>
<a href='./?r=devis/creer' class='lien'>Ajouter</a>
