<a href='./?r=<?php echo $data['retour'];?>' class='lien'><img src='./images/back.png' alt='Retour' class="imageButton"></a>
<?php
	if($_SESSION['droits']>=1 AND $_SESSION['mode']=='utilisateur'){
		echo "<a href='./?r=vehicule/modifier&id=".$_GET['id']."'><img src='./images/crayon.png' class='imageButton' alt='Modifier les données'></a>";
		echo "<a href='./?r=vehicule/supprimer&id=".$_GET['id']."'><img src='./images/delete.png' class='imageButton rouge' alt='Supprimer'></a><br/>";
	}
?>
<table class='tableAffichage'>
	<tr><th>Modèle</th><th>Client</th><th>Immatriculation</th><tr>
	<?php
		echo "<tr><td>".$data['vehicule']->modele->libelle."</td><td>".$data['vehicule']->client->nom." ".$data['vehicule']->client->prenom."</td><td>".$data['vehicule']->immatriculation."</td></tr>";
	?>
</table>
<br/>
Liste des options installées:
<table class='tableAffichage'>
	<tr><th>Libellé</th><th>Description</th><tr>
	<?php
		echo "<tr><td></td><td></td><td></td></tr>";
	?>
</table>
<br/>
Photos:


<!--<?php
	/* Réparer la mise en page en faisant un truc dans le genre */
	if($_SESSION['droits']>=1 AND $_SESSION['mode']=='utilisateur'){
?>
		<a href='./?r=vehicule/modifier&id=".$_GET['id']."'><img src='./images/crayon.png' class='imageButton' alt='Modifier les données'></a>
		<a href='./?r=vehicule/supprimer&id=".$_GET['id']."'><img src='./images/delete.png' class='imageButton rouge' alt='Supprimer'></a><br/>
<?php
	}
?>-->
