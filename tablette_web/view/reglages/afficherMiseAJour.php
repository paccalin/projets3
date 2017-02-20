Statut application centrale: <span id="connecte">Chargement...</span>
<br/>
<p>Données en attentes de mise à jour : <?php echo $data['nbMaj'];?></p>
<p>Dernière connexion  : <?php echo $data['derniereConnexion'];?></p>
<p>Dernière mise à jour : <?php echo $data['derniereMaj'];?></p>
<div id='fonctionnalites'>
	<p><a href='./?r=reglages/MettreAJour' class='lien'>Effectuer une mise à jour</a></p>
	<p><a href='./?r=reglages/AfficherIP' class='lien'>Afficher l'adresse IP</a></p>
</div>
<br/>
<p><i>Cette partie est en cours de développement, les fonctionnalités ne sont pas encore déployées sur cette version</i></p>
<script>
	ping();
	window.setInterval(ping,2000);
	function ping(){
		$('#connecte').text('Chargement...');
		$.ajax("<?php echo $data['central']; ?>", {
		  statusCode: {
			404: function (thrownError) {
				$('#connecte').text('Erreur 404');
			},
			200: function () {
				$('#connecte').text('Connectée');
				if($('#fonctionnalites p').length<3){
					$('#fonctionnalites').append("<p id='afficheMaj'><a href='http://<?php echo $data['ipCentral']?>/projets3/tablette_web/ajax/miseAJour.php?ip=<?php echo $data['ip']?>&retour=reglagesAfficherMiseAJour' class='lien'>Télécharger les dernères données</a></p>");
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
