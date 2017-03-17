<a href='./?r=<?php echo $data['retour'];?>' class='lien'><img src='./images/back.png' alt='Retour' class="imageButton"></a>
<?php
	if(isset($data['erreursSaisie'])){
		echo "<p class='erreursSaisie'>Le formulaire comporte des erreurs:<br/>";
		foreach($data['erreursSaisie'] as $erreurSaisie){
			echo "-".$erreurSaisie."<br/>";
		}
		echo "</p>";
	}
?>
<form action='./?r=constructeursModeles/ajouter&ajout=modele' method='post'>
	<label for='constructeur_id'>Constructeur :</label><!--
	--><select name='constructeur_id' class='input'>
			<option value="null">-- défaut --</option>
		<?php
			foreach($data['constructeurs'] as $constructeur){
				echo '<option value="'.$constructeur->id.'"';
				if(isset($_POST['constructeur_id']) and $_POST['constructeur_id']==$constructeur->id){
					echo ' selected';
				}
				echo '>'.$constructeur->libelle.'</option>';
				
			}
		?>
	</select><!--
	--><label for='libelle'>Libelle :</label><!--
	--><input type='text' name='libelle' id='libelle' <?php if(isset($_POST['libelle'])){echo "value='".$_POST['libelle']."'";}?>/>
	<label for='typeModele_id'>Catégorie :</label><!--
	--><select name='typeModele_id' class='input'>
			<option value="null">-- défaut --</option>
		<?php
			foreach($data['typeModele'] as $typeModele){
				echo '<option value="'.$typeModele->id.'"';
				if(isset($_POST['typeModele_id']) and $_POST['typeModele_id']==$typeModele->id){
					echo ' selected';
				}
				echo '>'.$typeModele->libelle.'</option>';
				
			}
		?>
	</select>
	<div class="form_boutons">
		<input type='submit' name='submit' value='Confirmer' id='submit'/><!--
		--><input type='submit' name='cancel' value='Annuler' id='cancel'/>
	</div>
</form>
