<a href='./?r=<?php if(isset($_GET['retour'])){echo $_GET['retour'];}else{echo 'Reglages/index';}?>' class='lien'><img src='./images/back.png' alt='Retour ' class="imageButton"></a>
<?php
	//print_r($data);
	/*foreach($data['traces'] as $trace){
		echo "<p>";
		if($trace["statut"]!="OK"){
			echo "<span class='texteReussite'>";
		}else{
			echo "<span class='texteEchec'>";
		}
		echo $trace['statut']."</span> ".$trace['action']." ".$trace['table']."<p>";
	}*/
?>