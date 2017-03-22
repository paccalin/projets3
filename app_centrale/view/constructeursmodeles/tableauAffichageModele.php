<a href='./?r=constructeursModeles/afficher' class='lien'><img src='./images/back.png' alt='Retour' class="imageButton"></a>
<table class="tableAffichage">
	<tr><th>Constructeur</th><th>Mod&egrave;le</th><th>Catégorie</th></tr>
	<?php
		echo '<tr><td>'.$data['modele']->constructeur->libelle.'</td><td>'.$data['modele']->libelle.'</td><td>'.$data['modele']->typeModele->libelle.'</td></tr>';
	?>
</table>
<?php
	if($_SESSION['droits']>=2){
		echo "<a href='./?r=constructeursModeles/modifierModele&modele=".$_GET['modele']."' class='lien'><img src='./images/crayon.png' class='imageButton' alt='Modifier les données'></a>";
	}
?>
<br/>
Prix des options pour ce mod&egrave;le
<table class="tableAffichage">
	<tr><th>Libelle</th><th>Prix</th></tr>
	<?php
		foreach($data['joinTypeModeleOption'] as $joinTypeModeleOption){
			echo "<tr><td><img src='./images/plus.png' class='petitBouton'><a href='./?r=option/visualiser&option=".$joinTypeModeleOption['option']->id."&retour=constructeursModeles/afficherModele-modele=".$_GET['modele']."'>".$joinTypeModeleOption['option']->libelle."</a><td>".number_format($joinTypeModeleOption['prix'], 0,'',' ')." €</td></tr>";
		}
	?>
</table>

