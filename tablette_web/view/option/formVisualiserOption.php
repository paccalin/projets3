<table class='tableAffichage'>
	<tr><th>Libelle</th><th>Description</th><th>Prix de base</th><th>Prix moyen pratiqué</th></tr>
	<?php
		echo"<tr><td>".$data['option']['libelle']."</td><td>".$data['option']['description']."</td><td>".$data['option']['prixDeBase']." €</td><td>".$data['option']['prixMoyen']." €</td></tr>";
	?>
</table>
Tarifs par modèle: <br/>
<table class='tableAffichage'>
	<tr><th>Modèle</th><th>Tarif</th></tr>
<?php
	foreach($data['joinVehiculeOption'] as $joinVehiculeOption){
		echo '<tr><td>'.$joinVehiculeOption['modele'].'</td><td>'.$joinVehiculeOption['prix'].' €</td></tr>';
	}
?>
</table>
