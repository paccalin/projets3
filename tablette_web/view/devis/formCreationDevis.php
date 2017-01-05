<?php
	if(isset($data['erreurSaisies'])){
		echo "<p class='erreursSaisie'>Le formulaire comporte des erreurs:<br/>";
		foreach($data['erreurSaisies'] as $erreurSaisie){
			echo "-".$erreurSaisie."<br/>";
		}
		echo "</p>";
	}
?>


<form action='?r=devis/creer' method='post'>

	
		<select name='constructeurs' id='constructeurs'>
			<option value="null">-- defaut --</option>
			<?php
				foreach($data["Devis/creer"]['constructeurs'] as $constructeur){
					echo '<option value="'.$constructeur->id.'" class="'.$constructeur->libelle.'">'.$constructeur->libelle.'</option>';
				}
			?>
		</select>
		<select name='modeles' id='modeles'>
			<option value="null">-- defaut --</option>
			<?php
				foreach($data["Devis/creer"]['modeles'] as $modele){
					echo '<option value="'.$modele->id.'"  class="'.$modele->constructeur->libelle.'" display="none" style="display:none">'.$modele->libelle.'</option>';
				}
			?>
		</select>

		<label for='client'>client : </label>
		<input type='text' name='client' id='client'/>
		<input type='button' id='rechercher' name='rechercher' value='rechercher'/>
		
		<label for='options'>Options : </label>
		<div id='divOptions'>
			<span id='uneOption' class='spanOptions'>
				<select>
					<option value='null'>-- defaut --</option>
					<?php
						foreach($data["Devis/creer"]['options'] as $option){
						echo '<option value="'.$option->id.'">'.$option->libelle.'</option>';
					}
					?>
				</select>
			</span>
			<input type='button' value='ajouter' id='ajouter'/>
		</div>

	<div class="form_boutons">
		<input type='submit' name='submit' value='Créer' id='submit'/><!--
		--><input type='submit' name='cancel' value='Annuler' id='cancel'/>
	</div>

</form>


