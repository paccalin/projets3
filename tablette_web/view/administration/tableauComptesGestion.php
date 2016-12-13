<table id="tableUsers">
	<tr><th>Pseudo</th><th>Droits</th><th>Modifier droits</th></tr>
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
		}
	?>
</table>
<p><i>Les boutons de modification des droits ne sont pas encore fonctionnels</i></p>
