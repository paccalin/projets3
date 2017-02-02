<table class='tableAffichage'>
<tr><th>Option</th><th>Cout</th></tr>
<?php
	//var_dump($data['joinOptionsPanier']);
	foreach($data['joinOptionsPanier'] as $joinOptionsPanier){
		echo "<tr><td><a href='./?r=option/visualiser&option=".$joinOptionsPanier['option']->id."&retour=panier/showPanierClient'><img src='./images/plus.png' class='petitBoutonAjouter'>".$joinOptionsPanier['option']->libelle."</a></td><td>".number_format($joinOptionsPanier['option']->prixDeBase, 0,'',' ')." €</td></tr>";
	}
?>
</table>
Total: X
<br/>
<a href='' class='lien'>Générer le bon de commande PDF</a>
