<a href='./?r=constructeursModeles/afficher' class='lien'><img src='./images/back.png' alt='Retour' class="imageButton"></a>
<?php
	if($_SESSION['droits']>=2){
		echo "<a href='./?r=constructeursModeles/modifierTypeModele&id=".$_GET['id']."' class='lien'><img src='./images/crayon.png' class='imageButton' alt='Modifier les données'></a>";
	}
?>
<br/>
<table class='tableAffichage'>
	<tr><th>Libelle</th></tr>
	<?php
		echo "<tr><td>".$data['typeModele']->libelle."</td></tr>";
	?>
</table>
<br/>
Liste des coûts des options
<table class='tableAffichage'>
	<tr><th>Option</th><th>Coût</th></tr>
	<?php
		foreach($data['joinOption'] as $joinOption){
			echo "<td><a href='.?r=option/visualiser&option=".$joinOption['option']->id."&retour=constructeursModeles/afficherTypeModele-typeModele=".$data['typeModele']->id."'><img src='./images/loupe.png' class='petitBouton'>".$joinOption['option']->libelle."</a></td><td>".number_format($joinOption['prix'], 0,'',' ')." €</td></tr>";
		}
	?>
</table>
<br/>
Liste des mod&egrave;les de ce type
<table class='tableAffichage'>
	<tr><th>Constructeur</th><th>Modèle</th></tr>
	<?php
		foreach($data['modeles'] as $modele){
			echo "<td><a href='./?r=constructeursModeles/afficherModele&modele=".$modele->id."&retour=constructeursModeles/afficherTypeModele-typeModele=".$data['typeModele']->id."'><img src='./images/loupe.png' class='petitBouton'>".$modele->constructeur->libelle."</a></td><td><a href='./?r=constructeursModeles/afficherModele&modele=".$modele->id."&retour=constructeursModeles/afficherTypeModele-typeModele=".$data['typeModele']->id."'><img src='./images/loupe.png' class='petitBouton'>".$modele->libelle."</a></td></tr>";
		}
	?>
</table>