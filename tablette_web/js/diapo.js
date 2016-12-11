var currentEvent = false;

var incomingEventRight = 0;
var incomingEventLeft = 0;

function resetCss(element){
	element.removeAttr('style');
}

function imgFitter(){
	$('.diapoImg').each(function(i, item) {
	    var imgHeight = $(item).height();
	    var imgWidth = $(item).width();
	    var divHeight = $(item).parent().height();
	    var divWidth = $(item).parent().width();
	    var imgProp = imgWidth / imgHeight;
	    var divProp = divWidth / divHeight;
	    var marginLeft = 0;
	    var marginTop = 0;

	    if(imgProp < divProp){
	    	imgHeight = divHeight;
	    	imgWidth = imgHeight * imgProp;
	    	marginLeft = (divWidth - imgWidth) / 2;

	    }else if(imgProp > divProp){
	    	imgWidth = divWidth;
	    	imgHeight = imgWidth / imgProp;
	    	marginTop = (divHeight - imgHeight) / 2;
	    }else{
	    	imgWidth = divWidth;
	    	imgHeight = divHeight;
	    }

	    $(item).height(imgHeight + 'px');
		$(item).width(imgWidth + 'px');
	    $(item).css({'margin-left': marginLeft + 'px'});
	    $(item).css({'margin-top': marginTop + 'px'});
	});
}

function syncDiapos(){
	var mainId = parseInt($("#mainCarousel_ul").find( "li:eq(1)" ).attr('class'));
	let bandeWidth = parseInt($("#bandeCarousel_ul").parent().outerWidth());
	let bandeItemWidth = parseInt($("#bandeCarousel_ul li").outerWidth());
	let BandeItemsCount = Math.round(bandeWidth / bandeItemWidth);
	var bandeCenterIndex = (BandeItemsCount + 1) / 2;
	var currBandeId = parseInt($("#bandeCarousel_ul").find( "li:eq("+bandeCenterIndex+")" ).attr('class'));
	while(mainId != currBandeId){
		if(mainId < currBandeId)
			moveLeft("#bandeCarousel_ul", "#bandeImg", 0);
		else
			moveRight("#bandeCarousel_ul", "#bandeImg", 0);
			

		var currBandeId = parseInt($("#bandeCarousel_ul").find( "li:eq("+bandeCenterIndex+")" ).attr('class'));
	}
}

function responsiveAdapter(){
	resetCss($('#mainCarousel_ul'));
	resetCss($('#bandeCarousel_ul'));
	imgFitter();
	syncDiapos();
}

function moveRight(carouselUl, carouselContainer, time) {
	var item_width = $(carouselUl+' li').outerWidth();
	var left_indent = parseInt($(carouselUl).css('left')) - item_width;
	var vw_left_indent = (Math.round(left_indent / document.documentElement.clientWidth * 50) *2);
	$(carouselUl).animate({'left' : vw_left_indent + 'vw'},{queue:false, duration:time, complete: function(){
		$(carouselUl+' li:last').after($(carouselUl+' li:first'));
		console.log($(carouselUl).find("li:eq(0)").outerWidth())
		resetCss($(carouselUl+' li:last'));
		resetCss($(carouselContainer));
		responsiveAdapter();
		currentEvent = false;
	}});
	
}

function moveLeft(carouselUl, carouselContainer, time) {
	var item_width = $(carouselUl+' li').outerWidth();
	var left_indent = parseInt($(carouselUl).css('left')) + item_width;
	var vw_left_indent = parseInt(Math.round(left_indent / document.documentElement.clientWidth * 50) *2);
	$(carouselUl).animate({'left' : vw_left_indent + 'vw'},{queue:false, duration:time, complete: function(){
		$(carouselUl+' li:first').before($(carouselUl+' li:last'));
		responsiveAdapter();
		resetCss($(carouselUl+' li:first'));
		resetCss($(carouselContainer));
		currentEvent = false;
	}});
	
}

function prepareRight(){
	if(!currentEvent){
		currentEvent = true;
		moveRight("#mainCarousel_ul", "#diapo", 500);
		moveRight("#bandeCarousel_ul", "#bandeImg", 500);
	} else{
		if(incomingEventRight <= 2){
			incomingEventRight += 1;
		}
	}
}

function prepareLeft(){
	if(!currentEvent){
		currentEvent = true;
		moveLeft("#mainCarousel_ul", "#diapo", 500);
		moveLeft("#bandeCarousel_ul", "#bandeImg", 500);
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

	window.onresize = function() {
		responsiveAdapter();
	};
	responsiveAdapter();
});