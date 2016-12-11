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
	responsiveAdapter();
	header();
});



function header(){
	//si changement de route pour les lien
	var home = "./?r=site/index";
	var devis = "./?r=devis/show";
	var maj = "./?r=site/aFaire";
	var rdv = "./?r=site/aFaire";
	var add = "./?r=insert/viewInsert";
	var del = "./?r=site/aFaire";
	var upd = "./?r=site/aFaire";


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
				async: false,
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
				$('#contenu').animate({top: (80+ul[0].childElementCount*26)+"px"}, 350);
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
			$('#contenu').animate({top: "80px"}, 350);
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
				async: false,
				success : function(json){
					if(json == 0){
						ul.append("<li class='menu'><a href='"+'./?r=connexion/formConnexion'+"''>Se connecter</a></li>");
					}else{
						if(json >= 2){
							ul.append("<li class='menu'><a href='"+'./?r=administration/creerCompte'+"''>Créer un Compte</a></li>");
						}
						ul.append("<li class='menu'><a href='"+'./?r=connexion/deconnexion'+"''>Se déconnecter</a></li>");
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
				$('#contenu').animate({top: (80+ul[0].childElementCount*26)+"px"}, 350);
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
			$('#contenu').animate({top: "80px"}, 350);
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
