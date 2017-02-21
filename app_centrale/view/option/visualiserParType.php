<a href='./?r=<?php echo $data['retour']?>' class='lien'><img src='./images/back.png' alt='Retour ' class="imageButton"></a>
<table class='tableAffichage'>
<tr><th>Libelle</th></tr>
<tr><td><?php echo $data['typeOption']->libelle; ?></td></tr>
</table>
Options de cette catégorie:
<table class='tableAffichage'>
<tr><th>Option</th><th>Prix de base</th></tr>
<?php
	foreach($data['options'] as $option){
		echo '<tr><td>'.$option->libelle.'</td><td>'.number_format($option->prixDeBase, 0,'',' ').' €</td></tr>';
	}
?>
</table>