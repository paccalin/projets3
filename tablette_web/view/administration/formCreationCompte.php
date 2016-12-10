<form action='./?r=administration/verifieCreationCompte' method='post'>

	<label for='identifiant'>Identifiant :</label><!--
	--><input type='text' name='identifiant' id='identifiant'/><!--
	--><label for='mdp'>Mot de passe :</label><!--
	--><input type='password' name='motPasse' id='motPasse'/><!--
	--><label for='mdp'>Confirmer le mot de passe :</label><!--
	--><input type='password' name='motPasse2' id='motPasse2'/><!--
	--><label for='droits'>Droits :</label><!--
	--><select id='droits' class="input">
		<?php
			if($_SESSION['droits']>=2){
				echo '<option value="0">Utilisateur</option>';
			}
			if($_SESSION['droits']>=3){
				echo '<option value="1">Administrateur</option>
		<option value="2">Super admintrateur</option>';
			}
		?>
		
		
	</select>
		
	<div class="form_boutons">
		<input type='submit' name='submit' value='Confirmer' id='submit'/><!--
		--><input type='submit' name='cancel' value='Annuler' id='cancel'/>
	</div>

</form>
