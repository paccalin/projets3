<a href="./?r=site/index" class="lien" title="Retour"><img src="./images/back.png" alt="Retour à l'acceuil" class="imageButton"></a>
<?php
	if($_SESSION['mode']=='utilisateur'){
		$droits=['commercial','administrateur','super-administrateur'];
		echo '<a href="./?r=connexion/changerMotPasse" class="lien" title="Changer le mot de passe"><img src="./images/crayon.png" alt="Changer le mot de passe" class="imageButton"></a>';
		echo '<h1>Mode utilisateur</h1>';
		echo '<table class="tableAffichage">';
		echo '<tr><th>Pseudo</th><th>Droits</th></tr>';
		echo '<tr><td>'.$data['utilisateur']->pseudo.'</td><td>'.$droits[$data['utilisateur']->droits-1].'</td></tr>';
		echo '</table>';
		echo '</br>';
		echo 'Client';
		if($data['client']!=null){
			echo '<table class="tableAffichage">';
			echo '<tr><th>Nom</th><th>Prénom</th><th>Adresse</th><th>Ville</th><th>Mail</th><th>Téléphone</th></tr>';
			echo '<tr><td><img src="./images/plus.png" class="petitBouton"><a href=".?r=client/afficherParId&id='.$data['client']->id.'&retour=connexion/visualiser">'.$data['client']->nom.'</a></td><td><a href=".?r=client/afficherParId&id='.$data['client']->id.'&retour=connexion/visualiser">'.$data['client']->prenom.'<a></td><td><a href=".?r=client/afficherParId&id='.$data['client']->id.'&retour=connexion/visualiser">'.$data['client']->rue.'</a></td><td><a href=".?r=client/afficherParId&id='.$data['client']->id.'&retour=connexion/visualiser">'.$data['client']->ville.'</a></td><td><a href=".?r=client/afficherParId&id='.$data['client']->id.'&retour=connexion/visualiser">'.$data['client']->mail.'</a></td><td><a href=".?r=client/afficherParId&id='.$data['client']->id.'&retour=connexion/visualiser">'.$data['client']->tel.'</a></td></tr>';
			echo '</table>';
		}else{
			echo ': aucun client lié';
		}
		
	}else{
		echo '<h1>Mode client</h1>';
	}
?>
<?php
	if($_SESSION['mode']=='utilisateur'){
		echo '<br/>';
		if($_SESSION['client']==-1 OR $_SESSION['client']=='null'){
			echo '<a href="./?r=connexion/ajouterClient&retour=connexion/visualiser" class="lien" title="Lier un client"><img src="./images/ajouteClient.png" alt="Retour à l\'acceuil" class="imageButton boutonVert"></a>';
		}else{
			echo '<a href="./?r=connexion/ajouterClient&retour=connexion/visualiser" class="lien" title="Changer de client"><img src="./images/changeClient.png" alt="Retour à l\'acceuil" class="imageButton boutonVert"></a>';
			echo '<a href="./?r=connexion/delierClient&retour=connexion/visualiser" class="lien" title="Retirer le client"><img src="./images/delierClient.png" alt="Retour à l\'acceuil" class="imageButton boutonRouge"></a>';
		}
	}
?>
<br/>
<?php
	if(($_SESSION['client']!=-1 AND $_SESSION['client']!='null')OR $_SESSION['mode']=='client'){
		echo '<a href="./?r=connexion/swichUtilisateurClient" class="lien" title="Passer en mode client"><img src="./images/switchUC.png" alt="Passer en mode client" class="imageButton boutonJaune">';
	}
?>
