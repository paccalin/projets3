$('#ajouter').click(function(){
	
	var options = $("span").html();
	
	$('#divOptions').prepend("<span class='spanOptions'>"+options+"</span>");
});

$('#constructeurs').change(function(){
	var constructeur = $("#constructeurs option:selected").text();
		
	$("#modeles option").css('display', 'none');
	
	$('.'+constructeur).css('display', 'block');
});