
$(document).ready(function() {

	header();

	var route = $_GET('r');

	if(route == 'insert'){
		insert();
	}
});



function header(){
	//si changement de route pour les lien
	var home = "./";
	var devis = "./";
	var maj = "./";
	var rdv = "./";
	var add = "./";
	var del = "./";
	var upd = "./";


	$('#menuButton').click(function(){

		if($('#menuDiv').length<=0){
			var div = $("<div id='menuDiv'/>");

			var ul = $("<ul id='menuUl'/>");

			ul.append("<li class='menu'><a href='"+home+"'>Home</a></li>");
			ul.append("<li class='menu'><a href='"+devis+"'>devis</a></li>");

			$.ajax({
				url : './controller/IsConnectedController.php',
				type : 'GET',
				dataType : 'json',
				success : function(json){
					if(json == true){
						ul.append("<li class='menu'><a href='"+maj+"''>MAJ</a></li>");
						ul.append("<li class='menu'><a href='"+rdv+"''>rendez-vous</a></li>");
						ul.append("<li class='menu'><a href='"+add+"'>ajouter</a></li>");
						ul.append("<li class='menu'><a href='"+del+"'>supprimer</a></li>");
						ul.append("<li class='menu'><a href='"+upd+"'>modifier</a></li>");
					}
				},
				error : function(){
					console.log('erreur');
				} 
			})






			div.append(ul);
			$('nav').after(div);

			if ($(window).height() < $(window).width()){
				$('#menuDiv').animate({width: "300px"}, 500).css('display', 'block');
			}else{
				$('#menuDiv').animate({top:0},1000,function () {
								        $('#line').css({
								            bottom: '100%',
								            top: 'auto'
								        });
								    })
							.css('display', 'block');
			}


		}else{
			$('#menuDiv').remove();
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