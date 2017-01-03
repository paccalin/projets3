<table class="tableAffichage">
	<tr><th>Constructeurs</th><th>Modèles</th></tr>
	<?php
		foreach($data as $row){
			echo "<tr><td>".$row['constructeur']."</td><td>".$row['modele']."</td></tr>";
		}
	?>
</table>
<?php
	if($_SESSION['droits']>=2){
		echo '<a href="./?r=constructeursModeles/ajouter&ajout=constructeur">Ajouter un constructeur</a><br/>';
		echo '<a href="./?r=constructeursModeles/ajouter&ajout=modele">Ajouter un modèle</a>';
	}
?>
