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
<table class='tableAffichage' action=''>
	<tr><th>Libelle</th><th>Description</th><th>Prix de base</th><th>Prix moyen pratiqué</th></tr>
	<?php
		echo"<tr><td>".$data['option']->libelle."</td><td>".$data['option']->desc."</td><td>".$data['option']->prixDeBase." €</td><td>".$data['moyenneTarif']." €</td></tr>";
	?>
</table>
Tarifs par modèle: <br/>
<form action='./?r=option/modifier<?php echo '&option='.$_GET['option']; ?>' method='post'>
	<?php
		foreach($data['joinModeleOption'] as $joinModeleOption){
			echo "\t<label for='".$joinModeleOption['id']."'>".$joinModeleOption['modele']->libelle."</label><input type='text' name='".$joinModeleOption['id']."' id='".$data['option']->id."'";
			if(!isset($_POST[$joinModeleOption['id']])){
				echo "value='".$joinModeleOption['prix']."'>€\n";
			}else{
				echo "value='".$_POST[$joinModeleOption['id']]."'>€\n";
			}
		}
	?>
	<div class="form_boutons">
		<input type='submit' name='submit' value='Confirmer' id='submit'/><!--
		--><input type='submit' name='cancel' value='Annuler' id='cancel'/>
	</div>
</form>
