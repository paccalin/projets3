<a href='./?r=option/visualiser<?php echo '&option='.$_GET['option'];?>' class='lien'><img src='./images/back.png' alt='Retour' class="imageButton"></a>
<?php
	if(isset($data['erreursSaisie'])){
		echo "<p class='erreursSaisie'>Il y a des erreurs de saisie:<br/>";
		foreach($data['erreursSaisie'] as $erreurSaisie){
			echo "-".$erreurSaisie."<br/>";
		}
		echo "</p>";
	}
?>
<form action='./?r=option/modifier<?php echo '&option='.$_GET['option'].'&retour='.$_GET['retour']; ?>' method='post'>
	<label for='libelle'>Libelle</label><!--	
	<?php
		echo '--><input type="text" id="libelle" name="libelle"';
		if(isset($_POST['libelle'])){
			echo 'value="'.$_POST['libelle'].'"';
		}elseif(isset($data['option'])){
			echo 'value="'.$data['option']->libelle.'"';
		}
		echo "><!--\n";
	?>
	--><label for='type'>Type d'option</label><!--
	--><select name='typeOption_id' class='input'>
			<option value="null">-- défaut --</option>
		<?php
			foreach($data['typeOption'] as $typeOption){
				echo '<option value="'.$typeOption->id.'"';
				if(isset($_POST['typeOption_id']) and $_POST['typeOption_id']==$typeOption->id){
					echo ' selected';
				}elseif($typeOption->id==$data['option']->typeOption->id){
					echo ' selected';
				}
				echo '>'.$typeOption->libelle.'</option>';
				
			}
		?>
	</select><!--
	--><label for='description'>Description</label><!--
	<?php
		echo '--><input type="text" id="description" name="description"';
		if(isset($_POST['description'])){
			echo 'value="'.$_POST['description'].'"';
		}elseif(isset($data['option'])){
			echo 'value="'.$data['option']->desc.'"';
		}
		echo "><!--\n";
	?>
	--><label for='prixDeBase'>Prix de base</label><!--
	<?php
		echo "--><input type='text' id='prixDeBase' name='prixDeBase'";
		if(isset($_POST['prixDeBase'])){
			echo "value='".$_POST['prixDeBase']."'";
		}elseif(isset($data['option'])){
			echo "value='".$data['option']->prixDeBase."'";
		}
		echo ">";
	?><br/>
Tarifs par catégorie de véhicules:<br/>
	<?php
		foreach($data['joinTypeModeleOption'] as $joinTypeModeleOption){
			echo "\t<label for='opt".$joinTypeModeleOption['id']."'>".$joinTypeModeleOption['typeModele']->libelle."</label><input type='text' name='opt".$joinTypeModeleOption['id']."' id='opt".$data['option']->id."'";
			if(!isset($_POST['opt'.$joinTypeModeleOption['id']])){
				echo "value='".$joinTypeModeleOption['prix']."'>€\n";
			}else{
				echo "value='".$_POST['opt'.$joinTypeModeleOption['id']]."'>€\n";
			}
		}
	?>
	<div class="form_boutons">
		<input type='submit' name='submit' value='Confirmer' id='submit'/><!--
		--><input type='submit' name='cancel' value='Annuler' id='cancel'/>
	</div>
</form>
