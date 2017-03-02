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
	console.log("Test de connexion à <?php echo $data['central']; ?>");
	console.log("Adresse à changer dans reglagesController/index()");
	ping();
	window.setInterval(ping,2000);
	function ping(){
		$('#connecte').html("<span class='petitBouton gris'>&nbsp;&nbsp;&nbsp;&nbsp;</span> Chargement...");
		$('#afficheMaj').remove();
		$('#afficheMajDesactive').remove();
		$('#fonctionnalites').append("<a id='afficheMajDesactive'><img src='./images/centraleHorsLigne.svg' class='imageButton gris' alt='Serveur inaccessible'></a>");
		$.ajax("<?php echo $data['central']; ?>", {
		  statusCode: {
			404: function (thrownError) {
				$('#connecte').html("<span class='petitBouton rouge'>&nbsp;&nbsp;&nbsp;&nbsp;</span>Serveur accessible mais fichier de test introuvable (erreur 404)");
			},
			200: function () {
				$('#connecte').html("<span class='petitBouton vert'>&nbsp;&nbsp;&nbsp;&nbsp;</span>Connecté");
				if($('#fonctionnalites a').length<4){
					$('#afficheMajDesactive').remove();
					$('#fonctionnalites').append("<a id='afficheMaj' href='http://<?php echo $data['ipCentral']?>/projets3/app_centrale/?r=centraleMaj/miseAJour&ip=<?php echo $data['ip']?>&retour=reglages/index'><img src='./images/dlmaj.png' class='imageButton' alt='télécharger les données'></a>");
				}
			},
			0: function(){
				$('#connecte').html("<span class='petitBouton gris'>&nbsp;&nbsp;&nbsp;&nbsp;</span> Serveur inaccessible");
			}
		  }
		})
	}
</script>				
