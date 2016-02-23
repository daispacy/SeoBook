$(function(){

	var viewWidth = $(window).width(); 

	if(viewWidth  <= 940 & viewWidth > 768 ) {
		$("div.pro_relates_content").jCarouselLite({
		   btnNext: ".pagers .related_nxt",
		   btnPrev: ".pagers .related_prev",
		   visible: 3
		});

	} else if(viewWidth <= 767 & viewWidth > 479) {
		$("div.pro_relates_content").jCarouselLite({
		   btnNext: ".pagers .related_nxt",
		   btnPrev: ".pagers .related_prev",
		   visible: 2
		});

	} else if(viewWidth <= 479) {
		$("div.pro_relates_content").jCarouselLite({
		   btnNext: ".pagers .related_nxt",
		   btnPrev: ".pagers .related_prev",
		   visible: 1
		});
	} else {
		$("div.pro_relates_content").jCarouselLite({
		   btnNext: ".pagers .related_nxt",
		   btnPrev: ".pagers .related_prev",
		   visible: 4
		});
	}
});
/*=========== end it ===========*/ 


/*================= product images hover effect ===============*/
$(function(){

	$('ul.product_show li').hover(

		function(){
			$(this).children('div.img').children('a').children('img').stop().animate({width:'130%', height:'130%', left:-30, top:-30}, 300);
			$(this).children('div.img').children('div.hover_over').stop().animate({opacity:1},300);
			$(this).find('div.hover_over').children('a.link').stop().animate({'left':'30%'}, 300);
			$(this).find('div.hover_over').children('a.cart').stop().animate({'right':'30%'}, 300);
		},
		function(){
			$(this).children('div.img').children('a').children('img').stop().animate({width:'100%', height:'100%', left:0, top:0}, 300);
			$(this).children('div.img').children('div.hover_over').stop().animate({opacity:0},300);
			$(this).find('div.hover_over').children('a.link').stop().animate({'left':'0'}, 300);
			$(this).find('div.hover_over').children('a.cart').stop().animate({'right':'0'}, 300);
		}

	);

});
/*=========== end it =========*/


/*========== category list =============*/
$(function(){
	$('div.category ul li ul').hide();
	$('div.category ul li:has("ul") a').click(
		function(e){
			e.preventDefault();
			$(this).toggleClass('active');
			$(this).next('ul.nested').slideToggle(400);
		}
	);
});
/*====== end it ======*/





/*========== side panel widget =========*/
// open and hide the side panel
$(function(){
	$('#sideWidget a.WidgetLink').click(function(e){
		e.preventDefault();
		var left = $('#sideWidget').css('left');
		if(left <= '-168px'){
			$("#sideWidget").animate({
				left: 10
			});
		}else{
			$("#sideWidget").animate({
				left: '-168px'
			});
		}
	});
});







/*========== slide the brands in the about page ===========*/
$(function(){
	var viewWidth = $(window).width(); 

	if(viewWidth  <= 940 & viewWidth > 768 ) {
		$("div.brands div.brandOuter").jCarouselLite({
		   btnNext: ".pagers .brand_nxt",
		   btnPrev: ".pagers .brand_prev",
		   visible: 4
		});

	} else if(viewWidth <= 767 & viewWidth > 479) {
		$("div.brands div.brandOuter").jCarouselLite({
		   btnNext: ".pagers .brand_nxt",
		   btnPrev: ".pagers .brand_prev",
		   visible: 3
		});

	} else if(viewWidth <= 479) {
		$("div.brands div.brandOuter").jCarouselLite({
		   btnNext: ".pagers .brand_nxt",
		   btnPrev: ".pagers .brand_prev",
		   visible: 2
		});
	} else {
		$("div.brands div.brandOuter").jCarouselLite({
		   btnNext: ".pagers .brand_nxt",
		   btnPrev: ".pagers .brand_prev",
		   visible: 5
		});
	}
});
/*=========== end it ===========*/



/*========= accordain in checkout.html page ============*/
$(function(){
	$('div.checkout_outer div.checkout_content').hide();
	$('div.checkout_outer h2').click(
		function(){
			$(this).next('div.checkout_content').slideToggle(300);
		}
	);
});
/*=========== end it ============*/






/*==========zommed image with etalage plugin in product page=====*/
$(function(){

	var viewWidth = $(window).width(); 

	if(viewWidth  <= 959 & viewWidth >= 768 ) {
		$('#etalage').etalage({
			thumb_image_width: 445,
			thumb_image_height: 480,
			source_image_width: 900,
			source_image_height: 1200,
			zoom_area_width: 267,
			zoom_area_height: 495,
			zoom_area_distance: 20,
			small_thumbs: 4,
			smallthumb_inactive_opacity: 1,
			smallthumbs_position:'bottom',
			autoplay_interval : 3000,
			right_to_left: true
		});

	} else if(viewWidth <= 767 & viewWidth > 479) {
		$('#etalage').etalage({
			thumb_image_width: 400,
			thumb_image_height: 360,
			source_image_width: 900,
			source_image_height: 1200,
			zoom_area_width: 340,
			zoom_area_height: 495,
			zoom_area_distance: 20,
			small_thumbs: 4,
			smallthumb_inactive_opacity: 1,
			smallthumbs_position:'bottom',
			autoplay_interval : 3000,
			zoom_element: '#zoom',
			right_to_left: true
		});

	} else if(viewWidth <= 479) {
		$('#etalage').etalage({
			thumb_image_width: 290,
			thumb_image_height: 240,
			source_image_width: 900,
			source_image_height: 1200,
			zoom_area_width: 340,
			zoom_area_height: 495,
			zoom_area_distance: 20,
			small_thumbs: 3,
			smallthumb_inactive_opacity: 1,
			smallthumbs_position:'bottom',
			autoplay_interval : 3000,
			zoom_element: '#zoom',
			right_to_left: true
		});
	} else {
		$('#etalage').etalage({
			thumb_image_width: 480,
			thumb_image_height: 480,
			source_image_width: 900,
			source_image_height: 1200,
			zoom_area_width: 340,
			zoom_area_height: 495,
			zoom_area_distance: 20,
			small_thumbs: 6,
			smallthumb_inactive_opacity: 1,
			smallthumbs_position:'left',
			autoplay_interval : 3000,
			right_to_left: true
		});
	}

});
/*============ end it ============*/


/*==========zommed image with etalage plugin in product page=====*/
$(function(){

	var viewWidth = $(window).width(); 

	if(viewWidth  <= 959 & viewWidth > 768 ) {
		$('#etalage_style_two').etalage({
			thumb_image_width: 300,
			thumb_image_height: 330,
			source_image_width: 900,
			source_image_height: 1200,
			zoom_area_width: 220,
			zoom_area_height: 365,
			zoom_area_distance: 20,
			small_thumbs: 4,
			smallthumb_inactive_opacity: 1,
			smallthumbs_position:'bottom',
			autoplay_interval : 3000,
			right_to_left: true
		});

	} else if(viewWidth <= 767 & viewWidth > 479) {
		$('#etalage_style_two').etalage({
			thumb_image_width: 400,
			thumb_image_height: 360,
			source_image_width: 900,
			source_image_height: 1200,
			zoom_area_width: 340,
			zoom_area_height: 495,
			zoom_area_distance: 20,
			small_thumbs: 4,
			smallthumb_inactive_opacity: 1,
			smallthumbs_position:'bottom',
			autoplay_interval : 3000,
			zoom_element: '#zoom',
			right_to_left: true
		});

	} else if(viewWidth <= 479) {
		$('#etalage_style_two').etalage({
			thumb_image_width: 280,
			thumb_image_height: 240,
			source_image_width: 900,
			source_image_height: 1200,
			zoom_area_width: 340,
			zoom_area_height: 495,
			zoom_area_distance: 20,
			small_thumbs: 4,
			smallthumb_inactive_opacity: 1,
			smallthumbs_position:'bottom',
			autoplay_interval : 3000,
			zoom_element: '#zoom',
			right_to_left: true
		});
	} else {
		$('#etalage_style_two').etalage({
			thumb_image_width: 385,
			thumb_image_height: 370,
			source_image_width: 900,
			source_image_height: 1200,
			zoom_area_width: 280,
			zoom_area_height: 485,
			zoom_area_distance: 20,
			small_thumbs: 4,
			smallthumb_inactive_opacity: 1,
			smallthumbs_position:'bottom',
			autoplay_interval : 3000,
			right_to_left: true
		});
	}

});
/*============ end it ============*/

// Invoke the Fancybox plugin when an image is clicked on the etalage plugin
function etalage_click_callback(image_anchor, instance_id){
	$.fancybox({
		href: image_anchor
	});
}