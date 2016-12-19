<body>


	<header>
		<!-- header ici  -->
		<nav>
			<ul>
				<a href='./?r=site/index'><img src='./images/logo.jpg' alt='ID AMENAGEMENT UTILITAIRES' id='home'/></a>
				<img src='./images/menu.png' alt='menu' id='menuButton'/ class="imageButton">
			</ul>
		</nav>
		<div id='menuDiv' class='cache'>
			<ul id='menuUl'>
				<?php
					$home = "./?r=site/index";
					$devis = "./?r=devis/show";
					$maj = "./?r=site/aFaire";
					$rdv = "./?r=site/aFaire";
					$add = "./?r=insert/viewInsert";
					$del = "./?r=site/aFaire";
					$upd = "./?r=site/aFaire";
					$diapo = "./?r=Diapo/view_diapo";			
					/*
					if($_SESSION['identifiant']!=""){
						echo "<li id='menuDeroulantPseudo'>Connecté: ".$_SESSION['identifiant']."</li>\n\t\t\t\t</a>";
						echo "\n\t\t\t\t<hr class='separateurGrand'>";
					}else{
						echo "<li id='menuDeroulantPseudo'>Déconnecté</li>\n\t\t\t\t</a>";
						echo "\n\t\t\t\t<hr class='separateurGrand'>";
					}
					echo "\n\t\t\t\t<a href='".$home."' class='lien'>\n\t\t\t\t\t<li class='menu'>Accueil</li>\n\t\t\t\t</a>";
					echo "\n\t\t\t\t<hr class='separateurPetit'>";
					echo "\n\t\t\t\t<a href='".$diapo."' class='lien'>\n\t\t\t\t\t<li class='menu'>Diapo</li>\n\t\t\t\t</a>";
					echo "\n\t\t\t\t<hr class='separateurPetit'>";
					if($_SESSION['droits']>=1){
						echo "\n\t\t\t\t<a href='".$maj."' class='lien'>\n\t\t\t\t\t<li class='menu'>Mise à jour</li>\n\t\t\t\t</a>";
						echo "\n\t\t\t\t<hr class='separateurPetit'>";
						echo "\n\t\t\t\t<a href='".$rdv."'' class='lien'>\n\t\t\t\t\t<li class='menu'>Rendez-vous</li>\n\t\t\t\t</a>";
						echo "\n\t\t\t\t<hr class='separateurPetit'>";
						echo "\n\t\t\t\t<a href='".$add."' class='lien'>\n\t\t\t\t\t<li class='menu'>Ajouter</li>\n\t\t\t\t</a>";
						echo "\n\t\t\t\t<hr class='separateurPetit'>";
						echo "\n\t\t\t\t<a href='".$del."' class='lien'>\n\t\t\t\t\t<li class='menu'>Supprimer</li>\n\t\t\t\t</a>";
						echo "\n\t\t\t\t<hr class='separateurPetit'>";
						echo "\n\t\t\t\t<a href='".$upd."' class='lien'>\n\t\t\t\t\t<li class='menu'>Modifier</li>\n\t\t\t\t</a>";
						echo "\n\t\t\t\t<hr class='separateurGrand'>";
					}
					if($_SESSION['droits']==0){
						echo "\n\t\t\t\t<a href='".'./?r=connexion/formConnexion'."' class='lien'>\n\t\t\t\t\t<li class='menu'>Se connecter</li></a>\n\t\t\t\t";
						echo "\n\t\t\t\t<hr class='separateurPetit'>";
					}else{
						if($_SESSION['droits']>= 2){
							echo "\n\t\t\t\t<a href='".'./?r=administration/creerCompte'."' class='lien'>\n\t\t\t\t\t<li class='menu'>Créer un Compte</li>\n\t\t\t\t</a>";
							echo "\n\t\t\t\t<hr class='separateurPetit'>";
							if($_SESSION['droits']==2){
								echo "\n\t\t\t\t<a href='".'./?r=administration/gererComptes'."' class='lien'>\n\t\t\t\t\t<li class='menu'>Afficher les Comptes</li>\n\t\t\t\t</a>\n\t\t\t\t";
								echo "\n\t\t\t\t<hr class='separateurPetit'>";
							}else{
								echo "\n\t\t\t\t<a href='".'./?r=administration/gererComptes'."' class='lien'>\n\t\t\t\t\t<li class='menu'>Gérer les Comptes</li>\n\t\t\t\t</a>";
								echo "\n\t\t\t\t<hr class='separateurPetit'>";
							}
						}
						echo "\n\t\t\t\t<a href='".'./?r=administration/changerMotPasse'."' class='lien'>\n\t\t\t\t\t<li class='menu'>Changer le mot de passe</li>\n\t\t\t\t</a>";
						echo "\n\t\t\t\t<hr class='separateurPetit'>";
						echo "\n\t\t\t\t<a href='".'./?r=connexion/deconnexion'."' class='lien'>\n\t\t\t\t\t<li class='menu'>Se déconnecter</li>\n\t\t\t\t</a>";
						echo "\n\t\t\t\t<hr class='separateurPetit'>";
						echo "\n";
					}
					*/
					if($_SESSION['identifiant']!=""){
						echo "<li id='menuDeroulantPseudo'>Connecté: ".$_SESSION['identifiant']."</li>\n\t\t\t\t</a>";
					}else{
						echo "<li id='menuDeroulantPseudo'>Déconnecté</li>\n\t\t\t\t</a>";
					}
					echo "\n\t\t\t\t<hr class='separateurGrand'>";
					echo "\n\t\t\t\t<a href='".$home."' class='lien'>\n\t\t\t\t\t<li class='menu'>Accueil</li>\n\t\t\t\t</a>";
					echo "\n\t\t\t\t<hr class='separateurPetit'>";
					echo "\n\t\t\t\t<a href='".$diapo."' class='lien'>\n\t\t\t\t\t<li class='menu'>Diapo</li>\n\t\t\t\t</a>";
					echo "\n\t\t\t\t<hr class='separateurGrand'>";
					if($_SESSION['droits']>=1){
						echo "\n\t\t\t\t<a href='./?r=client/afficherTous' class='lien'>\n\t\t\t\t\t<li class='menu'>Clients</li>\n\t\t\t\t</a>";
						echo "\n\t\t\t\t<hr class='separateurPetit'>";
						echo "\n\t\t\t\t<a href='./?r=client/rechercher' class='lien'>\n\t\t\t\t\t<li class='menu'>Rechercher</li>\n\t\t\t\t</a>";
						echo "\n\t\t\t\t<hr class='separateurPetit'>";
						echo "\n\t\t\t\t<a href='./?r=client/creer' class='lien'>\n\t\t\t\t\t<li class='menu'>Ajouter</li>\n\t\t\t\t</a>";
						echo "\n\t\t\t\t<hr class='separateurGrand'>";

						echo "\n\t\t\t\t<a href='./?r=rendezvous/afficherTous' class='lien'>\n\t\t\t\t\t<li class='menu'>Rendez-vous</li>\n\t\t\t\t</a>";
						echo "\n\t\t\t\t<hr class='separateurPetit'>";
						echo "\n\t\t\t\t<a href='./?r=rendezvous/rechercher' class='lien'>\n\t\t\t\t\t<li class='menu'>Rechercher</li>\n\t\t\t\t</a>";
						echo "\n\t\t\t\t<hr class='separateurPetit'>";
						echo "\n\t\t\t\t<a href='./?r=rendezvous/creer' class='lien'>\n\t\t\t\t\t<li class='menu'>Ajouter</li>\n\t\t\t\t</a>";

						echo "\n\t\t\t\t<hr class='separateurGrand'>";
						echo "\n\t\t\t\t<a href='".$del."' class='lien'>\n\t\t\t\t\t<li class='menu'>Supprimer</li>\n\t\t\t\t</a>";
						echo "\n\t\t\t\t<hr class='separateurPetit'>";
						echo "\n\t\t\t\t<a href='".$upd."' class='lien'>\n\t\t\t\t\t<li class='menu'>Modifier</li>\n\t\t\t\t</a>";
						echo "\n\t\t\t\t<hr class='separateurGrand'>";
					}
					if($_SESSION['droits']==0){
						echo "\n\t\t\t\t<a href='".'./?r=connexion/formConnexion'."' class='lien'>\n\t\t\t\t\t<li class='menu'>Se connecter</li></a>\n\t\t\t\t";
						echo "\n\t\t\t\t<hr class='separateurPetit'>";
					}else{
						if($_SESSION['droits']>= 2){
							echo "\n\t\t\t\t<a href='".'./?r=administration/creerCompte'."' class='lien'>\n\t\t\t\t\t<li class='menu'>Créer un Compte</li>\n\t\t\t\t</a>";
							echo "\n\t\t\t\t<hr class='separateurPetit'>";
							if($_SESSION['droits']==2){
								echo "\n\t\t\t\t<a href='".'./?r=administration/gererComptes'."' class='lien'>\n\t\t\t\t\t<li class='menu'>Afficher les Comptes</li>\n\t\t\t\t</a>\n\t\t\t\t";
								echo "\n\t\t\t\t<hr class='separateurPetit'>";
							}else{
								echo "\n\t\t\t\t<a href='".'./?r=administration/gererComptes'."' class='lien'>\n\t\t\t\t\t<li class='menu'>Gérer les Comptes</li>\n\t\t\t\t</a>";
								echo "\n\t\t\t\t<hr class='separateurPetit'>";
							}
						}
						echo "\n\t\t\t\t<a href='".'./?r=administration/changerMotPasse'."' class='lien'>\n\t\t\t\t\t<li class='menu'>Changer le mot de passe</li>\n\t\t\t\t</a>";
						echo "\n\t\t\t\t<hr class='separateurPetit'>";
						echo "\n\t\t\t\t<a href='".'./?r=connexion/deconnexion'."' class='lien'>\n\t\t\t\t\t<li class='menu'>Se déconnecter</li>\n\t\t\t\t</a>";
						echo "\n\t\t\t\t<hr class='separateurPetit'>";
						echo "\n";
					}
				?>
			</ul>
		</div>
	</header>


	<section id="contenu">
