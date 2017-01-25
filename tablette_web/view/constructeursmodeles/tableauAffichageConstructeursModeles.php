<table class="tableAffichage">
	<tr><th>Constructeurs</th><th>Modèles</th></tr>
	<?php
		foreach($data as $row){
			echo "<tr><td><a href='./?r=constructeursModeles/afficherConstructeur&constructeur=".$row['constructeur']->id."'>".$row['constructeur']->libelle."</a></td>";
			if($row['modele']==null){
				echo "<td><span class='lien'><i>Aucun modèle</i></span></td></tr>";
			}else{
				echo "<td><a href='./?r=constructeursModeles/afficherModele&modele=".$row['modele']->id."'>".$row['modele']->libelle."</a></td></tr>";
			}
		}
	?>
</table>
<?php
	if($_SESSION['droits']>=2){
		echo '<a href="./?r=constructeursModeles/ajouter&ajout=constructeur"><input type="button" value="ajouter un constructeur" class="otherButton"/></a>';
		echo '<a href="./?r=constructeursModeles/ajouter&ajout=modele"><input type="button" value="ajouter un modèle" class="otherButton"/></a>';
	}
?>
