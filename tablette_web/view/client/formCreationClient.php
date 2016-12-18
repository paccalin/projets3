<?php if(isset($data['erreurSaisies'])){echo "<p class='erreursSaisie'>".$data['erreurSaisies']."</p>";} ?>

<form action='./?r=client/creer' method='post'>

	<label for='nom'>Nom :</label><!--
	--><input type='text' name='nom' id='nom' <?php if(isset($_POST['nom'])){echo "value='".$_POST['nom']."'";} ?> /><!--
	--><label for='prenom'>Prénom :</label><!--
	--><input type='text' name='prenom' id='prenom' <?php if(isset($_POST['prenom'])){echo "value='".$_POST['prenom']."'";} ?> /><!--
	--><label for='rue'>Rue :</label><!--
	--><input type='text' name='rue' id='rue' <?php if(isset($_POST['rue'])){echo "value='".$_POST['rue']."'";} ?> /><!--
	--><label for='ville'>Ville :</label><!--
	--><input type='text' name='ville' id='ville' <?php if(isset($_POST['ville'])){echo "value='".$_POST['ville']."'";} ?> /><!--
	--><label for='rue'>CP :</label><!--
	--><input type='text' name='cp' id='cp' <?php if(isset($_POST['cp'])){echo "value='".$_POST['cp']."'";} ?> /><!--
	--><label for='prenom'>Mail :</label><!--
	--><input type='text' name='mail' id='mail' <?php if(isset($_POST['mail'])){echo "value='".$_POST['mail']."'";} ?> /><!--
	--><label for='rue'>Téléphone :</label><!--
	--><input type='text' name='telephone' id='telephone' <?php if(isset($_POST['telephone'])){echo "value='".$_POST['telephone']."'";} ?> />
		
	<div class="form_boutons">
		<input type='submit' name='submit' value='Confirmer' id='submit'/><!--
		--><input type='submit' name='cancel' value='Annuler' id='cancel'/>
	</div>

</form>
