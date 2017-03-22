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
<div id="listeoptions">Liste des options installées:</div><br/>
<table class='tableAffichage'>
	<tr><th>Libellé</th><th>Description</th><tr>
	<?php
		echo "<tr><td></td><td></td><td></td></tr>";
	?>
</table>
<br/>
<div id="photos">Photos:</div>
