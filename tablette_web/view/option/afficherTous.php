<?php
	if($_SESSION['droits']>=2 AND $_SESSION['mode']=='utilisateur'){
		echo "<a href='.?r=option/creer' class='lien'><img src='./images/plus.png' class='imageButton ajout' alt='Ajouter option'></a>";
	}
?>
<table class='tableAffichage'>
	<tr><th>Libelle</th><th>Prix de base</th><th>Type</th></tr>
	<?php
		foreach($data['options'] as $option){
			echo"<tr><td><a href='./?r=option/visualiser&option=".$option->id."'><img src='./images/loupe.png' class='petitBouton'>".$option->libelle."</a></td><td>".number_format($option->prixDeBase, 0,'',' ')." €</td><td><a href='./?r=option/visualiserParType&type=".$option->typeOption->id."'><img src='./images/loupe.png' class='petitBouton'>".$option->typeOption->libelle."</td></tr>";
		}
	?>
</table>
