<table class="tableAffichage">
	<tr><th>Constructeurs</th><th>Modèles</th></tr>
	<?php
		foreach($data as $row){
			echo "<tr><td><a href='./?r=constructeursModeles/afficherConstructeur&constructeur=".$row['constructeur']->id."'>".$row['constructeur']->libelle."</a></td><td><a href='./?r=constructeursModeles/afficherModele&modele=".$row['modele']->id."'>".$row['modele']->libelle."</a></td></tr>";
		}
	?>
</table>
<?php
	if($_SESSION['droits']>=2){
		echo '<a href="./?r=constructeursModeles/ajouter&ajout=constructeur">Ajouter un constructeur</a><br/>';
		echo '<a href="./?r=constructeursModeles/ajouter&ajout=modele">Ajouter un modèle</a>';
	}
?>
