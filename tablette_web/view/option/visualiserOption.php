<a href='<?php if(isset($_GET['retour'])){echo './?r='.$_GET['retour'];}else{echo './?r=option/afficherTous';}?>' class='lien'><img src='./images/back.png' alt='Retour' class="imageButton"></a>
<?php
	if($_SESSION['droits']>=2 AND $_SESSION['mode']=='utilisateur'){
		echo "<a href='./?r=option/modifier&option=".$_GET['option']."'><img src='./images/crayon.png' class='imageButton' alt='Modifier les données'></a><br/>";
	}elseif($_SESSION['mode']=='client'){
		echo "<a href='";
		if(isset($_GET['retour'])){
			echo "./?r=panier/ajouterOption&option=".$_GET['option']."&retour=".$_GET['retour'];
		}else{
			echo "./?r=panier/ajouterOption&option=".$_GET['option'];
		}
		echo "'><img src='./images/panier.png' class='imageButton panier' alt='Ajouter au panier'></a><br/>";
	}
	?>
<table class='tableAffichage'>
	<tr><th>Libelle</th><th>Description</th><th>Prix de base</th><th>Prix moyen pratiqué</th></tr>
	<?php
		echo"<tr><td>".$data['option']->libelle."</td><td>".$data['option']->desc."</td><td>".number_format($data['option']->prixDeBase, 0,'',' ')." €</td><td>".number_format($data['moyenneTarif'], 0,'',' ')." €</td></tr>";
	?>
</table>
<br/>
<table class='tableAffichage'>
	<tr><th>Modèle</th><th>Prix</th></tr>
	<?php
		foreach($data['joinModeleOption'] as $joinModeleOption){
			echo "<tr><td>".$joinModeleOption['modele']->libelle."</td><td>".number_format($joinModeleOption['prix'], 0,'',' ')." €</td></tr>";
		}
	?>
</table>