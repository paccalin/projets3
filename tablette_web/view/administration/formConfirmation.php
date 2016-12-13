Vous allez passez <?php echo $_GET['pseudo'];?> en super-administrateur. Cette action ne peut pas être annulée
<form action='./?r=administration/augmenteDroits<?php echo "&id=".$_GET['id']?>' method='post'>
	<div class="form_boutons">
		<input type='submit' name='submit' value='Confirmer' id='submit'/><!--
		--><input type='submit' name='cancel' value='Annuler' id='cancel'/>
	</div>
</form>
