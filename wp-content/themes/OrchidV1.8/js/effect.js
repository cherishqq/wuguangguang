// Nav
$(document).ready(function(){
	$(".nav").superfish();
});

// Add
$(document).ready(function(){
	$(".brand li:nth-child(3n+3)").addClass("no");
	$(".list_fashion li:nth-child(2n+2)").addClass("no");
	$(".list_img_two li:nth-child(2n+2)").addClass("no");
	$(".list_img_three li:nth-child(3n+3)").addClass("no");
	$(".list_shop li:nth-child(3n+3)").addClass("no");
	$(".sidebar .menu li:nth-child(3n+3)").addClass("no");
	$(".sidebar .blogroll li:nth-child(3n+3)").addClass("no");
	$(".widget_categories ul li:nth-child(3n+3)").addClass("no");
	$(".widget_meta ul li:nth-child(3n+3)").addClass("no");
	$(".widget_archive ul li:nth-child(3n+3)").addClass("no");
	$(".widget_pages ul li:nth-child(3n+3)").addClass("no");
	$(".category_store li:nth-child(3n+3)").addClass("no");
	$(".related_post li:nth-child(4n+4)").addClass("no");
	$(".main_right li .title_a").first().addClass("nobg");
	$(".list_img_five li:nth-child(5n+5)").addClass("no");
	$(".list_img_seven li:nth-child(7n+7)").addClass("no");
	$(".list li:nth-child(2n+2)").addClass("no");
	$(".pb_list li:nth-child(3n+3)").addClass("no");
	$(".pb_right ul").last().addClass("last");
});

// Thumbnail
$(document).ready(function(){
	$(".list_img_two li, .list_img_five li").find("a").animate({opacity:0.65});
	$(".list_img_two li, .list_img_five li").hover(function(){
		$(this).find("a").animate({top:0,opacity:0.65},{queue:false,duration:250});
	},function(){
		$(this).find("a").animate({top:120,opacity:0.65},{queue:false,duration:250});
	});
});

$(document).ready(function(){
	$(".list_img_seven li").find("a").animate({opacity:0.65});
	$(".list_img_seven li").hover(function(){
		$(this).find("a").animate({top:0,opacity:0.65},{queue:false,duration:350});
	},function(){
		$(this).find("a").animate({top:300,opacity:0.65},{queue:false,duration:350});
	});
});

$(document).ready(function(){
	$(".pb_list li").find("a").animate({opacity:0.65});
	$(".pb_list li").hover(function(){
		$(this).find("a").animate({top:0,opacity:0.65},{queue:false,duration:250});
	},function(){
		$(this).find("a").animate({top:155,opacity:0.65},{queue:false,duration:250});
	});
});

// Slides
$(document).ready(function(){
	$(".slides").slides({
		play:7000,
		pause:500,
		slideSpeed:1200,
		hoverPause:true,
		animationStart:function(current){
			$(".caption").animate({
				bottom:-90
			},200);
			if(window.console&&console.log){
				console.log("animationStart on slide:",current);
			};
		},animationComplete:function(current){
			$(".caption").animate({
				bottom:0
			},500);
			if(window.console&&console.log){
				console.log("animationComplete on slide:",current);
			};
		},slidesLoaded:function(){
			$(".caption").animate({
				bottom:0
			},200);
		}
	});
});

// Form
$(document).ready(function(){
	$("#commentform :input").focus(function(){
		$(this).addClass("focus");
	}).blur(function(){
		$(this).removeClass("focus");
	});
});

// Tip
$(document).ready(function(){
	$(".brand a, .list_img_three li a, .list_shop .tip, .list_shop a, .grap div a").aToolTip();
});

// Singlepage
$(document).ready(function(){
	$(".singlepage .fl a").html("&laquo; 上一篇文章");
	$(".singlepage .fr a").html("下一篇文章 &raquo;");
});

//Follow
$(document).ready(function(){
	$(".follow a").hover(function(){
		$(this).animate({opacity:0.5},{queue:false,duration:150});
	},function(){
		$(this).animate({opacity:1},{queue:false,duration:150});
	});
});

//Love
$(document).ready(function(){
	$(window).scroll(function(){
		var y=$(this).scrollTop();
		if(y>=152){
			$(".love").addClass("fixed");
		}else{
			$(".love").removeClass("fixed");
		}
	});
});
