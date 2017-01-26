<a href='./?r=client/afficherParId&id=<?php echo $_GET['id'];?>' class='lien'><img src='./images/back.png' alt='Retour aux clients' class="imageButton"></a><?php
	if(isset($data['erreursSaisie'])){
		echo "<p class='erreursSaisie'>Il y a des erreurs de saisie:<br/>";
		foreach($data['erreursSaisie'] as $erreurSaisie){
			echo "-".$erreurSaisie."<br/>";
		}
		echo "</p>";
	}
?>
<form action='./?r=client/modifier&id=<?php echo $_GET['id']?>' method='post'>

	<label for='nom'>Nom :</label><!--
	--><input type='text' name='nom' id='nom' <?php if(isset($_POST['nom'])){echo "value='".$_POST['nom']."'";}else{echo "value='".$data['nom']."'";} ?> /><!--
	--><label for='prenom'>Prénom :</label><!--
	--><input type='text' name='prenom' id='prenom' <?php if(isset($_POST['prenom'])){echo "value='".$_POST['prenom']."'";}else{echo "value='".$data['prenom']."'";} ?> /><!--
	--><label for='rue'>Rue :</label><!--
	--><input type='text' name='rue' id='rue' <?php if(isset($_POST['rue'])){echo "value='".$_POST['rue']."'";}else{echo "value='".$data['rue']."'";} ?> /><!--
	--><label for='ville'>Ville :</label><!--
	--><input type='text' name='ville' id='ville' <?php if(isset($_POST['ville'])){echo "value='".$_POST['ville']."'";}else{echo "value='".$data['ville']."'";} ?> /><!--
	--><label for='cp'>CP :</label><!--
	--><input type='text' name='cp' id='cp' <?php if(isset($_POST['cp'])){echo "value='".$_POST['cp']."'";}else{echo "value='".$data['cp']."'";} ?> /><!--
	--><label for='mail'>Mail :</label><!--
	--><input type='text' name='mail' id='mail' <?php if(isset($_POST['mail'])){echo "value='".$_POST['mail']."'";}else{echo "value='".$data['mail']."'";} ?> /><!--
	--><label for='tel'>Téléphone :</label><!--
	--><input type='text' name='tel' id='tel' <?php if(isset($_POST['tel'])){echo "value='".$_POST['tel']."'";}else{echo "value='".$data['tel']."'";} ?> />
		
	<div class="form_boutons">
		<input type='submit' name='submit' value='Confirmer' id='submit'/><!--
		--><input type='submit' name='cancel' value='Annuler' id='cancel'/>
	</div>

</form>
