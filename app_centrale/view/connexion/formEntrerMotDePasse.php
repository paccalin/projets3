<a href='./?r=site/index' class='lien'><img src='./images/back.png' alt='Retour aux clients' class="imageButton"></a>
<?php
	if(isset($data['erreursSaisie'])){
		echo "<p class='erreursSaisie'>Il y a des erreurs de saisie:<br/>";
		foreach($data['erreursSaisie'] as $erreurSaisie){
			echo "-".$erreurSaisie."<br/>";
		}
		echo "</p>";
	}
?><form action='./?r=connexion/swichUtilisateurClient' method='post'>
	<label for='mdp'>Mot de passe :</label><!--
	--><input type='password' name='motPasse' id='motPasse'/>
	
	<div class="form_boutons">
		<input type='submit' name='submit' value='Confirmer' id='submit'/><!--
		--><input type='submit' name='cancel' value='Annuler' id='cancel'/>
	</div>

</form>
