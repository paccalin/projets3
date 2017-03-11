<a href='./?r=administration/creerCompte' class=''><img src="./images/plus.png" class="imageButton ajout" alt="Ajouter compte"></a>
<table class="tableAffichage">
	<tr><th>Pseudo</th><th>Droits</th><th>Modifier droits</th><th>Supprimer</th><th>Modifier mot de passe</th></tr>
	<?php
		foreach($data as $user){
			echo "<tr><td>".$user['pseudo']."</td>";
			echo "<td>".$user['droitsNom']."</td>";
			if($user['droitsNb']<3){
				if($user['droitsNb']==2){
					echo "<td><a href='./?r=administration/confirmeAugmenteDroit&pseudo=".$user['pseudo']."&id=".$user['id']."'><img src='./images/plus.png' class='petitBouton vert'></a>";
				}else{
					echo "<td><a href='./?r=administration/augmenteDroits&id=".$user['id']."'><img src='./images/plus.png' class='petitBouton vert'></a>";
				}
			}else{
				echo "<td><img src='./images/plus.png' class='petitBouton gris'>";
			}
			if($user['droitsNb']==2){
				echo "<a href='./?r=administration/reduitDroits&id=".$user['id']."'><img src='./images/moins.png' class='petitBouton rouge'></a></td>";
			}else{
				echo "<img src='./images/moins.png' class='petitBouton gris'></td>";
			}
			if($user['droitsNb']<3){
				echo "<td><a href='./?r=administration/confirmeSupression&pseudo=".$user['pseudo']."&id=".$user['id']."'><img src='./images/delete.png' class='petitBouton rouge'></a>";
				echo "<td><a href='./?r=administration/changerMotPasse&pseudo=".$user['pseudo']."'><img src='./images/crayon.png' class='petitBouton'></a>";
			}else{
				echo "<td><img src='./images/delete.png' class='petitBouton gris'></div>";
				echo "<td><img src='./images/crayon.png' class='petitBouton gris'></div>";	
			}
		}
	?>
</table>
