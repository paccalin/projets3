$(document).ready(function() {

	window.onresize = function() {
		imgFitter()
	};
	imgFitter()
});

$('#constructeur').change(function(){
	adaptModel();
});

$("form :input").change(function() {
	refresh();
});

$('#searchtxt').bind('input', function() {
    refresh();
} );

function adaptModel(){
	var constructeur = $("#constructeur option:selected").text();
	if($("#constructeur option:selected").attr('class') != -1){
		$("#modele option").css('display', 'none');
		$('.'+constructeur).css('display', 'block');
		$('.-1').css('display', 'block');
		$("#modele").get(0).selectedIndex = 0;
	}
	else{
		var curIndex = $("select[name='CCards'] option:selected").index();
	}
}

function refresh(){
	var url = "ajaxHandler.php?r=searchVehicle";
	$.ajax({
		type: "POST",
		url: url,
		data: $("#globalSearch").serialize(), // serializes the form's elements.
		success: showVehicles,
		dataType: 'html'
    });
}

function showVehicles(data){
	$(".mosaicContainer:first").html(data);
	imgFitter();
}