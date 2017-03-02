<a href='./?r=constructeursModeles/afficher' class='lien'><img src='./images/back.png' alt='Retour' class="imageButton"></a>
<table class='tableAffichage'>
	<tr><th>Libelle</th></tr>
	<?php
		echo "<tr><td>".$data['constructeur']->libelle."</td></tr>";
	?>
</table>
<a href='./?r=constructeursModeles/modifierConstructeur&constructeur=<?php if(isset($_GET['constructeur'])){echo $_GET['constructeur'];}?>' class='lien'><img src='./images/crayon.png' class='imageButton' alt='Modifier les données'></a>
