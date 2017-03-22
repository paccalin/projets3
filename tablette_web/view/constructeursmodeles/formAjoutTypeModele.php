<a href='./?r=<?php echo $data['retour'];?>' class='lien'><img src='./images/back.png' alt='Retour aux clients' class="imageButton"></a>
<?php
	if(isset($data['erreursSaisie'])){
		echo "<p class='erreursSaisie'>Il y a des erreurs de saisie:<br/>";
		foreach($data['erreursSaisie'] as $erreurSaisie){
			echo "-".$erreurSaisie."<br/>";
		}
		echo "</p>";
	}
?>
<form action='./?r=constructeursModeles/ajouter&ajout=typeModele' method='post'><label for='libelle'>Libelle : <span class='requis'>*</span></label><!--
	--><input type='text' name='libelle' id='libelle' <?php if(isset($_POST['libelle'])){echo "value='".$_POST['libelle']."'";} ?> />
	<div class="form_boutons">
		<input type='submit' name='submit' value='Confirmer' id='submit'/><!--
		--><input type='submit' name='cancel' value='Annuler' id='cancel'/>
	</div>

</form>
<p class='requis'>*Champ requis</p>
<p><i>Les types de modèles sont utilisés pour déterminer des classes différentes de coût pour les installations d'options</i></p>
