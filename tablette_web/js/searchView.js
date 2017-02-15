$(document).ready(function() {

	window.onresize = function() {
		imgFitter()
	};
	imgFitter()
});

$('#constructeur').change(function(){
	var constructeur = $("#constructeur option:selected").text();
	$("#modele option").css('display', 'none');
	$('.'+constructeur).css('display', 'block');
	$("#modele").val($('.'+constructeur).first().val());
	refresh();
});

function refresh(){
	$.ajax({
		url : "ajaxHandler.php?r=searchVehicle",
		type : 'GET',
		success : showVehicles,
		dataType : 'html'
	});
}

function showVehicles(data){
	$(".mosaicContainer:first").html(data);
	imgFitter();
}