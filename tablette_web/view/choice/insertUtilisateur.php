<form action ='{a definir}' method='post'>

	<label>Pseudo : </label><input type='text' name='pseudo' id='pseudo'/>
	<label>Mot de passe : </label><input type='password' name='password' id='password'/>
	<label>Vérification mot de passe : </label><input type='password' name='passwordCheck' id='passwordCheck'/>


	<?php
		$droits = array("user"=>"utilisateur", "administrateur"=>"administrateur", "superadmin"=>"superadministrateur");

		echo '<select>';

		foreach($droits as $key=>$value){
			echo "<option value='".$key."'>".$value."</option>";
		}


	?>

	<input type='submit' name='cancel' value='annuler' id='cancel'/>
	<input type='submit' name='submit' value='créer' id='submit'/>

</form>