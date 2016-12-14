<table id="tableUsers">
	<tr><th>Pseudo</th><th>Droits</th></tr>
	<?php
		foreach($data as $user){
			echo "<tr><td>".$user['pseudo']."</td><td>".$user['droitsNom']."</td></tr>";
		}
	?>
</table>
