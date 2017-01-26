<table class="tableAffichage">
	<tr><th>Libelle</th><th>Client</th><th>Date</th><th>Durée</th></tr>
	<?php
		foreach($data as $rdv){
			echo '<tr><td>'.$rdv['libelle'].'</td><td>'.$rdv['client'].'</td><td>'.$rdv['date'].'</td><td>'.$rdv['durée'].'</td></tr>';
		}
	?>
</table>
<a href='.?r=rendezvous/creer' class='lien'><img src="./images/plus.jpg" class="imageButton" class="ajout" alt="Ajouter client"></a>
<a href='.?r=rendezvous/rechercher' class='lien'><img src="./images/loupe.png" class="imageButton" class="recherche" alt="Rechercher client"></a>