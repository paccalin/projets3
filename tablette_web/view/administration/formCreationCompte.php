<a href='./?r=<?php echo $data['retour'];?>' class='lien'><img src='./images/back.png' alt='Retour aux clients' class="imageButton"></a>
<?php
	if(isset($data['erreurSaisies'])){
		echo "<p class='erreursSaisie'>Le formulaire comporte des erreurs:<br/>";
		foreach($data['erreurSaisies'] as $erreurSaisie){
			echo "-".$erreurSaisie."<br/>";
		}
		echo "</p>";
	}
?>

<form action='./?r=administration/verifieCreationCompte' method='post'>

	<label for='identifiant'>Identifiant :</label><!--
	--><input type='text' name='identifiant' id='identifiant' <?php if(isset($_POST['identifiant'])){echo "value='".$_POST['identifiant']."'";}?>/><!--
	--><label for='mdp'>Mot de passe :</label><!--
	--><input type='password' name='motPasse' id='motPasse' <?php if(isset($_POST['motPasse'])){echo "value='".$_POST['motPasse']."'";}?>/><!--
	--><label for='mdp'>Confirmer le mot de passe :</label><!--
	--><input type='password' name='motPasse2' id='motPasse2' /><!--
	--><label for='droits'>Droits :</label><!--
	--><select name='droits' id='droits' class="input">
		<?php
			if($_SESSION['droits']>=2){
				echo '<option value="1">Utilisateur</option>';
			}
			if($_SESSION['droits']>=3){
				echo '<option value="2">Administrateur</option>
		<option value="3">Super admintrateur</option>';
			}
		?>
		
		
	</select>
		
	<div class="form_boutons">
		<input type='submit' name='submit' value='Confirmer' id='submit'/><!--
		--><input type='submit' name='cancel' value='Annuler' id='cancel'/>
	</div>

</form>
