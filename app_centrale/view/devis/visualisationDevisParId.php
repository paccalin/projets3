<a href='./?r=devis/afficherTous' class='lien'><img src='./images/back.png' alt='Retour aux devis' class="imageButton"></a>
<table class='tableAffichage'>
	<tr><th>Client</th><th>Modèle</th></tr>
	<?php
		echo '<tr><td>'.$data['devis']->client->nom.' '.$data['devis']->client->prenom.'</td><td>'.$data['devis']->modele->libelle.'</td></tr>';
	?>
</table>
<br/>
<table class='tableAffichage'>
	<tr><th>Option</th><th>Tarif</th></tr>
	<?php
		foreach($data['joinOptions'] as $joinOption){
			echo '<tr><td>'.$joinOption['option']->libelle.'</td><td>'.$joinOption['prix'].'</td></td>';
		}
	?>
</table>
<br/>
Total: <?php echo $data['total'];?> €
<br/>
<a href='./?r=devis/genererXML&devis=<?php echo $_GET['devis'];?>' class='lien'>Générer le XML</a><br/>
<a href='./?r=devis/genererPDF&devis=<?php echo $_GET['devis'];?>' class='lien'>Générer la facture PDF</a>
