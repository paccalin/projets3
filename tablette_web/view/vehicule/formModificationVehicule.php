<a href='./?r=vehicule/visualiser&id=<?php echo $_GET['id'];?>' class='lien'><img src='./images/back.png' alt='Retour' class="imageButton"></a>
<?php
	if(isset($data['erreursSaisie'])){
		echo "<p class='erreursSaisie'>Il y a des erreurs de saisie:<br/>";
		foreach($data['erreursSaisie'] as $erreurSaisie){
			echo "-".$erreurSaisie."<br/>";
		}
		echo "</p>";
	}
?>
<form action='./?r=vehicule/modifier&id=<?php echo $_GET['id'];?>' method='post'>
	<label for='modele_id'>Modèle : <span class='requis'>*</span></label><!--
	--><select name='modele_id' class='input'>
			<option value="null">-- défaut --</option>
			<?php
				if(isset($_POST['modele_id'])){
					foreach($data['modeles'] as $modele){
						echo '<option value="'.$modele->id.'"';
						if($modele->id==$_POST['modele_id']){
							echo ' selected';
						}
						echo '>'.$modele->libelle.'</option>';
					}
				}else{
					foreach($data['modeles'] as $modele){
						echo '<option value="'.$modele->id.'"';
						if($modele->id==$data['vehicule']->modele->id){
							echo ' selected';
						}
						echo '>'.$modele->libelle.'</option>';
					}
				}
				
			?>
	</select><!--
	--><label for='client_id'>Client : <span class='requis'>*</span></label><!--
	--><select name='client_id' class='input'>
			<option value="null">-- défaut --</option>
		<?php
			if(isset($_POST['client_id'])){
				foreach($data['clients'] as $client){
					echo '<option value="'.$client->id.'"';
					if($client->id==$_POST['client_id']){
						echo ' selected';
					}
					echo '>'.$client->nom.' '.$client->prenom.'</option>';
				}
			}else{
				foreach($data['clients'] as $client){
					echo '<option value="'.$client->id.'"';
					if($client->id==$data['vehicule']->client->id){
						echo ' selected';
					}
					echo '>'.$client->nom.' '.$client->prenom.'</option>';
				}
			}
			
		?>
	</select><!--
	--><label for='immat'>Immatriculation : <span class='requis'>*</span></label><!--
	--><input type='text' name='immat' id='immat' <?php if(isset($_POST['immat'])){echo "value='".$_POST['immat']."'";}else{echo "value='".$data['vehicule']->immatriculation."'";} ?> />
	<div class="form_boutons">
		<input type='submit' name='submit' value='Confirmer' id='submit'/><!--
		--><input type='submit' name='cancel' value='Annuler' id='cancel'/>
	</div>
</form>
<span class='requis'>*</span>Champ requis