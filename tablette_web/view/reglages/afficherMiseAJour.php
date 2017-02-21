Statut application centrale: <span id="connecte">Chargement...</span>
<br/>
<p>Données sur l'appareil en attentes de mise à jour : <?php echo $data['nbMaj'];?></p>
<p>Données sur l'appareil en attentes d'envoi : <?php echo $data['nbEnv'];?></p>
<p>Dernière connexion  : <?php echo $data['derniereConnexion'];?></p>
<p>Dernière mise à jour : <?php echo $data['derniereMaj'];?></p>
<div id='fonctionnalites'>
	<a href='./?r=reglages/MettreAJour' class='lien'><img src='./images/maj.png' class='imageButton' alt='effectuer une mise à jour'></a>
	<a href='./?r=reglages/AfficherIP&retour=reglages/index' class='lien'><img src='./images/ip.png' class='imageButton' alt='afficher adresse ip'></a>
</div>
<script>
	ping();
	window.setInterval(ping,2000);
	function ping(){
		$('#connecte').text('Chargement...');
		$('#afficheMaj').remove();
		$('#afficheMajDesactive').remove();
		$('#fonctionnalites').append("<a id='afficheMajDesactive'><img src='./images/dlmaj.png' class='imageButton gris' alt='Télécharger les données'></a>");
		$.ajax("<?php echo $data['central']; ?>", {
		  statusCode: {
			404: function (thrownError) {
				$('#connecte').text('Erreur 404');
			},
			200: function () {
				$('#connecte').text('Connectée');
				if($('#fonctionnalites a').length<4){
					$('#afficheMajDesactive').remove();
					$('#fonctionnalites').append("<a id='afficheMaj' href='http://<?php echo $data['ipCentral']?>/projets3/app_centrale/?r=centraleMaj/miseAJour&ip=<?php echo $data['ip']?>&retour=reglages/index'><img src='./images/dlmaj.png' class='imageButton' alt='télécharger les données'></a>");
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
