<a href='./?r=administration/creerCompte' class=''><img src="./images/plus.jpg" class="imageButton ajout" alt="Ajouter compte"></a>
<table class="tableAffichage">
	<tr><th>Pseudo</th><th>Droits</th><th>Modifier droits</th><th>Supprimer</th><th>Modifier mot de passe</th></tr>
	<?php
		foreach($data as $user){
			echo "<tr><td>".$user['pseudo']."</td>";
			echo "<td>".$user['droitsNom']."</td>";
			if($user['droitsNb']<3){
				if($user['droitsNb']==2){
					echo "<td><a href='./?r=administration/confirmeAugmenteDroit&pseudo=".$user['pseudo']."&id=".$user['id']."'><div class='boutonTableUser'>+</div></a>";
				}else{
					echo "<td><a href='./?r=administration/augmenteDroits&id=".$user['id']."'><div class='boutonTableUser'>+</div></a>";
				}
			}else{
				echo "<td><div class='boutonTableUser boutonTableUserDesactive'>+</div>";
			}
			if($user['droitsNb']==2){
				echo "<a href='./?r=administration/reduitDroits&id=".$user['id']."'><div class='boutonTableUser'>-</div></a></td>";
			}else{
				echo "<div class='boutonTableUser boutonTableUserDesactive'>-</div></td>";
			}
			if($user['droitsNb']<3){
				echo "<td><a href='./?r=administration/confirmeSupression&pseudo=".$user['pseudo']."&id=".$user['id']."'><div class='boutonTableUser'>X</div></a>";
				echo "<td><a href='./?r=administration/changerMotPasse&pseudo=".$user['pseudo']."'><div class='boutonTableUser'>...</div></a>";
			}else{
				echo "<td><div class='boutonTableUser boutonTableUserDesactive'>X</div>";
				echo "<td><div class='boutonTableUser boutonTableUserDesactive'>...</div>";	
			}
		}
	?>
</table>
