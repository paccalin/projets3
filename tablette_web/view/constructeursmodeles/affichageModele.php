<a href='./?r=constructeursModeles/afficher' class='lien'>Retour aux Constructeurs</a>
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
	<tr><th>Constructeur</th><th>Mod&egrave;le</th></tr>
	<?php
		echo '<tr><td>'.$data['constructeur']->libelle.'</td><td>'.$data['modele']->libelle.'</td></tr>';
	?>
</table>
<br/>
Prix des options pour ce mod&egrave;le:
<form action='./?r=constructeursModeles/afficherModifierModele<?php echo '&modele='.$_GET['modele']; ?>' method='post'>
	<?php
		foreach($data['joinModeleOption'] as $joinModeleOption){
			echo "\t<label for='".$joinModeleOption['id']."'>".$joinModeleOption['option']->libelle."</label><input type='text' name='".$joinModeleOption['id']."' id='".$joinModeleOption['option']->id."' value='".$joinModeleOption['prix']."'>€\n";
		}
	?>
	<div class="form_boutons">
		<input type='submit' name='submit' value='Confirmer' id='submit'/><!--
		--><input type='submit' name='cancel' value='Annuler' id='cancel'/>
	</div> 
</form>