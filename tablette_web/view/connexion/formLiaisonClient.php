<form action='./?r=connexion/ajouterClient' method='post'>

	<label for='client'>Client : </label><!--
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
	
	<div class="form_boutons">
		<input type='submit' name='submit' value='Lier client' id='submit'/><!--
		--><input type='submit' name='cancel' value='Annuler' id='cancel'/>
	</div>
	
</form>
<script type='text/javascript' src='./js/createDevis.js'></script>