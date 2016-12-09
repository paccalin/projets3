<form action='{a definir}' method='post'>

	<label for='path'>Chemin de l'image : </label><input type='text' name='path' id='path' disabled>
	<input type='button' name='browse' value='parcourir ...' id='browse'/> 

	<?php
		/*
		$data = {methode de récupération de TOUTES les vehicules};

		echo '<select><option>--- saisir ---</option>';

		foreach($data as $id=>$vehicule){
			echo "<option value='".$id."'>".$vehicule."</option>";
		}

		echo '</select>';

		*/
	?>

	<input type='submit' name='cancel' value='annuler' id='cancel'/>
	<input type='submit' name='submit' value='créer' id='submit'/>

</form>