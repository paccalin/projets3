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