<?php
	if(isset($data['erreurSaisies'])){
		echo "<p class='erreursSaisie'>Le formulaire comporte des erreurs:<br/>";
		foreach($data['erreurSaisies'] as $erreurSaisie){
			echo "-".$erreurSaisie."<br/>";
		}
		echo "</p>";
	}
?>

<form action='?r=rendezvous/creer' method='post'>

	<label for='libelle'>Libelle : </label><!--
	--><input type='text' name='libelle' id='libelle'/><!--
	--><label for='idClient'>Client : </label><!--
	--><input type='text' name='idClient' id='idClient'/><!--
	--><label for='date'>Date : </label><!--
	--><input type='date' name='date' id='date'/><!--
	--><label for='heure'>Heure : </label><!--
	--><input type='time' name='heure' id='heure'/><!--
	--><label for='duree'>Durée : </label><!--
	--><input type='text' name='duree' id='duree'/>
	
	<div class="form_boutons">
		<input type='submit' name='submit' value='Créer' id='submit'/><!--
		--><input type='submit' name='cancel' value='Annuler' id='cancel'/>
	</div>

</form>
