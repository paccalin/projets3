<?php
	$rubriques=[
		['nom'=>'Diapo','controller'=>'Diapo','visualiser'=>'view_diapo','ajout'=>null,'recherche'=>null],
		['nom'=>'Client','controller'=>'client','visualiser'=>'afficherTous','ajout'=>'creer','recherche'=>'rechercher'],
		['nom'=>'Rendez-vous','controller'=>'rendezvous','visualiser'=>'afficherTous','ajout'=>'creer','recherche'=>'rechercher'],
		['nom'=>'Panier','controller'=>'panier','visualiser'=>'afficherTous','ajout'=>null,'recherche'=>'rechercher'],
		['nom'=>'Options','controller'=>'option','visualiser'=>'afficherTous','ajout'=>'creer','recherche'=>'rechercher'],
		['nom'=>'Constructeur & modèles','controller'=>'constructeursModeles','visualiser'=>'afficher','ajout'=>null,'recherche'=>null],
		['nom'=>'Comptes','controller'=>'administration','visualiser'=>'gererComptes','ajout'=>'creerCompte','recherche'=>null],
		['nom'=>'Réglages','controller'=>'reglages','visualiser'=>'AfficherMiseAJour','ajout'=>null,'recherche'=>null],
	];
	foreach($rubriques as $rubrique){
		echo "<div class='rubrique'>";
		echo "<a href='./?r=".$rubrique['controller']."/".$rubrique['visualiser']."&retour=site/index'><div class='rubriqueTexte'>".$rubrique['nom']."</div></a>";
		if($rubrique['ajout']!=null){
			echo "<a href='./?r=".$rubrique['controller']."/".$rubrique['ajout']."&retour=site/index'><img src='./images/plus.png' class='boutonAjout' alt='Ajout'></a>";
		}
		if($rubrique['recherche']!=null){
			echo "<a href='./?r=".$rubrique['controller']."/".$rubrique['recherche']."&retour=site/index'><img src='./images/loupe.png' class='boutonRecherche' alt='Recherche'></a>";
		}
		echo "</div>";
	}
?>
