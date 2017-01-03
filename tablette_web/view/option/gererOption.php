<table class='tableAffichage'>
	<tr><th>Libelle</th><th>Prix de base</th></tr>
	<?php
		foreach($data['options'] as $option){
			echo"<tr><td><a href='./?r=option/visualiserModifier&option=".$option['id']."'>".$option['libelle']."</a></td><td>".$option['prixDeBase']." €</td></tr>";
		}
	?>
</table>
<?php
	if($_SESSION['droits']>=2){
		echo "<a href='./?r=option/creer'>Ajouter une option</a>";
	}
?>
