<a href='.?r=devis/creer' class='lien'><img src="./images/plus.png" class="imageButton" class="ajout" alt="Ajouter devis"></a>
<a href='.?r=devis/rechercher' class='lien'><img src="./images/loupe.png" class="imageButton" class="recherche" alt="Rechercher devis"></a>
<table class='tableAffichage'>
	<tr><th>Client</th><th>Modèle</th><th>Actif</th></tr>
	<?php
		foreach($data['devis'] as $devis){
			echo "<tr><td><a href='./?r=devis/afficherParID&devis=".$devis->id."'>".$devis->client->nom." ".$devis->client->prenom."</a></td><td><a href='./?r=devis/afficherParID&devis=".$devis->id."'>".$devis->modele->libelle."</a></td>";
			if($devis->actif==1){
				echo "<td><a href='./?r=devis/afficherParID&devis=".$devis->id."'>oui</a></td></tr>";
			}else{
				echo "<td><a href='./?r=devis/afficherParID&devis=".$devis->id."'>non</a></td></tr>";
			}
		}
	?>
</table>
