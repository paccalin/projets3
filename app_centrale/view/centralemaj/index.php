<p>Application centrale: gestion des mises à jour<p>
<br/>
<p>Appareils liés à l'application:</p>
<table class='tableAffichage'>
	<tr><th>Nom</th><th>Dernier envoi de données</th><th>Statut</th></tr>
	<?php
		foreach($data['tablettes'] as $tablette){
			echo "<tr><td><a href='.?r=centraleMaj/afficherTablette&id=".$tablette->id."' class='lien'><img src='./images/plus.png' class='petitBouton'>".$tablette->nom."</td><td>".timestampFormat($tablette->lastConnect)."</td><td></td></tr>";
		}
	?>
</table>
