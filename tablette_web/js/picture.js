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