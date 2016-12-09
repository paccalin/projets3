<?php
	
echo <<<HTML
	<form action ='./?r=choice/viewInsert' method='post'>
<<<<<<< HEAD
		
		<select name='choice' id='choice'>
=======
		<select name='insert'>
>>>>>>> 992220dd1daa25de20d50a0e47fdc64fcd1d8360
			<option value='null'>--- choisir ---</option>
			<option value='client'>client</option>
			<option value='rdv'>rendez-vous</option>php
			<option value='devis'>devis</option>			
HTML;

/*
if({utilisateur_droit} == '{administrateur}'){
	echo <<<HTML
		<option value='vehicule'>vehicule</option>
		<option value='photo'>photo</option>
		<option value='option'>option</option>
		<option value='brand'>constructeur</option>
		<option value='modele'>modele</option>
HTML;
}


if({utilisateur_droit} == '{super_admin}'){
	echo "<option value='user'>utilisateur</option>";
}
*/

echo <<<HTML

		</select>

		<input type='submit' value='valider' name='submit' id='submit'/>

	</form>

HTML;
?>


<script type='text/javascript' src='./js/insert.js'></script>
