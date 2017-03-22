<a href='./?r=connexion/visualiser' class='lien' title='Retour'><img src='./images/back.png' alt='Retour aux clients' class="imageButton"></a>
<?php
	if(isset($data['erreurSaisie'])){
		echo "<p class='erreursSaisie'>Il y a des erreurs de saisie:<br/>";
		foreach($data['erreurSaisie'] as $erreurSaisie){
			echo "-".$erreurSaisie."<br/>";
		}
		echo "</p>";
	}
?>
<form action='./?r=connexion/changerMotPasse<?php if(isset($_GET['pseudo'])){echo "&pseudo=".$_GET['pseudo'];}?>' method='post'>
	<label for='motPasseAct'>Mot de passe actuel :</label><!--
	--><input type='password' name='motPasseAct' id='motPasseAct'/><!--
	--><label for='motPasse1'>Nouveau mot de passe :</label><!--
	--><input type='password' name='motPasse1' id='motPasse1'/><!--
	--><label for='motPasse2'>Confirmer le mot de passe :</label><!--
	--><input type='password' name='motPasse2' id='motPasse2'/>
	<div class="form_boutons">
		<input type='submit' name='submit' value='Confirmer' id='submit'/><!--
		--><input type='submit' name='cancel' value='Annuler' id='cancel'/>
	</div>
</form>