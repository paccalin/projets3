<?php echo $data; ?>
<form action='./?r=administration/changerMotPasse' method='post'>
	<label for='mdp'>Nouveau mot de passe :</label><!--
	--><input type='password' name='motPasse' id='motPasse'/><!--
	--><label for='mdp'>Confirmer le mot de passe :</label><!--
	--><input type='password' name='motPasse2' id='motPasse2'/>
	<div class="form_boutons">
		<input type='submit' name='submit' value='Confirmer' id='submit'/><!--
		--><input type='submit' name='cancel' value='Annuler' id='cancel'/>
	</div>
</form>