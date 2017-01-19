<?php
	if($data['statut']=='non connecte'){
		echo 'L\'application Python n\'est pas connectée';
	}elseif($data['statut']=='connecte'){
		echo 'L\'application Python est connectée';
	}
	echo'<br/>Liste des sockets: <br/>';
	foreach (Socket::FindAll() as $socket){
		echo "<h1>-Socket</h1>";
		echo "<h3>---Action</h3>";
		echo "<p>".$socket->action."</p>";
		echo "<h3>---Table</h3>";
		echo "<p>".$socket->table."</p>";
		echo "<h3>---Objet</h3>";
		echo var_dump($socket->objet);
		echo "<h3>---Date insertion</h3>";
		echo "<p>".$socket->dateInsertion."</p>";
		echo "<br/>";
	}
?>