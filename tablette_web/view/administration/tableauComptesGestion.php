<table id="tableUsers">
	<tr><th>Pseudo</th><th>Droits</th><th>Modifier droits</th></tr>
	<?php
		foreach($data as $user){
			echo "<tr><td>".$user['pseudo']."</td>";
			echo "<td>".$user['droits']."</td>";
			echo "<td><div class='boutonTableUser'><a href=''>+</a></div>";
			echo "<div class='boutonTableUser'><a href=''>-</a></div></td>";
			/*
			foreach($modifs as $modif){
				echo "<td><div class='boutonTableUser'><a href='".$modif['lien']."'>".$modif['symbole']."</a></div></td>";
			}
			*/
		}
	?>
</table>
<p><i>Les boutons de modification des droits ne sont pas encore fonctionnels</i></p>
