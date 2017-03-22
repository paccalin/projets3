<?php
	if(isset($_GET['retour'])){
		echo "<a href='./?r=".$_GET['retour']."' class='lien'><img src='./images/back.png' alt='Retour' class='imageButton'></a>";
	}else{
		echo "<a href='./?r=option/afficherTous' class='lien'><img src='./images/back.png' alt='Retour' class='imageButton'></a>";
	}
?>
<p>Il y a pas encore grand chose</p>
