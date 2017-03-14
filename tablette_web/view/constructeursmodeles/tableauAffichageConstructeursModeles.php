<?php
	if($_SESSION['droits']>=2){
		echo '<a href="./?r=constructeursModeles/ajouter&ajout=constructeur"><img src="./images/plus.png" class="imageButton ajout" alt="Ajouter constructeur"></a>Constructeur';
		echo '<a href="./?r=constructeursModeles/ajouter&ajout=modele"><img src="./images/plus.png" class="imageButton ajout" alt="Ajouter modèle"></a>Modèle';
		echo '<a href="./?r=constructeursModeles/ajouter&ajout=typeModele"><img src="./images/plus.png" class="imageButton ajout" alt="Ajouter type de modèle"></a>Type modèle';
	}
?>
<table class="tableAffichage">
	<tr><th>Constructeurs</th><th>Modèles</th><th>Type de Modèle</th></tr>
	<?php
		foreach($data as $row){
			if($row['constructeur']->libelle!=""){
				echo "<tr><td><a href='./?r=constructeursModeles/afficherConstructeur&constructeur=".$row['constructeur']->id."'><img src='./images/loupe.png' class='petitBouton'>".$row['constructeur']->libelle."</a></td>";
			}else{
				echo "<tr><td><a href='./?r=constructeursModeles/afficherConstructeur&constructeur=".$row['constructeur']->id."'>".$row['constructeur']->libelle."</a></td>";		
			}
			if($row['modele']==null){
				echo "<td><i>Aucun modèle</i></td><td></td></tr>";
			}else{
				echo "<td><a href='./?r=constructeursModeles/afficherModele&modele=".$row['modele']->id."'><img src='./images/loupe.png' class='petitBouton'>".$row['modele']->libelle."</a></td><td><a href='./?r=constructeursModeles/afficherTypeModele&id=".$row['modele']->typeModele->id."'><img src='./images/loupe.png' class='petitBouton'>".$row['modele']->typeModele->libelle."</a></td></tr>";
			}
		}
	?>
</table>
