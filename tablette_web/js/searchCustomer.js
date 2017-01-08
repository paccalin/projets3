var nombreId = 1;

$('#ajouter').click(function(){
	var options = $("#option1").html();
	nombreId+=1;
	$('#labelOption').after("<select id='option"+nombreId+"' class='input'>"+options+"</select><span class='inputSpacer'></span>");
	//Ajouter une ligne display:none l'option déjà sélectionnée (on peut pas installer 2x la même option)
	
});

$('#constructeur').change(function(){
	var constructeur = $("#constructeur option:selected").text();
	$("#modele option").css('display', 'none');
	$('.'+constructeur).css('display', 'block');
	//Ajouter une ligne qui déselectionne le modèle sélectionné
});

/*
$('#filtrer').click(function(){
	
});
*/
