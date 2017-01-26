<a href='./?r=constructeursModeles/afficher' class='lien'><img src='./images/back.png' alt='Retour' class="imageButton"></a>
<table class="tableAffichage">
	<tr><th>Constructeur</th><th>Mod&egrave;le</th></tr>
	<?php
		echo '<tr><td>'.$data['constructeur']->libelle.'</td><td>'.$data['modele']->libelle.'</td></tr>';
	?>
</table>
<?php
	if($_SESSION['droits']>=2){
		echo "<a href='./?r=constructeursModeles/modifierModele&modele=".$_GET['modele']."' class='lien'><img src='./images/crayon.png' class='imageButton' alt='Modifier les données'></a>";
	}
?>
<br/>
Prix des options pour ce mod&egrave;le:
<table class="tableAffichage">
	<tr><th>Libelle</th><th>Prix</th></tr>
	<?php
		foreach($data['joinModeleOption'] as $joinModeleOption){
			echo "<tr><td>".$joinModeleOption['option']->libelle."</td><td>".$joinModeleOption['prix']."</td></tr>";
		}
	?>
</table>

