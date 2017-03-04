<p>Application centrale: gestion des mises à jour<p>
<br/>
<p>Appareils liés à l'application:</p>
<table class='tableAffichage'>
	<tr><th>Nom</th><th>Dernier envoi de données</th><th>Adresse IP</th><th>Statut</th></tr>
	<?php
		foreach($data['tablettes'] as $tablette){
			echo "<tr><td>".$tablette->nom."</td><td>".timestampFormat($tablette->lastConnect)."</td><td>".$tablette->ip."</td><td></td></tr>";
		}
	?>
</table>
