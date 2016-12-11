$(document).ready(function() {

	var route = $_GET('r');

	if(route == 'insert'){
		insert();
	}
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
	var diapo = "./?r=Diapo/view_diapo";


	$('#menuButton').click(function(){
		if($('#reglagesDiv').length>0){
			$('#reglagesDiv').remove();
		}
		if($('#menuDiv').length<=0){
			var div = $("<div id='menuDiv'/>");

			var ul = $("<ul id='menuUl'/>");

			ul.append("<a href='"+home+"' class='lien'><li class='menu'>Accueil</li></a>");
			ul.append("<a href='"+diapo+"' class='lien'><li class='menu'>Diapo</li></a>");
			//ul.append("<a href='"+devis+"' class='lien'><li class='menu'>Devis</li></a>");

			$.ajax({
				url : './controller/IsConnectedController.php',
				type : 'GET',
				dataType : 'json',
				async: false,
				success : function(json){
					if(json >= 1){
						ul.append("<a href='"+maj+"' class='lien'><li class='menu'>Mise à jour</li></a>");
						ul.append("<a href='"+rdv+"'' class='lien'><li class='menu'>Rendez-vous</li></a>");
						ul.append("<a href='"+add+"' class='lien'><li class='menu'>Ajouter</li></a>");
						ul.append("<a href='"+del+"' class='lien'><li class='menu'>Supprimer</li></a>");
						ul.append("<a href='"+upd+"' class='lien'><li class='menu'>Modifier</li></a>");
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
						ul.append("<a href='"+'./?r=connexion/formConnexion'+"' class='lien'><li class='menu'>Se connecter</li></a>");
					}else{
						if(json >= 2){
							ul.append("<a href='"+'./?r=administration/creerCompte'+"' class='lien'><li class='menu'>Créer un Compte</li></a>");
						}
						ul.append("<a href='"+'./?r=connexion/deconnexion'+"' class='lien'><li class='menu'>Se déconnecter</li></a>");
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
