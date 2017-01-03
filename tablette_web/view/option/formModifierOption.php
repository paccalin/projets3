<table class='tableAffichage'>
	<tr><th>Libelle</th><th>Description</th><th>Prix de base</th><th>Prix moyen pratiqué</th></tr>
	<?php
		echo"<tr><td>".$data['option']['libelle']."</td><td>".$data['option']['description']."</td><td>".$data['option']['prixDeBase']." €</td><td>".$data['option']['prixMoyen']." €</td></tr>";
	?>
</table>
Tarifs par modèle: <br/>
<i>Il faudrait récupérer les join_modele_option: créer un model + controller</i>
