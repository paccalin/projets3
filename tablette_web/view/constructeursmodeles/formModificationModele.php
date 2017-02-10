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
<table class="tableAffichage">
	<tr><th>Constructeur</th><th>Mod&egrave;le</th><th>Catégorie</th></tr>
	<?php
		echo '<tr><td>'.$data['modele']->constructeur->libelle.'</td><td>'.$data['modele']->libelle.'</td><td>'.$data['modele']->typeModele->libelle.'</td></tr>';
	?>
</table>
<br/>
Prix des options pour ce mod&egrave;le:
<form action='./?r=constructeursModeles/modifierModele<?php echo '&modele='.$_GET['modele']; ?>' method='post'>
	<?php
		foreach($data['joinTypeModeleOption'] as $joinTypeModeleOption){
			echo "\t<label for='".$joinTypeModeleOption['id']."'>".$joinTypeModeleOption['option']->libelle."</label><input type='text' name='".$joinTypeModeleOption['id']."' id='".$joinTypeModeleOption['option']->id."' value='".$joinTypeModeleOption['prix']."'> €\n";
		}
	?>
	<div class="form_boutons">
		<input type='submit' name='submit' value='Confirmer' id='submit'/><!--
		--><input type='submit' name='cancel' value='Annuler' id='cancel'/>
	</div> 
</form>
