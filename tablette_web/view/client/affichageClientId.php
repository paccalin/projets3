<table class="tableAffichage">
	<tr><th>Nom</th><th>Prénom</th><th>Adresse</th><th>Ville</th><th>Mail</th><th>Téléphone</th></tr>
	<?php
		echo "<tr><td>".$data['client']['nom']."</td><td>".$data['client']['prenom']."</td><td>".$data['client']['adresse']."</td><td>".$data['client']['ville']."</td><td>".$data['client']['mail']."</td><td>".$data['client']['tel']."</td></tr>";
	?>
</table>
<?php
	echo "<a href='./?r=client/modifier&id=".$data['client']['id']."'>Modifier les données</a><br/>"
?>
Véhicules:
<table class="tableAffichage">
	<tr><th>Marque</th><th>Modèle</th><th>Immatriculation</th></tr>
	<?php
		foreach($data['vehicules'] as $vehicule){
			echo "<tr><td>".$vehicule['marque']."</td><td>".$vehicule['modele']->libelle."</td><td>".$vehicule['immatriculation']."</td></tr>";
		}
	?>
</table>
<a href="">Ajouter un véhicule</a><br/>
