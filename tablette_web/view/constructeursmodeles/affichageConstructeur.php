<a href='./?r=constructeursModeles/afficher' class='lien'>Retour</a>
<table class='tableAffichage'>
	<tr><th>Libelle</th></tr>
	<?php
		echo "<tr><td>".$data['constructeur']->libelle."</td></tr>";
	?>
</table>
<a href='./?r=constructeursModeles/modifierConstructeur&constructeur=<?php if(isset($_GET['constructeur'])){echo $_GET['constructeur'];}?>' class='lien'>Modifier</a>