
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

<<<<<<< HEAD
	var route = $_GET('r');

	if(route == 'insert'){
		insert();
	}
=======
	$("body").keydown(function(e) {
		if(e.keyCode == 37)
			prepareLeft();
		if(e.keyCode == 39)
			prepareRight();
	});

	window.onresize = function() {
		responsiveAdapter();
	};
  });
	header();
>>>>>>> 7053fdbb8d0a49db0b2c25daf1567a29889f3de4
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
<<<<<<< HEAD



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
=======
>>>>>>> 7053fdbb8d0a49db0b2c25daf1567a29889f3de4
