<p>Voulez-vous vraiment supprimer l'option <b><?php echo $data['option']->libelle;?></b>? Cette action ne peut pas être annulée.</p>
<p>Cette option sera aussi retirée de tous les paniers où elle est actuellement.</p>
<form action='./?r=option/supprimer<?php echo "&option=".$_GET['option']?>' method='post'>
	<div class="form_boutons">
		<input type='submit' name='submit' value='Confirmer' id='submit'/><!--
		--><input type='submit' name='cancel' value='Annuler' id='cancel'/>
	</div>
</form>
