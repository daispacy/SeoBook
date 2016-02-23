// building select nav for mobile width only

var productcache ='';
$(function(){
	var toTop = jQuery('.footer-to-top');
	toTop.click(function(e){
		e.preventDefault();
		jQuery('html, body').animate({
			 scrollTop: 0
		 }, 500);
		 return false;
	});
	
	 
	checkShow();
	jQuery(window).scroll(function(){
		checkShow();
	});
	function checkShow() {
		if(jQuery(window).scrollTop() > 10) {
			toTop.fadeIn();
		} else {
			toTop.fadeOut();
		}
	}

});

// building select nav for mobile width only
$(function(){
	
	// building h6 item to toggle the main nav menu
	$('<h6 class="open_nav">Nav Items</h6>').appendTo('#mainNav nav');

	$('#mainNav nav h6').click(
		function(){
			$('#mainNav nav > ul').slideToggle(150);
		}
	);

});
//end


/*============= cart content slide effect =================*/
$(function(){
	$('.cart').hover(
		function(){
			$(this).children('div.cart_content').fadeIn(50);
		},
		function(){
			$(this).children('div.cart_content').slideUp(160);
		}
	);
});

/*============= Sign-in content slide effect =================*/
$(function(){
	$('.btn-sign-in').hover(
		function(){
			$(this).children('div.sign-in').fadeIn(160);
		},
		function(){
			$(this).children('div.sign-in').fadeOut(160);
		}
	);
});





/*========== Nivo Banner =============*/
$(function(){
	$(window).load(function() {
        $('#slider').nivoSlider();
    });
});

/*========== Vertical Menu =============*/
$(function(){
   	$('#mega-1').dcVerticalMegaMenu({
		rowItems: '3',
		speed: 'fast',
		effect: 'show',
		direction: 'right'
	});
	$('#mega-1.hide').hide(0);
});

/*======= end it ===========*/
$(function(){
	$('.leftcol .left-menu').hover(
		function(){
			$('#mega-1.hide').slideDown(160);
		},
		function(){
			/*if(($('#mega-1.hide').is(":hover")) == false)
			{$('#mega-1.hide').slideUp(160);}*/
		}
	);
});

$(function(){
	$('#mega-1.hide').mouseleave(
		function(){
			$('#mega-1').slideUp(160);
		}
	);
});




/*============= Order-check content slide effect =================*/
$(function(){
	$('.btn-order-check').hover(
		function(){
			$(this).children('div.order-check').fadeIn(160);
		},
		function(){
			$(this).children('div.order-check').fadeOut(160);
		}
	);
});

$(function(){
	$('.btn-support-info').hover(
		function(){
			$(this).children('div.support-info').fadeIn(160);
		},
		function(){
			$(this).children('div.support-info').fadeOut(160);
		}
	);
});

/*===================== sub menu slide ===============*/
$(function(){
	$('nav ul li').hover(
		function () {
			// hide the css default behavir
			$(this).children('ul.submenu').css('display', 'none');
			//show its submenu
			$(this).children('ul.submenu').slideDown(150);
			$(this).children('div.dropdown_3columns').slideDown(150);
		}, 
		function () {
			//hide its submenu
			$(this).children('ul.submenu').slideUp(150);	
			$(this).children('div.dropdown_3columns').slideUp(150);		
		}
	);
});




/*========= dropkick plugin for select form =============*/
$(function(){
	$(".default").dropkick();
});
/*======== end it ==========*/

/*============ delete item from dropdown cart ========*/
$(function(){
	$('.cart div.cart_content ul li').find('a.remove_item').click(        
        
		function(e){
        var tem = $(this).attr('id');
            id = tem.split('-');
            $.ajax({url:"http://maramara.vn/ajax.php?op=delete_cart&id="+id[1]+"&ssid="+$("#ssid").val()+"&sid="+$("#sid").val(),success:function(result1){
            	if(result1.length>0){
            	   var tem = result1.split('|');
                   $("#grandtotal").html(tem[0]);   
                   $("#grandtotal1").html(tem[0]);   
                   $("#numberproduct").html(tem[1]);              
            	}
            	      	                    
        }});
			e.preventDefault();
			$(this).parents('li')
			.animate({ "opacity": "hide" }, "slow");
		}
	);
});
/*======= end it =========*/

/*============ delete item from shopping cart table (cart.html)  ========*/
$(function(){
	$('table.cart_table tbody td').find('a.delete_item').click(
		function(e){
			e.preventDefault();
			if(confirm("Are you sure?")){
				$(this).parents('tr')
				.animate({ "opacity": "hide" }, "slow");
			}
		}
	);
});
/*======= end it =========*/


/*============== home page accrdain ==============*/
$(function(){
	
	$(".home_news h3").eq(2).addClass("active");
	$(".home_news div").hide();
	$(".home_news div").eq(2).show();
	
	$(".home_news h3").click(function(){
		$(this).next("div").slideToggle("fast").siblings("div:visible").slideUp("fast");
		$(this).toggleClass("active");
		$(this).siblings("h3").removeClass("active");
	});

});
/*=========== end it ===========*/



/*========== end them ==============*/



/*============== product page two accrdain ==============*/
$(function(){
	
	$(".product_info h6").eq(0).addClass("active");
	$(".product_info div.acc").hide();
	$(".product_info div.acc").eq(0).show();
	
	$(".product_info h6").click(function(){
		$(this).next("div.acc").slideToggle("fast").siblings("div:visible").slideUp("fast");
		$(this).toggleClass("active");
		$(this).siblings("h6").removeClass("active");
	});

});
/*=========== end it ===========*/


/*============== product page two accrdain ==============*/
$(function(){
	
	$(".product_review h6").eq(0).addClass("active");
	$(".product_review div.acc").hide();
	$(".product_review div.acc").eq(0).show();
	
	$(".product_review h6").click(function(){
		$(this).next("div.acc").slideToggle("fast").siblings("div:visible").slideUp("fast");
		$(this).toggleClass("active");
		$(this).siblings("h6").removeClass("active");
	});

});
/*=========== end it ===========*/




/*====== end it ======*/


/*====== end it ======*/

/*======= Testimonial Tab in about page ==========*/
$(function(){
	$('#testimonial #tab_outer ul li a').click(function(e){
		e.preventDefault();
		$('#testimonial #tab_outer div').hide();
		$('#testimonial #tab_outer ul li').removeClass('currentTestimonial');
		$('#testimonial #tab_outer div').filter(this.hash).fadeIn(400);
		$(this).parent('li').addClass('currentTestimonial');
	}).filter(':first').click();
});
/*============== end it =============*/


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


/*===================== tabs in cart.html page ==================*/
$(function(){
	var tabDivs = $('div.cart_tabs div.cart_tabs_content > div');

	tabDivs.hide().filter(':first').show();
	$('div.cart_tabs ul.cart_tabs_nav li a').on('click', function(e){
		e.preventDefault();
		tabDivs.hide();
		tabDivs.filter(this.hash).fadeIn(300);
		$('div.cart_tabs ul.cart_tabs_nav li a').removeClass('active_tab');
		$(this).addClass('active_tab');

	});
});
/*========= end it =========*/



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



/*========= tabs in blog and post and Product page ==========*/
$(function(){
	var tabDivs = $('#tabs #tabContentOuter > div');

	tabDivs.hide().filter(':first').show();
	$('#tabs ul.tabNav li a').on('click', function(e){
		e.preventDefault();
		tabDivs.hide();
		tabDivs.filter(this.hash).fadeIn(300);
		$('#tabs ul.tabNav li a').removeClass('currentTab');
		$(this).addClass('currentTab');

	});
});
/*=========== end them ============*/
$(document).ready(function() {
	menuCategory();
	productavatar();
	initDatepicker();
	zTabs();
	menuReponsive();
	LoginFacebook();
	initProductDetail();});
function menuReponsive() {$('nav#menu').mmenu();}
function menuCategory() {
	
	var currentItem = null;
	//show on init 
	jQuery('.category-inner li.active ul').show();
	jQuery('.category-inner li a').click(function(e){
		var item = jQuery(this);
		if(jQuery(item.next()).length > 0) {
			e.preventDefault();
			jQuery(item.next()).slideToggle(function(){
				item.parent().toggleClass('active');
			});
			if(!jQuery(item.parent()).hasClass('active')) {
				jQuery(item.parent().parent()).find('.active:eq(0) ul').slideToggle(function(){
					jQuery(this).parent().toggleClass('active');
				});
			}
		}
		

	});
	jQuery('.category-title.show-mobile').click(function(e){
		jQuery('.category-inner.show-mobile').slideToggle(function(){
				jQuery('.category-title.show-mobile').toggleClass('active');
			});
		
	});
	}
function initDatepicker() {
	var position = $( "#datepicker" ).position();
	 $( "#datepicker" ).datepicker({
		 minDate: 1,dateFormat: 'dd/mm/yy',
    beforeShow: function (input, inst) {
        setTimeout(function () {
            inst.dpDiv.css({
                top: (position.top + 110) + 'px',
                left: (position.left + 75) + 'px'
            });
        }, 0);
    }
});
	}
function productavatar() {
	$('.img').hover(
		function(){
			if ($(this).find('div.product-slider').length >0 && $( window ).width()>767)
			{if(productcache == '')
			{productcache = $(this).html();}
			 $(this).find('a').hide(0);
			 $(this).find('.product-slider').nivoSlider(
			{
			 effect: 'fold,fade',
			 pauseTime: 1000,
			 pauseOnHover: false,
			 animSpeed: 500,
			 directionNav: false,
			 controlNav: false,
			 }
			);
			 $(this).find('div.product-slider').fadeIn(500);
			}
		},
		function(){
			if(productcache != '')
			{$(this).empty().append(productcache);}
			productcache = '';
		}
);
	}
function initProductDetail() {
	$('#sliderProduct').nivoSlider({
			 effect: 'fade'
			 });
    var container = jQuery('#list-pro-thumb');
    var prev = container.find('.btn-up a');
    var next = container.find('.btn-down a');
    var slideObj = jQuery(container).find('div.lstContent > ul');
    var arrThumbs = slideObj.find('a');
	var _HEIGHT = 117;
	var colorContainer = jQuery('.color-list');
	var colorList = jQuery(colorContainer).find('.list');
	var colorAvatar = colorList.find('a');
	colorAvatar.each(function(i, color) {
		 jQuery(color).bind('click', function(e) {
			 
			jQuery(colorList).find('.active').removeClass('active');
            jQuery(color).parent().addClass('active');
			});
    });
    productSlider(prev, next, slideObj, arrThumbs, _HEIGHT, 3, false);
	
    var images = new Array();
    var current = 0;
    arrThumbs.each(function(i, thumb) {
        images.push([jQuery(thumb).attr('data-src'), jQuery(thumb).attr('title')]);
        jQuery(thumb).bind('click', function(e) {
			jQuery(container).find('div.lstContent > ul > .current').removeClass('current');
            jQuery(thumb).parent().addClass('current');
			current = i;
            loadVisual(jQuery(thumb).attr('href'), jQuery(thumb).attr('data-src'));
            return false;
        });
    });

    function loadVisual(src, srcLarge) {
		jQuery('.zoom-product').removeData('jqzoom');
        jQuery('.zoom-product').attr('href', srcLarge);
        jQuery('.zoom-product img').attr('src', src);
        jQuery('.zoom a').attr('href', srcLarge);
		jQuery('.zoom-product').jqzoom({
			zoomWidth: 410,
            zoomHeight: 500,
            xOffset :100,
			preloadImages: false,
			title: false,
            zoomType: 'standard',
			position: 'right',
        });
        jQuery('.zoom-product').click(function(e) {
            e.preventDefault();
			
        });
        $('.zoom-product').trigger('zoom.destroy'); // remove zoom

        
    }
    jQuery(arrThumbs[0]).trigger('click');
}

function zTabs(){
	var tabs = jQuery('.tabContainer');
	if(tabs.length > 0) {
		tabs.each(function(index, tab){
			tab = jQuery(tab);
			tab.toggles = tab.find('.tabToggle > li a');
			tab.conents = tab.find('.tabContent');
			
			tab.toggles.each(function(i, toggle){
				toggle = jQuery(toggle);
				toggle.unbind().bind('click', function(e){
					e.preventDefault();
					tab.toggles.removeClass('active');
					jQuery(tab.toggles[i]).addClass('active');
					tab.conents.addClass('tab-hidden');
					jQuery(tab.conents[i]).removeClass('tab-hidden');
					return false;
				});
				if(toggle.hasClass('active')) {
					toggle.trigger('click');
				}
			});

			if(tab.parent().hasClass('comment-res-detail ')) {
				tab.toggles.each(function(i, toggle){
					toggle = jQuery(toggle);
					toggle.unbind().bind('mouseenter', function(){
						tab.toggles.removeClass('active');
						jQuery(tab.toggles[i]).addClass('active');
						tab.conents.addClass('tab-hidden');
						jQuery(tab.conents[i]).removeClass('tab-hidden');
					});
				});	
			}
			
		});
	}
	
	/*Tab for mobile*/
	jQuery('.tabToggle-mobile').on('click', function(e){
		e.preventDefault();
		jQuery(this).find('a').toggleClass('active');
		jQuery(this).next().slideToggle();
		return false;
	});
}

function productSlider(prev, next, slideObj, arrImgs, _HEIGHT, _LENGTH, auto) {

    var isClick = true;
    var currentIndex = 0;
    var currentText = 0;
    var _opacity = 0.4;
    var timeDuration = 500;
    var timeDelay = 3000;

    if (arrImgs.length <= _LENGTH) {
        prev.css({
            opacity: _opacity,
            cursor: 'default'
        });
        next.css({
            opacity: _opacity,
            cursor: 'default'
        });
    }
    if (arrImgs.length < _LENGTH) {
        slideObj.css({
            'height': arrImgs.length * _HEIGHT
        });
        return;
    }
    if (arrImgs.length <= 1) return;
    prev.bind("click", function(evt) {
        showProduct(currentImage - 1);
        clearTimeout(timeDelay);
        return false;
    });

    next.bind("click", function(evt) {
        showProduct(currentImage + 1);
        clearTimeout(timeDelay);
        return false;
    });

    var isMoving = false;
    var currentImage = 0;

    function showProduct(index) {
        if (!auto) {
            if (isMoving) {
                return;
            }
            isMoving = true;
            if (index > 0) {
                prev.css({
                    opacity: 1,
                    cursor: 'pointer'
                });
            } else {
                prev.css({
                    opacity: _opacity,
                    cursor: 'default'
                });
            }
            if (index <= arrImgs.length - (_LENGTH + 1)) {
                next.css({
                    opacity: 1,
                    cursor: 'pointer'
                });
            } else {
                next.css({
                    opacity: _opacity,
                    cursor: 'default'
                });
            }
        } else {
            if (index < 0) {
                showProduct(arrImgs.length - 1);
                return false;
            } else if (index > arrImgs.length - 1) {
                showProduct(0);
                return false;
            }
        }
        if (index < 0) {
            currentImage = 0;
            slideObj.stop().animate({
                "margin-top": 0
            }, timeDuration, function() {
                isMoving = false;
            });
        } else if (index < arrImgs.length - (_LENGTH - 1)) {
            currentImage = index;
            slideObj.stop().animate({
                "margin-top": -currentImage * _HEIGHT
            }, timeDuration, function() {
                isMoving = false;

            });
        } else {
            currentImage = arrImgs.length - _LENGTH;
            slideObj.stop().animate({
                "margin-top": -(arrImgs.length - _LENGTH) * _HEIGHT
            }, timeDuration, function() {
                isMoving = false;
            });
        }
    }
    showProduct(0);
    if (auto) {
        timeDelay = setInterval(function() {
            showProduct(currentImage + _LENGTH);
        }, timeDelay);
    }
}

/*============= Product Search =================*/
function search(kw)
{
    var form = $('<form>');
    form.attr('action', 'http://maramara.vn/search.html');
    form.attr('method', 'POST');    

    var addParam = function(paramName, paramValue){
        var input = $('<input type="hidden">');
        input.attr({ 'id':     paramName,
                     'name':   paramName,
                     'value':  paramValue });
        form.append(input);
    };

    
    addParam('act', 'search');
    addParam('kw', kw);    
        

    // Submit the form, then remove it from the page
    form.appendTo(document.body);
    form.submit();
    form.remove();
}
/*============= Product Search Alpha =================*/
function search1(kw)
{
    var form = $('<form>');
    form.attr('action', 'http://maramara.vn/search.html');
    form.attr('method', 'POST');    

    var addParam = function(paramName, paramValue){
        var input = $('<input type="hidden">');
        input.attr({ 'id':     paramName,
                     'name':   paramName,
                     'value':  paramValue });
        form.append(input);
    };

    
    addParam('act', 'search');
    addParam('alpha', kw);    
        

    // Submit the form, then remove it from the page
    form.appendTo(document.body);
    form.submit();
    form.remove();
}
/*============= Product Order =================*/
function order(id)
{
    var form = $('<form>');
    form.attr('action', '');
    form.attr('method', 'POST');    

    var addParam = function(paramName, paramValue){
        var input = $('<input type="hidden">');
        input.attr({
                     'name':   paramName,
                     'value':  paramValue });
        form.append(input);
    };

    addParam('act', 'cart');
    addParam('plus', 'addItem');
    addParam('pId', id);  
    addParam('size', $("#size").val());  
    addParam('quantity', $("#quantity").val()); 
    addParam('color', $("#color").val()); 
        

    // Submit the form, then remove it from the page
    form.appendTo(document.body);
    form.submit();
    form.remove();
}
/*============= orerstep 2 =================*/
function orderstep2()
{
    var form = $('<form>');
    form.attr('action', '/order.html');
    form.attr('method', 'POST');    

    var addParam = function(paramName, paramValue){
        var input = $('<input type="hidden">');
        input.attr({
                     'name':   paramName,
                     'value':  paramValue });
        form.append(input);
    };

    addParam('act', 'orderstep2');
    // Submit the form, then remove it from the page
    form.appendTo(document.body);
    form.submit();
    form.remove();
}
/*============= orerstep 2 =================*/
function orderstep3()
{
    var form = $('<form>');
    form.attr('action', '/order.html');
    form.attr('method', 'POST');    

    var addParam = function(paramName, paramValue){
        var input = $('<input type="hidden">');
        input.attr({
                     'name':   paramName,
                     'value':  paramValue });
        form.append(input);
    };

    addParam('act', 'order');
    addParam('plus', 'paymentOrder');
    
    // Submit the form, then remove it from the page
    form.appendTo(document.body);
    form.submit();
    form.remove();
}
/*==============Delete cart item =============*/
function delete_order(id)
{
    var form = $('<form>');
    form.attr('action', '');
    form.attr('method', 'POST');    

    var addParam = function(paramName, paramValue){
        var input = $('<input type="hidden">');
        input.attr({
                     'name':   paramName,
                     'value':  paramValue });
        form.append(input);
    };

    addParam('act', 'cart');
    addParam('plus', 'deleteItem');
    addParam('id', id);  
    // Submit the form, then remove it from the page
    form.appendTo(document.body);
    form.submit();
    form.remove();
}

function LoginFacebook() {
 $('#login_Facebook').click(function(e){
    e.preventDefault();
 var APP_ID_FB = 254272471399192;
 if(APP_ID_FB ==''){
 alert('Chức năng đang cập nhật');
 }else{
 window.location='https://www.facebook.com/dialog/oauth?client_id=254272471399192&redirect_uri=http://www.maramara.vn/loginfb.html&scope=email,user_birthday';
 }
 });
}