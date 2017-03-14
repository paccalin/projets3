<a href='./?r=<?php if(isset($_GET['retour'])){echo $_GET['retour'];}else{echo 'client/afficherTous';}?>' class='lien'><img src='./images/back.png' alt='Retour ' class="imageButton"></a>
<table class="tableAffichage">
	<tr><th>Nom</th><th>Prénom</th><th>Adresse</th><th>Ville</th><th>Mail</th><th>Téléphone</th></tr>
	<?php
		echo "<tr><td>".$data['client']->nom."</td><td>".$data['client']->prenom."</td><td>".$data['client']->rue."</td><td>".$data['client']->ville."</td><td>".$data['client']->mail."</td><td>".$data['client']->tel."</td></tr>";
	?>
</table>
<?php
	echo "<a href='./?r=client/modifier&id=".$data['client']->id."'><img src='./images/crayon.png' class='imageButton' alt='Modifier les données'></a><br/>"
?>
<div id="vehicule">Véhicules</div><br/>
<table class="tableAffichage">
	<tr><th>Constructeur</th><th>Modèle</th><th>Immatriculation</th></tr>
	<?php
		foreach($data['vehicules'] as $vehicule){
			echo "<tr><td>".$vehicule->modele->constructeur->libelle."</td><td>".$vehicule->modele->libelle."</td><td>".$vehicule->immatriculation."</td></tr>";
		}
	?>
</table>
<a href="">Ajouter un véhicule</a><br/>
