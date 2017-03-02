<a href='./?r=option/afficherTous' class='lien'><img src='./images/back.png' alt='Retour' class="imageButton"></a>
<?php
	if(isset($data['erreursSaisie'])){
		echo "<p class='erreursSaisie'>Le formulaire comporte des erreurs:<br/>";
		foreach($data['erreursSaisie'] as $erreurSaisie){
			echo "-".$erreurSaisie."<br/>";
		}
		echo "</p>";
	}
?>

<form action="./?r=option/creer<?php echo '&retour='.$_GET['retour'];?>" method="post">
	<label for="libelle">Libelle : <span class="requis">*</span></label><!--
	--><input type='text' name='libelle' id='libelle' <?php if(isset($_POST['libelle'])){echo 'value="'.$_POST['libelle'].'"';}?>/><!--
	--><label for="typeOption_id">Type : <span class="requis">*</span></label><!--
	--><select name="typeOption_id" class='input'>
			<option value="null">-- défaut --</option>
		<?php
			foreach($data['typeOption'] as $typeOption){
				echo '<option value="'.$typeOption->id.'"';
				if(isset($_POST['typeOption_id']) and $_POST['typeOption_id']==$typeOption->id){
					echo ' selected';
				}
				echo '>'.$typeOption->libelle.'</option>';
				
			}
		?>
	</select>
	<label for="description">Description :</label><!--
	--><input type="text" name="description" id="description" <?php if(isset($_POST['description'])){echo 'value="'.$_POST['description'].'"';}?>/>
	<label for="prixDeBase">Prix de base : <span class="requis">*</span></label><!--
	--><input type="text" name="prixDeBase" id="prixDeBase" <?php if(isset($_POST['prixDeBase'])){echo 'value="'.$_POST['prixDeBase'].'"';}?>/>

	<div class="form_boutons">
		<input type='submit' name='submit' value='Confirmer' id='submit'/><!--
		--><input type='submit' name='cancel' value='Annuler' id='cancel'/>
	</div>
</form>
<span class='requis'>*Champ requis</span>
