Statut application centrale: <span id="connecte">Chargement...</span>
<br/>
<p>Données en attentes de mise à jour : <?php echo $data['nbMaj'];?></p>
<p>Dernière connexion  : <?php echo $data['derniereConnexion'];?></p>
<p>Dernière mise à jour : <?php echo $data['derniereMaj'];?></p>
<div id='fonctionnalites'>
	<p><a href='./?r=reglages/MettreAJour' class='lien'>Effectuer une mise à jour</a></p>
	<p><a href='./?r=reglages/AfficherIP' class='lien'>Afficher l'adresse IP</a></p>
</div>
<script>
	ping();
	window.setInterval(ping,2000);
	function ping(){
		$('#connecte').text('Chargement...');
		$('#afficheMaj').remove();
		$('#afficheMajDesactive').remove();
		$('#fonctionnalites').append("<p id='afficheMajDesactive'><img src='./images/dlmaj.png' class='imageButton gris' alt='Télécharger les données'></a></p>");
		$.ajax("<?php echo $data['central']; ?>", {
		  statusCode: {
			404: function (thrownError) {
				$('#connecte').text('Erreur 404');
			},
			200: function () {
				$('#connecte').text('Connectée');
				if($('#fonctionnalites p').length<4){
					$('#afficheMajDesactive').remove();
					$('#fonctionnalites').append("<p id='afficheMaj'><a href='http://<?php echo $data['ipCentral']?>/projets3/tablette_web/?r=centraleMaj/miseAJour&retour=site/index&ip=<?php echo $data['ip']?>&retour=reglagesAfficherMiseAJour'><img src='./images/dlmaj.png' class='imageButton' alt='télécharger les données'></a></p>");
				}
			},
			0: function(thrownError){
				$('#connecte').text('Non connectée ('+thrownError+')');
				//console.log(JSON.stringify(thrownError));
			}
		  }
		})
	}
</script>				
