<a href='./?r=constructeursModeles/afficher' class='lien'><img src='./images/back.png' alt='Retour' class="imageButton"></a>
<?php
	if(isset($data['erreursSaisie']) AND $data['erreursSaisie']!=[]){
		echo "<p class='erreursSaisie'>Le formulaire comporte des erreurs:<br/>";
		foreach($data['erreursSaisie'] as $erreurSaisie){
			echo "-".$erreurSaisie."<br/>";
		}
		echo "</p>";
	}
?>
<form action='./?r=constructeursModeles/modifierTypeModele&id=<?php if(isset($_GET['id'])){echo $_GET['id'];}else{}?>' method='post'>
	<label for='libelle'>Libelle :</label><!--
	--><input type='text' name='libelle' id='libelle' <?php if(isset($_POST['libelle'])){echo "value='".$_POST['libelle']."'";}else{echo "value='".$data['typeModele']->libelle."'";}?>/>
	<br/>
	Tarifs des différentes options pour ce type de véhicule:<br/>
	<?php
		foreach($data['joinTypeModeleOption'] as $joinTypeModeleOption){
			echo "\t<label for='opt".$joinTypeModeleOption['id']."'>".$joinTypeModeleOption['option']->libelle."</label><input type='text' name='opt".$joinTypeModeleOption['id']."' id='opt".$data['typeModele']->id."'";
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
