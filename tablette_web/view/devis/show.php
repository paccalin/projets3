
<form action='' method='POST'>

<label for='constructeur'>Constructeur : </label>
<select name='constructeur' id='constructeur' onChange='choix(this.form)'>
	<option value=null>-- choisir --</option>
<?php
	foreach($data['constructeurs'] as $constructeur){
		echo "\t<option value='".$constructeur->libelle."'>".$constructeur->libelle."</option>\n";
	}
?>
</select>

<label for='modele'>Modèle : </label>
<select name='modele' id='modele'>
<option value='null'>-- choisir --</option>

</select>

</form>

<script type='text/javascript' langage="javascript">

function choix(form){
	
	i = $('#constructeur option:selected').val();
	

	$('#modele').empty();
	$('#modele').append("<option value='null'>-- choisir --</option>");
	

	if(i=='null'){
		return;
	}else{
		<?php
			foreach($data['modeles'] as $modele){
			echo "if(i=='".$modele->constructeur->libelle."'){
				$('#modele').append(new Option('".$modele->libelle."', '".$modele->id."'));
				console.log('".$modele->id.", ".$modele->libelle."');
			}";
			}
		?>
		
	}
}

</script>
