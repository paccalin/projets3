<?php
	if($_SESSION['utilisateur']!=-1){
		if($_SESSION['mode']=='client'){
			$rubriques=[
				['nom'=>'Diapo', 'controller'=>'Diapo', 'visualiser'=>'view_diapo', 'ajout'=>null, 'recherche'=>null],
				['nom'=>'Panier', 'controller'=>'panier', 'visualiser'=>'showPanierClient', 'ajout'=>null, 'recherche'=>null],
				['nom'=>'Options', 'controller'=>'option', 'visualiser'=>'afficherTous', 'ajout'=>null, 'recherche'=>'rechercher'],
				['nom'=>'Mode client', 'controller'=>'connexion', 'switchUC'=>'swichUtilisateurClient']
			];
		}else{
			if($_SESSION['droits']==1){
				$rubriques=[
					['nom'=>'Diapo', 'controller'=>'Diapo', 'visualiser'=>'view_diapo', 'ajout'=>null, 'recherche'=>null],
					['nom'=>'Clients', 'controller'=>'client', 'visualiser'=>'afficherTous', 'ajout'=>'creer', 'recherche'=>'rechercher'],
					['nom'=>'Rendez-vous', 'controller'=>'rendezvous', 'visualiser'=>'afficherTous', 'ajout'=>'creer', 'recherche'=>'rechercher'],
					['nom'=>'Panier', 'controller'=>'panier', 'visualiser'=>'afficherTous', 'ajout'=>null, 'recherche'=>'rechercher'],
					['nom'=>'Options', 'controller'=>'option', 'visualiser'=>'afficherTous', 'ajout'=>null, 'recherche'=>'rechercher'],
					['nom'=>'Construct. & modèles', 'controller'=>'constructeursModeles', 'visualiser'=>'afficher', 'ajout'=>null, 'recherche'=>'rechercher'],
					['nom'=>'Mises à jour','controller'=>'reglages','visualiser'=>'AfficherMiseAJour','ajout'=>null,'recherche'=>null]
				];
			}elseif($_SESSION['droits']==2){
				$rubriques=[
					['nom'=>'Diapo', 'controller'=>'Diapo', 'visualiser'=>'view_diapo', 'ajout'=>null, 'recherche'=>null],
					['nom'=>'Clients', 'controller'=>'client', 'visualiser'=>'afficherTous', 'ajout'=>'creer', 'recherche'=>'rechercher'],
					['nom'=>'Rendez-vous', 'controller'=>'rendezvous', 'visualiser'=>'afficherTous', 'ajout'=>'creer', 'recherche'=>'rechercher'],
					['nom'=>'Panier', 'controller'=>'panier', 'visualiser'=>'afficherTous', 'ajout'=>null, 'recherche'=>'rechercher'],
					['nom'=>'Options', 'controller'=>'option', 'visualiser'=>'afficherTous', 'ajout'=>'creer', 'recherche'=>'rechercher'],
					['nom'=>'Construct. & modèles', 'controller'=>'constructeursModeles', 'visualiser'=>'afficher', 'ajout'=>null, 'recherche'=>null],
					['nom'=>'Comptes', 'controller'=>'administration', 'visualiser'=>'gererComptes', 'ajout'=>'creerCompte', 'recherche'=>'rechercher'],
					['nom'=>'Mises à jour','controller'=>'reglages','visualiser'=>'AfficherMiseAJour','ajout'=>null,'recherche'=>null]
				];
			}else{
				$rubriques=[
					['nom'=>'Diapo', 'controller'=>'Diapo', 'visualiser'=>'view_diapo', 'ajout'=>null, 'recherche'=>null],
					['nom'=>'Clients', 'controller'=>'client', 'visualiser'=>'afficherTous', 'ajout'=>'creer', 'recherche'=>'rechercher'],
					['nom'=>'Rendez-vous', 'controller'=>'rendezvous', 'visualiser'=>'afficherTous', 'ajout'=>'creer', 'recherche'=>'rechercher'],
					['nom'=>'Panier', 'controller'=>'panier', 'visualiser'=>'afficherTous', 'ajout'=>null, 'recherche'=>'rechercher'],
					['nom'=>'Options', 'controller'=>'option', 'visualiser'=>'afficherTous', 'ajout'=>'creer', 'recherche'=>'rechercher'],
					['nom'=>'Constr/Modèles', 'controller'=>'constructeursModeles', 'visualiser'=>'afficher', 'ajout'=>'ajouter&ajout=constructeur', 'ajout2'=>'ajouter&ajout=modele', 'recherche'=>'rechercher'],
					['nom'=>'Comptes', 'controller'=>'administration', 'visualiser'=>'gererComptes', 'ajout'=>'creerCompte', 'recherche'=>null],
					['nom'=>'Mises à jour', 'controller'=>'reglages', 'visualiser'=>'AfficherMiseAJour', 'ajout'=>null, 'recherche'=>null]
				];
			}
			if($_SESSION['client']!=-1){
				array_push($rubriques,['nom'=>'Connecté', 'controller'=>'connexion', 'visualiser'=>null, 'ajout'=>null, 'recherche'=>null, 'croix'=>'deconnexion','changeClient'=>'changeClient','switchUC'=>'swichUtilisateurClient']);
			}else{
				array_push($rubriques,['nom'=>'Connecté', 'controller'=>'connexion', 'visualiser'=>null, 'ajout'=>null, 'recherche'=>null, 'croix'=>'deconnexion','ajoutClient'=>'ajouterClient']);
			}
			
		}
	}else{
		$rubriques=[
				['nom'=>'Connexion', 'controller'=>'connexion', 'visualiser'=>'connexion', 'ajout'=>null, 'recherche'=>null]
			];
	}
	foreach($rubriques as $rubrique){
		echo "\n<div class='rubriqueExt'>";
		echo "\n\t<div class='rubriqueInt'>";
		if(isset($rubrique['visualiser']) AND $rubrique['visualiser']!=null){
			//echo "<a href='./?r=".$rubrique['controller']."/".$rubrique['visualiser']."&retour=site/index'><div class='rubriqueTexte'>".$rubrique['nom']."</div></a>";
			echo "\n\t\t<a href='./?r=".$rubrique['controller']."/".$rubrique['visualiser']."&retour=site/index'><div class='rubriqueTexte'><img src='./images/".$rubrique['controller'].".png' alt='".$rubrique['nom']."' class='imageIndex'></div></a>";
		}else{
			echo "\n\t\t<div class='rubriqueTexte'><img src='./images/".$rubrique['controller'].".png' alt='".$rubrique['nom']."'></div>";
		}
		if(isset($rubrique['ajout']) AND $rubrique['ajout']!=null){
			echo "\n\t\t<a href='./?r=".$rubrique['controller']."/".$rubrique['ajout']."&retour=site/index'><img src='./images/plus.png' class='boutonIndex boutonVert boutonHD' alt='Ajout'></a>";
		}
		if(isset($rubrique['ajout2']) AND $rubrique['ajout2']!=null){
			echo "\n\t\t<a href='./?r=".$rubrique['controller']."/".$rubrique['ajout2']."&retour=site/index'><img src='./images/plus.png' class='boutonIndex boutonVert boutonMD' alt='Ajout'></a>";
		}
		if(isset($rubrique['recherche']) AND $rubrique['recherche']!=null){
			echo "\n\t\t<a href='./?r=".$rubrique['controller']."/".$rubrique['recherche']."&retour=site/index'><img src='./images/loupe.png' class='boutonIndex boutonGris boutonHM' alt='Recherche'></a>";
		}
		if(isset($rubrique['croix']) AND $rubrique['croix']!=null){
			echo "\n\t\t<a href='./?r=".$rubrique['controller']."/".$rubrique['croix']."&retour=site/index'><img src='./images/croix.png' class='boutonIndex boutonRouge boutonMG' alt='X'></a>";
		}
		if(isset($rubrique['ajoutClient']) AND $rubrique['ajoutClient']!=null){
			echo "\n\t\t<a href='./?r=".$rubrique['controller']."/".$rubrique['ajoutClient']."&retour=site/index'><img src='./images/ajouteClient.png' class='boutonIndex boutonVert boutonHD' alt='+'></a>";
		}
		if(isset($rubrique['changeClient']) AND $rubrique['changeClient']!=null){
			echo "\n\t\t<a href='./?r=".$rubrique['controller']."/".$rubrique['changeClient']."&retour=site/index'><img src='./images/changeClient.png' class='boutonIndex boutonVert boutonHD' alt='<=>'></a>";
		}
		if(isset($rubrique['switchUC']) AND $rubrique['switchUC']!=null){
			echo "\n\t\t<a href='./?r=".$rubrique['controller']."/".$rubrique['switchUC']."&retour=site/index'><img src='./images/switchUC.png' class='boutonIndex boutonJaune boutonMD' alt='<=>'></a>";
		}
		echo "\n\t</div>";
		echo "\n\t<div class='texteLegendeIndex'>".$rubrique['nom']."</div>";
		echo "\n</div>";
	}
?>










<!--
<p><i>Ce site est un prototype, toutes les fonctionnalités ne sont pas encore réalisées.</i></p>
<p><i>(R) page à réaliser</i></p>
<p><i>(F) page à finaliser</i></p>
<br/>
<!--
	<p><b><u>/!\</u> A faire Alexis/Joseph/Edouard:</b><br/><br/>Allez voir le fichier <b>missions.txt</b>, il y a une liste de missions plus ou moins longues à faire, classées par difficulté.</p>
	<p>&nbsp;Ecrivez dans ce fichier votre nom à côté de la mission que vous voulez effectuer et une fois finie, écrire "terminée votre_nom" devant.</p>
	<p>&nbsp;Faites un pull juste avant d'écrire dans le fichier et un push juste après pour que le fichier soit continuellement à jour.</p>
	<br/>
-->
<!--
	Pas faire:
	<p>
		<b><u>/!\</u> A faire peu importe qui:</b><br/>
		<br/>
		-Remplacer tous les input type="cancel" des formulaires par des <u>button</u><br/>
		-Leur mettre le même CSS que les boutons d'avant (juste ajouter leur classe au bon endroit, et pas faire un nouveau bloc CSS)<br/>
		-Ajouter un onclick header location machin truc pour rediriger au bon endroit
	</p>
-->
<!--
<p>
	<b><u>/!\</u> A faire peu importe qui:</b><br/>
	<br/>
	-Finaliser la fonction Panier::getCoutTotal() c'est du SQL pur<br/>
	<br/>
	-Remplacer tous les number_format par une fonction affiche_cout qui fait le même traitement et qui rajoute '€' derrère<br/>
	<br/>
	-Faire une fonction qui remplace les " ' " d'une chaîne par un " \' " et l'appeller à chaque insertion/modification de BD<br/> 
</p>
-->
