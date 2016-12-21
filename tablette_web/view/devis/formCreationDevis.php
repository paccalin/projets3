<?php
	if(isset($data['erreurSaisies'])){
		echo "<p class='erreursSaisie'>Le formulaire comporte des erreurs:<br/>";
		foreach($data['erreurSaisies'] as $erreurSaisie){
			echo "-".$erreurSaisie."<br/>";
		}
		echo "</p>";
	}
?>

a faire: formCreationDevis.php
<form action='?r=devis/creer' method='post'>

	<div class="form_boutons">
		<input type='submit' name='submit' value='Créer' id='submit'/><!--
		--><input type='submit' name='cancel' value='Annuler' id='cancel'/>
	</div>

</form>
