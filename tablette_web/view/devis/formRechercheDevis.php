<form action='./?r=devis/rechercher' method='post'>

	<input type='text' name='recherche' id='recherche' <?php if(isset($_POST['recherche'])){echo "value='".$_POST['recherche']."'";} ?> /><div class="form_boutons">
		<input type='submit' name='submit' value='Rechercher' id='submit'/>
	</div>
</form>
<table class="tableAffichage">
	<tr><th>Client</th><th>Modèle</th><th>Actif</th></tr>
	<?php
		if(isset($data)){
			if($data['resultat']!=[]){
				foreach($data['resultat'] as $devis){
					echo "<tr><td><a href='./?r=devis/afficherParId&devis=".$devis->id."'>".$devis->client->nom." ".$devis->client->prenom."</a></td><td><a href='./?r=devis/afficherParId&devis=".$devis->id."'>".$devis->modele->libelle."</a></td>";
					if($devis->actif==1){
						echo "<td><a href='./?r=devis/afficherParId&devis=".$devis->id."'>oui</a></td>";
					}else{
						echo "<td><a href='./?r=devis/afficherParId&devis=".$devis->id."'>non</a></td>";
					}
					echo "</tr>";
				}
			}else{
				echo $data['message'];
			}
		}
	?>
</table>