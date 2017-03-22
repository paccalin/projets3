<a href='./?r=centraleMaj/afficher' class='lien'><img src='./images/back.png' alt='Retour ' class="imageButton"></a>
<?php
	echo "<a href='./?r=centrakeMaj/modifierTablette&id=".$data['tablette']->id."'><img src='./images/crayon.png' class='imageButton' alt='Modifier les données'></a><br/>"
?>
<table class='tableAffichage'>
	<tr><th>Nom</th><th>Dernier envoi de données</th><th>Adresse IP</th><th>Statut</th></tr>
<?php
	echo "<tr><td>".$data['tablette']->nom."</td><td>".$data['tablette']->lastConnect."</td><td>".$data['tablette']->ip."</td><td></td><tr>";
?>
