<?php
	if($_SESSION['droits']>=2){
		echo '<a href="./?r=constructeursModeles/ajouter&ajout=constructeur"><img src="./images/plus.png" class="imageButton ajout" alt="Ajouter constructeur"></a>';
		echo '<a href="./?r=constructeursModeles/ajouter&ajout=modele"><img src="./images/plus.png" class="imageButton ajout" alt="Ajouter constructeur"></a>';
	}
?>
<table class="tableAffichage">
	<tr><th>Constructeurs</th><th>Modèles</th></tr>
	<?php
		foreach($data as $row){
			if($row['constructeur']->libelle!=""){
				echo "<tr><td><a href='./?r=constructeursModeles/afficherConstructeur&constructeur=".$row['constructeur']->id."'><img src='./images/plus.png' class='petitBouton'>".$row['constructeur']->libelle."</a></td>";
			}else{
				echo "<tr><td><a href='./?r=constructeursModeles/afficherConstructeur&constructeur=".$row['constructeur']->id."'>".$row['constructeur']->libelle."</a></td>";		
			}
			if($row['modele']==null){
				echo "<td><i>Aucun modèle</i></td></tr>";
			}else{
				echo "<td><a href='./?r=constructeursModeles/afficherModele&modele=".$row['modele']->id."'><img src='./images/plus.png' class='petitBouton'>".$row['modele']->libelle."</a></td></tr>";
			}
		}
	?>
</table>
