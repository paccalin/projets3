<a href='./?r=panier/afficherTous' class='lien'><img src='./images/back.png' alt='Retour' class="imageButton"></a>
<table class='tableAffichage'>
<tr><th>Option</th><th>Coût unitaire</th><th>Nombre</th><th>Supprimer</th></tr>
<?php
	//var_dump($data['joinOptionsPanier']);
	foreach($data['joinOptionsPanier'] as $joinOptionsPanier){
		echo "<tr><td><a href='./?r=option/visualiser&option=".$joinOptionsPanier['option']->id."&retour=panier/showPanierClient'><img src='./images/loupe.png' class='petitBouton'>".$joinOptionsPanier['option']->libelle."</a></td><td>".number_format($joinOptionsPanier['option']->prixDeBase, 0,'',' ')." €</td><td>";
		if($joinOptionsPanier['nombre']>0){
			echo "<a href='.?r=panier/changerNombreOptionPanier&changement=moins&panier=".$data['panierId']."&option=".$joinOptionsPanier['option']->id."&retour=".$data['retour']."'><img src='./images/moins.png' class='petitBouton rouge'></a>";
		}else{
			echo "<img src='./images/moins.png' class='petitBouton gris'>";
		}
		echo $joinOptionsPanier['nombre']."<a href='.?r=panier/changerNombreOptionPanier&changement=plus&panier=".$data['panierId']."&option=".$joinOptionsPanier['option']->id."&retour=".$data['retour']."'><img src='./images/plus.png' class='petitBouton vert'></a></td><td><a href='.?r=panier/retirerOptionPanier&panier=".$data['panierId']."&option=".$joinOptionsPanier['option']->id."&retour=".$data['retour']."'><img src='./images/poubelle.png' class='petitBouton rouge'></a></td></tr>";
	}
?>
</table>
Total: <?php echo number_format($data['total'], 0,'',' ');?> €
<br/>
<a href='' class='lien'>Générer le bon de commande PDF</a>
