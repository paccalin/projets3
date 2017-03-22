Supprimer le véhicule immatriculé <?php echo $data['vehicule']->immatriculation;?> (propriétaire: <?php echo $data['vehicule']->client->nom.' '.$data['vehicule']->client->prenom;?>)?
<form action='./?r=vehicule/supprimer&id=<?php echo $_GET['id'];?>' method='post'>
	<div class="form_boutons">
		<input type='submit' name='submit' value='Confirmer' id='submit'/><!--
		--><input type='submit' name='cancel' value='Annuler' id='cancel'/>
	</div>
</form>