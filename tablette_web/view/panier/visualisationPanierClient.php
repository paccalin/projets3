<table class='tableAffichage'>
<tr><th>Option</th><th>Coût unitaire</th><th>Nombre</th></tr>
<?php
	//var_dump($data['joinOptionsPanier']);
	foreach($data['joinOptionsPanier'] as $joinOptionsPanier){
		echo "<tr><td><a href='./?r=option/visualiser&option=".$joinOptionsPanier['option']->id."&retour=panier/showPanierClient'><img src='./images/plus.png' class='petitBoutonAjouter'>".$joinOptionsPanier['option']->libelle."</a></td><td>".number_format($joinOptionsPanier['option']->prixDeBase, 0,'',' ')." €</td><td>".$joinOptionsPanier['nombre']."</td></tr>";
	}
?>
</table>
Total: <?php echo number_format($data['total'], 0,'',' ');?> €
<br/>
<a href='' class='lien'>Générer le bon de commande PDF</a>
