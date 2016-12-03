
var currentEvent = false;

var incomingEventRight = 0;
var incomingEventLeft = 0;

function resetCss(element){
	element.removeAttr('style');
}

function responsiveAdapter(){
	resetCss($('#carousel_ul'));
}

function moveRight() {
	var item_width = $('#carousel_ul li').outerWidth();  

	var left_indent = parseInt($('#carousel_ul').css('left')) - item_width;
	console.log(parseInt($('#carousel_ul').css('left')));
	var vw_left_indent = parseInt(Math.round(left_indent / document.documentElement.clientWidth * 50) *2);
	$('#carousel_ul').animate({'left' : vw_left_indent + 'vw'},{queue:false, duration:500, complete: function(){
		$('#carousel_ul li:last').after($('#carousel_ul li:first'));
		responsiveAdapter();
		resetCss($('#carousel_ul li:last'));
		resetCss($('#carousel_container'));
		currentEvent = false;
		if(incomingEventRight>0){
			currentEvent = true;
			incomingEventRight--;
			moveRight();
		}
	}});
	
}

function moveLeft(){
    var item_width = $('#carousel_ul li').outerWidth();  

    var left_indent = parseInt($('#carousel_ul').css('left')) + item_width;
    console.log(parseInt($('#carousel_ul').css('left')));
    var vw_left_indent = parseInt(Math.round(left_indent / document.documentElement.clientWidth * 50) * 2);
    $('#carousel_ul').animate({'left' : vw_left_indent + 'vw'},{queue:false, duration:500, complete: function(){
		$('#carousel_ul li:first').before($('#carousel_ul li:last'));
		responsiveAdapter();
		resetCss($('#carousel_ul li:first'));
		resetCss($('#carousel_container'));
		currentEvent = false;
		if(incomingEventLeft>0){
			currentEvent = true;
			incomingEventLeft--;
			moveLeft();
		}
	}});  
	
}

function prepareRight(){
	if(!currentEvent){
		currentEvent = true;
		moveRight();
	} else{
		if(incomingEventRight <= 2){
			incomingEventRight += 1;
		}
	}
}

function prepareLeft(){
	if(!currentEvent){
		currentEvent = true;
		moveLeft();
	} else{
		if(incomingEventLeft <= 2){
			incomingEventLeft += 1;
		}
	}
}

$(document).ready(function() {
	$('#right_scroll').click(function(){
		prepareRight();
	});

	$('#left_scroll').click(function(){
		prepareLeft();
	});

	var route = $_GET('r');

	if(route == 'insert'){
		insert();
	}
	$("body").keydown(function(e) {
		if(e.keyCode == 37){
			prepareLeft();
		}
		if(e.keyCode == 39){
			prepareRight();
		}
	});

	window.onresize = function() {
		responsiveAdapter();
	};
	header();
});



function header(){
	//si changement de route pour les lien
	var home = "./?r=site/index";
	var devis = "./";
	var maj = "./";
	var rdv = "./";
	var add = "./?r=insert/viewInsert";
	var del = "./";
	var upd = "./";


	$('#menuButton').click(function(){
		if($('#reglagesDiv').length>0){
			$('#reglagesDiv').remove();
		}
		if($('#menuDiv').length<=0){
			var div = $("<div id='menuDiv'/>");

			var ul = $("<ul id='menuUl'/>");

			ul.append("<li class='menu'><a href='"+home+"'>Accueil</a></li>");
			ul.append("<li class='menu'><a href='"+devis+"'>Devis</a></li>");

			$.ajax({
				url : './controller/IsConnectedController.php',
				type : 'GET',
				dataType : 'json',
				success : function(json){
					if(json >= 1){
						ul.append("<li class='menu'><a href='"+maj+"''>Mise à jour</a></li>");
						ul.append("<li class='menu'><a href='"+rdv+"''>Rendez-vous</a></li>");
						ul.append("<li class='menu'><a href='"+add+"'>Ajouter</a></li>");
						ul.append("<li class='menu'><a href='"+del+"'>Supprimer</a></li>");
						ul.append("<li class='menu'><a href='"+upd+"'>Modifier</a></li>");
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
	$('#reglagesButton').click(function(){
		if($('#menuDiv').length>0){
			$('#menuDiv').remove();
		}
		if($('#reglagesDiv').length<=0){
			var div = $("<div id='reglagesDiv'/>");

			var ul = $("<ul id='reglagesUl'/>");
			$.ajax({
				url : './controller/IsConnectedController.php',
				type : 'GET',
				dataType : 'json',
				success : function(json){
					console.log(json);
					if(json >= 2){
						ul.append("<li class='menu'><a href='"+'./?r=site/index'+"''>Administrateur</a></li>");
						if(json >= 3){
							ul.append("<li class='menu'><a href='"+'/?r=site/index'+"''>Super-administrateur</a></li>");
						}
					}else{
						ul.append("<li class='menu'><a href='"+'./?r=connexion/formConnexion'+"''>Se connecter</a></li>");
					}
				},
				error : function(){
					console.log('erreur');
				} 
			})
			div.append(ul);
			$('nav').after(div);

			if ($(window).height() < $(window).width()){
				$('#reglagesDiv').animate({width: "300px"}, 500).css('display', 'block');
			}else{
				$('#reglagesDiv').animate({top:0},1000,function () {
								        $('#line').css({
								            bottom: '100%',
								            top: 'auto'
								        });
								    })
							.css('display', 'block');
			}
		}else{
			$('#reglagesDiv').remove();
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
