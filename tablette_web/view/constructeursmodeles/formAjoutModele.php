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
	<label for='identifiant'>Constructeur :</label><!--
	--><select name='constructeur_id' class='input'>
		<?php
			foreach($data['constructeurs'] as $constructeur){
				echo '<option value="'.$constructeur['id'].'">'.$constructeur['libelle'].'</option>';
			}
		?>
	</select>
	<label for='libelle'>Libelle :</label><!--
	--><input type='text' name='libelle' id='libelle' <?php if(isset($_POST['libelle'])){echo "value='".$_POST['libelle']."'";}?>/>
	<div class="form_boutons">
		<input type='submit' name='submit' value='Confirmer' id='submit'/><!--
		--><input type='submit' name='cancel' value='Annuler' id='cancel'/>
	</div>
</form>
