var nombreId = '';

$('#ajouter').click(function(){
	
	var options = $("#option").html();
	
	$('#divOptions').prepend("<span class='spanOptions'><select id='option"+nombreId+"' class='input'>"+options+"</select></span>");
});

$('#constructeurs').change(function(){
	var constructeur = $("#constructeurs option:selected").text();
		
	$("#modeles option").css('display', 'none');
	
	$('.'+constructeur).css('display', 'block');
});

/*
$('#rechercher').click(function(){
	
});
*/