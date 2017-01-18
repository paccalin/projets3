<a href='./?r=client/afficherTous' class='lien'><img src='./images/back.png' alt='Retour aux clients' class="imageButton"></a>
<form action='./?r=client/rechercher' method='post'>

	<input type='text' name='recherche' id='recherche' <?php if(isset($_POST['recherche'])){echo "value='".$_POST['recherche']."'";} ?> /><div class="form_boutons">
		<input type='submit' name='submit' value='Rechercher' id='submit'/>
	</div>
</form>
<table class="tableAffichage">
	<tr><th>Nom</th><th>Prénom</th><th>Adresse</th><th>Ville</th><th>Mail</th><th>Téléphone</th></tr>
	<?php
		if(isset($data)){
			if($data['resultat']!=[]){
				foreach($data['resultat'] as $client){
					echo "<tr><td><a href='./?r=client/afficherParId&id=".$client['id']."'>".$client['nom']."</a></td><td><a href='./?r=client/afficherParId&id=".$client['id']."'>".$client['prenom']."</a></td><td><a href='./?r=client/afficherParId&id=".$client['id']."'>".$client['adresse']."</a></td><td><a href='./?r=client/afficherParId&id=".$client['id']."'>".$client['ville']."</a></td><td><a href='./?r=client/afficherParId&id=".$client['id']."'>".$client['mail']."</a></td><td><a href='./?r=client/afficherParId&id=".$client['id']."'>".$client['tel']."</a></td></tr>";
				}
			}else{
				echo $data['message'];
			}
		}
	?>
</table>
