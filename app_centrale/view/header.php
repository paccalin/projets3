<body>
	<header>
		<!-- header ici  -->
		<nav>
			<ul>
				<a href='./?r=site/index'><img src='./images/logo.jpg' alt='ID AMENAGEMENT UTILITAIRES' id='home'/></a>
				<!--<img src='./images/menu.png' alt='menu' id='menuButton'/ class="imageButton">-->
			</ul>
		</nav>
		<!--
		<div id='menuDiv' class='cache'>
			<ul id='menuUl'>
				<?php
					if($_SESSION['utilisateur']!=-1){
						$user=Utilisateur::FindById($_SESSION['utilisateur']);
						if($_SESSION['mode']=='client'){
							$client=Client::FindById($_SESSION['client']);
							echo "<li id='menuDeroulantPseudo'>Mode Client</li>";
							echo "\n\t\t\t\t<hr class='separateurPetit'>";
							echo "<li id='menuDeroulantPseudo'>Client : ".$client->nom." ".$client->prenom."</li>";
							echo "\n\t\t\t\t<hr class='separateurPetit'>";
							echo "\n\t\t\t\t<a href='".'./?r=connexion/swichUtilisateurClient'."' class='lien'>\n\t\t\t\t\t<li class='menu'>Passer en mode utilisateur</li>\n\t\t\t\t</a>";
							echo "\n\t\t\t\t<hr class='separateurGrand'>";
							echo "\n\t\t\t\t<a href='".'./?r=panier/showPanierClient'."' class='lien'>\n\t\t\t\t\t<li class='menu'>Panier</li>\n\t\t\t\t</a>";
							echo "\n\t\t\t\t<hr class='separateurGrand'>";
							echo "\n\t\t\t\t<a href='".'./?r=option/afficherTous'."' class='lien'>\n\t\t\t\t\t<li class='menu'>Options</li>\n\t\t\t\t</a>";
							//echo "\n\t\t\t\t<hr class='separateurGrand'>";
						}else{
							echo "<li id='menuDeroulantPseudo'>Connecté: ".$user->pseudo."</li>";
							echo "\n\t\t\t\t<hr class='separateurPetit'>";
							
							echo "\n\t\t\t\t<a href='".'./?r=connexion/deconnexion'."' class='lien'>\n\t\t\t\t\t<li class='menu'>Se déconnecter</li>\n\t\t\t\t</a>";
							echo "\n\t\t\t\t<hr class='separateurPetit'>";
							echo "\n\t\t\t\t<a href='./?r=administration/changerMotPasse' class='lien'>\n\t\t\t\t\t<li class='menu'>Changer le mot de passe</li>\n\t\t\t\t</a>";
							echo "\n\t\t\t\t<hr class='separateurPetit'>";
							if($_SESSION['client']!=-1){
								echo "\n\t\t\t\t<hr class='separateurGrand'>";
								$client=Client::FindById($_SESSION['client']);
								echo "<li id='menuDeroulantPseudo'>Client: ".$client->nom." ".$client->prenom."</li>";
								echo "\n\t\t\t\t<hr class='separateurPetit'>";
								echo "\n\t\t\t\t<a href='".'./?r=connexion/swichUtilisateurClient'."' class='lien'>\n\t\t\t\t\t<li class='menu'>Passer en mode client</li>\n\t\t\t\t</a>";
								echo "\n\t\t\t\t<hr class='separateurPetit'>";
								echo "\n\t\t\t\t<a href='".'./?r=connexion/changeClient'."' class='lien'>\n\t\t\t\t\t<li class='menu'>Changer de profil client</li>\n\t\t\t\t</a>";
								echo "\n\t\t\t\t<hr class='separateurPetit'>";
							}else{
								echo "\n\t\t\t\t<a href='./?r=connexion/ajouterClient' class='lien'><li class='menu'>Lier un client</li>\n\t\t\t\t</a>";
								echo "\n\t\t\t\t<hr class='separateurPetit'>";
							}
							echo "\n\t\t\t\t<hr class='separateurGrand'>";
							echo "\n\t\t\t\t<a href='./?r=site/index' class='lien'>\n\t\t\t\t\t<li class='menu'>Accueil</li>\n\t\t\t\t</a>";
							echo "\n\t\t\t\t<hr class='separateurPetit'>";
							echo "\n\t\t\t\t<a href='./?r=Search/view_page' class='lien'>\n\t\t\t\t\t<li class='menu'>Recherche</li>\n\t\t\t\t</a>";
							echo "\n\t\t\t\t<hr class='separateurPetit'>";
							echo "\n\t\t\t\t<a href='./?r=Diapo/view_diapo' class='lien'>\n\t\t\t\t\t<li class='menu'>Diapo</li>\n\t\t\t\t</a>";
							if($_SESSION['droits']>=1){
								echo "\n\t\t\t\t<hr class='separateurGrand'>";
								echo "\n\t\t\t\t<a href='./?r=client/afficherTous' class='lien'>\n\t\t\t\t\t<li class='menu'>Clients</li>\n\t\t\t\t</a>";
								echo "\n\t\t\t\t<hr class='separateurPetit'>";
								echo "\n\t\t\t\t<a href='./?r=client/rechercher' class='lien'>\n\t\t\t\t\t<li class='menu'>Rechercher</li>\n\t\t\t\t</a>";
								echo "\n\t\t\t\t<hr class='separateurPetit'>";
								echo "\n\t\t\t\t<a href='./?r=client/creer' class='lien'>\n\t\t\t\t\t<li class='menu'>Ajouter</li>\n\t\t\t\t</a>";
								echo "\n\t\t\t\t<hr class='separateurGrand'>";

								echo "\n\t\t\t\t<a href='./?r=rendezvous/afficherTous' class='lien'>\n\t\t\t\t\t<li class='menu'>Rendez-vous</li>\n\t\t\t\t</a>";
								echo "\n\t\t\t\t<hr class='separateurPetit'>";
								echo "\n\t\t\t\t<a href='./?r=rendezvous/rechercher' class='lien'>\n\t\t\t\t\t<li class='menu'>Rechercher (R)</li>\n\t\t\t\t</a>";
								echo "\n\t\t\t\t<hr class='separateurPetit'>";
								echo "\n\t\t\t\t<a href='./?r=rendezvous/creer' class='lien'>\n\t\t\t\t\t<li class='menu'>Ajouter (F)</li>\n\t\t\t\t</a>";
								echo "\n\t\t\t\t<hr class='separateurGrand'>";
								echo "\n\t\t\t\t<a href='./?r=panier/afficherTous' class='lien'>\n\t\t\t\t\t<li class='menu'>Panier</li>\n\t\t\t\t</a>";
								echo "\n\t\t\t\t<hr class='separateurPetit'>";
								echo "\n\t\t\t\t<a href='./?r=panier/rechercher' class='lien'>\n\t\t\t\t\t<li class='menu'>Rechercher</li>\n\t\t\t\t</a>";
								echo "\n\t\t\t\t<hr class='separateurPetit'>";
								echo "\n\t\t\t\t<a href='./?r=panier/creer' class='lien'>\n\t\t\t\t\t<li class='menu'>Ajouter</li>\n\t\t\t\t</a>";
								echo "\n\t\t\t\t<hr class='separateurGrand'>";
								echo "\n\t\t\t\t<a href='./?r=option/afficherTous' class='lien'>\n\t\t\t\t\t<li class='menu'>Options</li>\n\t\t\t\t</a>\n\t\t\t\t";	
								if($_SESSION['droits']>= 2){
									echo "\n\t\t\t\t<hr class='separateurPetit'>";
									echo "\n\t\t\t\t<a href='./?r=option/creer' class='lien'>\n\t\t\t\t\t<li class='menu'>Ajouter</li>\n\t\t\t\t</a>\n\t\t\t\t";
								}
								echo "\n\t\t\t\t<hr class='separateurGrand'>";
								echo "\n\t\t\t\t<a href='./?r=constructeursModeles/afficher' class='lien'>\n\t\t\t\t\t<li class='menu'>Constructeurs et modèles</li>\n\t\t\t\t</a>\n\t\t\t\t";
							}
							if($_SESSION['droits']>= 2){
								echo "\n\t\t\t\t<hr class='separateurPetit'>";
								echo "\n\t\t\t\t<a href='./?r=constructeursModeles/ajouter&ajout=constructeur' class='lien'>\n\t\t\t\t\t<li class='menu'>Ajouter constructeur</li>\n\t\t\t\t</a>\n\t\t\t\t";
								echo "\n\t\t\t\t<hr class='separateurPetit'>";
								echo "\n\t\t\t\t<a href='./?r=constructeursModeles/ajouter&ajout=modele' class='lien'>\n\t\t\t\t\t<li class='menu'>Ajouter modèle</li>\n\t\t\t\t</a>\n\t\t\t\t";
								echo "\n\t\t\t\t<hr class='separateurGrand'>";
								echo "\n\t\t\t\t<a href='./?r=administration/gererComptes' class='lien'>\n\t\t\t\t\t<li class='menu'>Comptes</li>\n\t\t\t\t</a>\n\t\t\t\t";
								echo "\n\t\t\t\t<hr class='separateurPetit'>";
								echo "\n\t\t\t\t<a href='./?r=administration/creerCompte' class='lien'>\n\t\t\t\t\t<li class='menu'>Créer un Compte</li>\n\t\t\t\t</a>";	
							}
							if($_SESSION['droits']>0){
								echo "\n\t\t\t\t<hr class='separateurGrand'>";
								echo "\n\t\t\t\t<a href='./?r=reglages/AfficherMiseAJour' class='lien'>\n\t\t\t\t\t<li class='menu'>Réglages (F)</li>\n\t\t\t\t</a>";
								echo "\n\t\t\t\t<hr class='separateurPetit'>";
								echo "\n\t";
							}
						}
					}else{
						echo "\n\t\t\t\t<li id='menuDeroulantPseudo'>Déconnecté</li>\n\t\t\t\t</a>";
						echo "\n\t\t\t\t<hr class='separateurGrand'>";
						echo "\n\t\t\t\t<a href='".'./?r=connexion/connexion'."' class='lien'>\n\t\t\t\t\t<li class='menu'>Se connecter</li></a>\n\t\t\t\t";
					}
				?>
			</ul>
		</div>
		-->
	</header>


	<section id="contenu">
