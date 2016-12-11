<form action ='?r=site/aFaire' method='post'>

	<label>Pseudo : </label><input type='text' name='pseudo' id='pseudo'/>
	<label>Mot de passe : </label><input type='password' name='password' id='password'/>
	<label>Vérification mot de passe : </label><input type='password' name='passwordCheck' id='passwordCheck'/>


	<?php
		$droits = array(1=>"utilisateur", 2=>"administrateur", 3=>"superadministrateur");

		echo '<select>';

		foreach($droits as $key=>$value){
			echo "<option value='".$key."'>".$value."</option>";
		}


	?>

	<input type='submit' name='cancel' value='annuler' id='cancel'/>
	<input type='submit' name='submit' value='créer' id='submit'/>

</form>
