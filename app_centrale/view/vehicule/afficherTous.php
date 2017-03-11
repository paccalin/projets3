<?php
	if($_SESSION['droits']>=2 AND $_SESSION['mode']=='utilisateur'){
		echo "<a href='.?r=vehicule/creer' class='lien'><img src='./images/plus.png' class='imageButton ajout' alt='Ajouter véhicule'></a>";
	}
?>
<table class='tableAffichage'>
	<tr><th>Modèle</th><th>Client</th><th>Immatriculation</th></tr>
	<?php
		foreach($data['vehicules'] as $vehicule){
			echo"<tr><td><a href='./?r=vehicule/visualiser&vehicule=".$vehicule->id."'><img src='./images/loupe.png' class='petitBouton'>".$vehicule->modele->libelle."</a></td><td><a href='./?r=vehicule/visualiser&vehicule=".$vehicule->id."'>".$vehicule->client->nom." ".$vehicule->client->prenom."</a></td><td><a href='./?r=vehicule/visualiser&vehicule=".$vehicule->id."'>".$vehicule->immatriculation."</a></td></tr>";
		}
	?>
</table>
