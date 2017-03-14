<a href='./?r=constructeursModeles/afficherModele&modele=<?php echo $_GET['modele'];?>' class='lien'><img src='./images/back.png' alt='Retour' class="imageButton"></a>
<?php
	if(isset($data['erreursSaisie']) and $data['erreursSaisie']!=[]){
		echo "<p class='erreursSaisie'>Le formulaire comporte des erreurs:<br/>";
		foreach($data['erreursSaisie'] as $erreurSaisie){
			echo "-".$erreurSaisie."<br/>";
		}
		echo "</p>";
	}
?>
<form action='./?r=constructeursModeles/modifierModele<?php echo '&modele='.$_GET['modele']; ?>' method='post'>
	<label for='constructeur_id'>Constructeur :</label><!--
	--><select name='constructeur_id' class='input'>
		<option value="null">-- défaut --</option>
		<?php
			if(isset($_POST['constructeur_id'])){
				foreach($data['constructeurs'] as $constructeur){
					echo '<option value="'.$constructeur->id.'"';
					if($constructeur->id==$_POST['constructeur_id']){
						echo ' selected';
					}
					echo '>'.$constructeur->libelle.'</option>';
				}
			}else{
				foreach($data['constructeurs'] as $constructeur){
					echo '<option value="'.$constructeur->id.'"';
					if($constructeur->id==$data['modele']->constructeur->id){
						echo ' selected';
					}
					echo '>'.$constructeur->libelle.'</option>';
				}
			}
		?>
	</select><!--
	--><label for='libelle'>Nom du modèle :</label><!--
	--><input type='text' name='libelle' id='libelle' <?php if(isset($_POST['libelle'])){echo "value='".$_POST['libelle']."'";}else{echo "value='".$data['modele']->libelle."'";}?>/>
	<label for='typeModele_id'>Type du Modèle :</label><!--
	--><select name='typeModele_id' class='input'>
		<option value="null">-- défaut --</option>
		<?php
			if(isset($_POST['typeModele_id'])){
				foreach($data['typeModele'] as $typeModele){
					echo '<option value="'.$typeModele->id.'"';
					if($typeModele->id==$_POST['typeModele_id']){
						echo ' selected';
					}
					echo '>'.$typeModele->libelle.'</option>';
				}
			}else{
				foreach($data['typeModele'] as $typeModele){
					echo '<option value="'.$typeModele->id.'"';
					if($typeModele->id==$data['modele']->typeModele->id){
						echo ' selected';
					}
					echo '>'.$typeModele->libelle.'</option>';
				}
			}
		?>
	</select>
	<div class="form_boutons">
	<input type='submit' name='submit' value='Confirmer' id='submit'/><!--
	--><input type='submit' name='cancel' value='Annuler' id='cancel'/>
	</div> 
</form>
<br/>
<i>Le prix des options pour les modèles de ce type est modifiable dans la page de gestion des types de modèles <a href="" class="lien">ici</a></i>