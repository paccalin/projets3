<a href='./?r=devis/afficherTous' class='lien'>Retour aux devis</a>
<?php
	if(isset($data['erreursSaisie']) and $data['erreursSaisie']!=[]){
		echo "<p class='erreursSaisie'>Le formulaire comporte des erreurs:<br/>";
		foreach($data['erreursSaisie'] as $erreurSaisie){
			echo "-".$erreurSaisie."<br/>";
		}
		echo "</p>";
	}
?>


<form action='?r=devis/creer' method='post'>
		<label for='constructeur'>Constructeur :</label><!--
		--><select name='constructeur' id='constructeur' class='input'>
			<option value="null">-- Sélectionner --</option>
			<?php
				foreach($data['constructeurs'] as $constructeur){
					echo '<option value="'.$constructeur->id.'" class="'.$constructeur->libelle.'">'.$constructeur->libelle.'</option>';
				}
			?>
		</select><!--
		--><label for='modele'>Modèle :</label><!--
		--><select name='modele' id='modele' class='input'>
			<option value="null">-- Sélectionner --</option>
			<?php
				foreach($data['modeles'] as $modele){
					echo '<option value="'.$modele->id.'"  class="'.$modele->constructeur->libelle.'" display="none" style="display:none">'.$modele->libelle.'</option>';
				}
			?>
		</select><!--
		--><label for='client'>Client : </label><!--
		--><select name='client' id='client' class='input'>
			<option value='null'>-- Sélectionner --</option>
			<?php
				foreach($data['clients'] as $client){
					echo '<option value="'.$client->id.'">'.$client->nom.' '.$client->prenom.'</option>';
				}
			?>
		</select><!--
		--><input type='text' id='clientFiltrer' class='input'/><!--
		--><input type='button' id='filtrer' name='filtrer' value='Filtrer'/>
		
		
		
		<!--
		--><label for='option1' id='labelOption'>Options : </label><!--
		--><select id='option1' name='option1' class='input'>
			<option value='null'>-- Sélectionner --</option>
			<?php
				foreach($data['options'] as $option){
				echo '<option value="'.$option->id.'">'.$option->libelle.'</option>';
			}
			?>
		</select><!--
		--><span class='inputSpacer'></span><!--
		--><input type='button' value='ajouter' id='ajouter'/>
		</div>

	<div class="form_boutons">
		<input type='submit' name='submit' value='Créer' id='submit'/><!--
		--><input type='submit' name='cancel' value='Annuler' id='cancel'/>
	</div>

</form>
<br/>
<script type='text/javascript' src='./js/createDevis.js'></script>
