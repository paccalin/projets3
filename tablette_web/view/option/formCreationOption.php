<a href='./?r=option/afficherGerer' class='lien'><img src='./images/back.png' alt='Retour' class="imageButton"></a>
<?php
	if(isset($data['erreursSaisie'])){
		echo "<p class='erreursSaisie'>Le formulaire comporte des erreurs:<br/>";
		foreach($data['erreursSaisie'] as $erreurSaisie){
			echo "-".$erreurSaisie."<br/>";
		}
		echo "</p>";
	}
?>

<form action='./?r=option/creer' method='post'>
	<label for='libelle'>Libelle :</label><!--
	--><input type='text' name='libelle' id='libelle' <?php if(isset($_POST['libelle'])){echo "value='".$_POST['libelle']."'";}?>/>
	<label for='description'>Description :</label><!--
	--><input type='text' name='description' id='description' <?php if(isset($_POST['description'])){echo "value='".$_POST['description']."'";}?>/>
	<label for='prixDeBase'>Prix de base :</label><!--
	--><input type='text' name='prixDeBase' id='prixDeBase' <?php if(isset($_POST['prixDeBase'])){echo "value='".$_POST['prixDeBase']."'";}?>/>

	<div class="form_boutons">
		<input type='submit' name='submit' value='Confirmer' id='submit'/><!--
		--><input type='submit' name='cancel' value='Annuler' id='cancel'/>
	</div>
</form>
