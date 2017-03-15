<a href='./?r=constructeursModeles/afficher' class='lien'><img src='./images/back.png' alt='Retour' class="imageButton"></a>
<?php
	if($_SESSION['droits']>=2){
		echo "<a href='./?r=constructeursModeles/modifierConstructeur&constructeur=".$_GET['constructeur']."' class='lien'><img src='./images/crayon.png' class='imageButton' alt='Modifier les données'></a>";
	}
?>
<table class='tableAffichage'>
	<tr><th>Libelle</th></tr>
	<?php
		echo "<tr><td>".$data['constructeur']->libelle."</td></tr>";
	?>
</table>
<br/>
Liste des mod&egrave;les de ce constructeur
<table class='tableAffichage'>
	<tr><th>Modèle</th><th>Catégorie</th></tr>
	<?php
		foreach($data['modeles'] as $modele){
			echo "<td><a href='./?r=constructeursModeles/afficherModele&modele=".$modele->id."&retour=constructeursModeles/afficherConstructeur-constructeur=".$data['constructeur']->id."'><img src='./images/loupe.png' class='petitBouton'>".$modele->libelle."</a></td><td><a href='./?r=constructeursModeles/afficherTypeModele&id=".$modele->typeModele->id."&retour=constructeursModeles/afficherConstructeur-constructeur=".$data['constructeur']->id."'><img src='./images/loupe.png' class='petitBouton'>".$modele->typeModele->libelle."</a></td></tr>";
		}
	?>
</table>