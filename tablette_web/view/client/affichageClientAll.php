<table class="tableAffichage">
	<tr><th>Nom</th><th>Prénom</th><th>Adresse</th><th>Ville</th><th>Mail</th><th>Téléphone</th></tr>
	<?php
		foreach($data as $client){
			echo "<tr><td><a href='./?r=client/afficherParId&id=".$client['id']."'>".$client['nom']."</a></td><td><a href='./?r=client/afficherParId&id=".$client['id']."'>".$client['prenom']."</a></td><td><a href='./?r=client/afficherParId&id=".$client['id']."'>".$client['adresse']."</a></td><td><a href='./?r=client/afficherParId&id=".$client['id']."'>".$client['ville']."</a></td><td><a href='./?r=client/afficherParId&id=".$client['id']."'>".$client['mail']."</a></td><td><a href='./?r=client/afficherParId&id=".$client['id']."'>".$client['tel']."</a></td></tr>";
		}
	?>
</table>