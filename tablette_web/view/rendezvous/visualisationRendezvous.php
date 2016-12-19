<table class="tableAffichage">
	<tr><th>Libelle</th><th>Client</th><th>Date</th><th>Durée</th></tr>
	<?php
		foreach($data as $rdv){
			echo '<tr><td>'.$rdv['libelle'].'</td><td>'.$rdv['client'].'</td><td>'.$rdv['date'].'</td><td>'.$rdv['durée'].'</td></tr>';
		}
	?>
</table>
