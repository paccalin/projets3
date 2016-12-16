$(document).ready(function() {

	var route = $_GET('r');

	if(route == 'insert'){
		insert();
	}
	header();
});

function header(){
	$('#menuButton').click(function(){
		$('#menuDiv').toggleClass("cache");
		if($('#menuDiv').hasClass("cache")){
			//$('#menuDiv').animate({right: "0px"}, 250);
		}else{
			//$('#menuDiv').animate({right: "-300px"}, 250);
		}
	});
}

function $_GET(param) {
	var vars = {};
	window.location.href.replace( location.hash, '' ).replace( 
		/[?&]+([^=&]+)=?([^&]*)?/gi, // regexp
		function( m, key, value ) { // callback
			vars[key] = value !== undefined ? value : '';
		}
	);

	if ( param ) {
		return vars[param] ? vars[param] : null;	
	}
	return vars;
}
