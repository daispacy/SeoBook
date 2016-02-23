$(document).ready(function() { 
    if (/android|iphone|ipod|series60|symbian|windows ce|blackberry/i.test(navigator.userAgent)){			
            if($('#ex1').length) $('#ex1').zoom();
            $('#image-tooltip').html('');
    }else{
        stickytooltip("*[data-tooltip]", "image-tooltip");
    }
    
    //$(".col4 a").click(function(evt){evt.preventDefault();});
    
	// Drop Down Menu
	$('ul#main-menu').superfish({ 
        delay:       600,
        animation:   {opacity:'show',height:'show'},
        speed:       'fast',
        autoArrows:  true,
        dropShadows: false
    });

	// Accordion
	$( ".accordion" ).accordion( { autoHeight: false } );

	// Toggle
	$( ".toggle > .inner" ).hide();
	$(".toggle .title").toggle(function(){
		$(this).addClass("active").closest('.toggle').find('.inner').slideDown(200, 'easeOutCirc');
	}, function () {
		$(this).removeClass("active").closest('.toggle').find('.inner').slideUp(200, 'easeOutCirc');
	});

	// Tabs
	$(function() {
		$( "#tabs" ).tabs();
	});
	
	// Gallery Hover Effect
	jQuery(".gallery-item .gallery-thumbnail .zoom-wrapper").hover(function(){		
		jQuery(this).animate({ opacity: 1 }, 300);
	}, function(){
		jQuery(this).animate({ opacity: 0 }, 300);
	});
	
	// PrettyPhoto
	$(document).ready(function(){
		$("a[rel^='prettyPhoto']").prettyPhoto();
	});
	
	// Slides Loader
	$(".slider").removeClass("slide-loader");
	$(".slider-single").removeClass("slide-loader-single");
	
	// Mobile Menu

	// Create the dropdown base
	$("<select />").appendTo("#main-menu-wrapper");
      
	// Create default option "Go to..."
	$("<option />", {
		"selected": "selected",
		"value"   : "",
		"text"    : "Go to..."
	}).appendTo("#main-menu-wrapper select");
      
	// Populate dropdown with menu items
	$("#main-menu a").each(function() {
		var el = $(this);
		$("<option />", {
			"value"   : el.attr("href"),
			"text"    : el.text()
		}).appendTo("#main-menu-wrapper select");
	});
	
	// To make dropdown actually work
	$("#main-menu-wrapper select").change(function() {
		window.location = $(this).find("option:selected").val();
	});

	// Quantity Buttons
	$(function() {

		$("form .qty-text").before('<input type="button" class="plusminus minus" id="minus1" value="-">');
		$("form .qty-text").after('<input type="button" class="plusminus plus" id="plus1" value="+">');

		$(".plusminus").click(function() {
			var $button = $(this);
			var oldValue = $button.parent().find(".qty-text").val();
			
			if ($button.val() == "+") {
				var newVal = parseFloat(oldValue) + 1;
			} 
			
			else {		
				if (oldValue > 1) {
					var newVal = parseFloat(oldValue) - 1;
				}
				
				else {
					var newVal = 1;
				}
			}
	
			$button.parent().find(".qty-text").val(newVal);
	
	    });

	});
	
});

// Slider
$(window).load(function(){
  $('.slider').flexslider({
    animation: "slide",
	controlNav: false
  });
});

$(window).load(function(){
  $('.slider-single').flexslider({
    animation: "slide",
	controlNav: true,
	directionNav: false
  });
});
/*!
	Slimbox v2.05 
*/
(function(w){var E=w(window),u,f,F=-1,n,x,D,v,y,L,r,m=!window.XMLHttpRequest,s=[],l=document.documentElement,k={},t=new Image(),J=new Image(),H,a,g,p,I,d,G,c,A,K;w(function(){w("body").append(w([H=w('<div id="lbOverlay" />').click(C)[0],a=w('<div id="lbCenter" />')[0],G=w('<div id="lbBottomContainer" />')[0]]).css("display","none"));g=w('<div id="lbImage" />').appendTo(a).append(p=w('<div style="position: relative;" />').append([I=w('<a id="lbPrevLink" href="#" />').click(B)[0],d=w('<a id="lbNextLink" href="#" />').click(e)[0]])[0])[0];c=w('<div id="lbBottom" />').appendTo(G).append([w('<a id="lbCloseLink" href="#" />').click(C)[0],A=w('<div id="lbCaption" />')[0],K=w('<div id="lbNumber" />')[0],w('<div style="clear: both;" />')[0]])[0]});w.slimbox=function(O,N,M){u=w.extend({loop:false,overlayOpacity:0.8,overlayFadeDuration:400,resizeDuration:400,resizeEasing:"swing",initialWidth:250,initialHeight:250,imageFadeDuration:400,captionAnimationDuration:400,counterText:"Image {x} of {y}",closeKeys:[27,88,67],previousKeys:[37,80],nextKeys:[39,78]},M);if(typeof O=="string"){O=[[O,N]];N=0}y=E.scrollTop()+(E.height()/2);L=u.initialWidth;r=u.initialHeight;w(a).css({top:Math.max(0,y-(r/2)),width:L,height:r,marginLeft:-L/2}).show();v=m||(H.currentStyle&&(H.currentStyle.position!="fixed"));if(v){H.style.position="absolute"}w(H).css("opacity",u.overlayOpacity).fadeIn(u.overlayFadeDuration);z();j(1);f=O;u.loop=u.loop&&(f.length>1);return b(N)};w.fn.slimbox=function(M,P,O){P=P||function(Q){return[Q.href,Q.title]};O=O||function(){return true};var N=this;return N.unbind("click").click(function(){var S=this,U=0,T,Q=0,R;T=w.grep(N,function(W,V){return O.call(S,W,V)});for(R=T.length;Q<R;++Q){if(T[Q]==S){U=Q}T[Q]=P(T[Q],Q)}return w.slimbox(T,U,M)})};function z(){var N=E.scrollLeft(),M=E.width();w([a,G]).css("left",N+(M/2));if(v){w(H).css({left:N,top:E.scrollTop(),width:M,height:E.height()})}}function j(M){if(M){w("object").add(m?"select":"embed").each(function(O,P){s[O]=[P,P.style.visibility];P.style.visibility="hidden"})}else{w.each(s,function(O,P){P[0].style.visibility=P[1]});s=[]}var N=M?"bind":"unbind";E[N]("scroll resize",z);w(document)[N]("keydown",o)}function o(O){var N=O.which,M=w.inArray;return(M(N,u.closeKeys)>=0)?C():(M(N,u.nextKeys)>=0)?e():(M(N,u.previousKeys)>=0)?B():null}function B(){return b(x)}function e(){return b(D)}function b(M){if(M>=0){F=M;n=f[F][0];x=(F||(u.loop?f.length:0))-1;D=((F+1)%f.length)||(u.loop?0:-1);q();a.className="lbLoading";k=new Image();k.onload=i;k.src=n}return false}function i(){a.className="";w(g).css({backgroundImage:"url("+n+")",visibility:"hidden",display:""});w(p).width(k.width);w([p,I,d]).height(k.height);w(A).html(f[F][1]||"");w(K).html((((f.length>1)&&u.counterText)||"").replace(/{x}/,F+1).replace(/{y}/,f.length));if(x>=0){t.src=f[x][0]}if(D>=0){J.src=f[D][0]}L=g.offsetWidth;r=g.offsetHeight;var M=Math.max(0,y-(r/2));if(a.offsetHeight!=r){w(a).animate({height:r,top:M},u.resizeDuration,u.resizeEasing)}if(a.offsetWidth!=L){w(a).animate({width:L,marginLeft:-L/2},u.resizeDuration,u.resizeEasing)}w(a).queue(function(){w(G).css({width:L,top:M+r,marginLeft:-L/2,visibility:"hidden",display:""});w(g).css({display:"none",visibility:"",opacity:""}).fadeIn(u.imageFadeDuration,h)})}function h(){if(x>=0){w(I).show()}if(D>=0){w(d).show()}w(c).css("marginTop",-c.offsetHeight).animate({marginTop:0},u.captionAnimationDuration);G.style.visibility=""}function q(){k.onload=null;k.src=t.src=J.src=n;w([a,g,c]).stop(true);w([I,d,g,G]).hide()}function C(){if(F>=0){q();F=x=D=-1;w(a).hide();w(H).stop().fadeOut(u.overlayFadeDuration,j)}return false}})(jQuery);
if (!/android|iphone|ipod|series60|symbian|windows ce|blackberry/i.test(navigator.userAgent)) {
	jQuery(function($) {
		$("a[rel^='lightbox']").slimbox({/* Put custom options here */}, null, function(el) {
			return (this == el) || ((this.rel.length > 8) && (this.rel == el.rel));
		});
	});
}
//tooltip
function stickytooltip(selector, tooltipID){
		var stickytooltip={
			tooltipoffsets: [20, -30], //additional x and y offset from mouse cursor for tooltips
			fadeinspeed: 200, //duration of fade effect in milliseconds
			rightclickstick: true, //sticky tooltip when user right clicks over the triggering element (apart from pressing "s" key) ?
			stickybordercolors: ["black", "darkred"], //border color of tooltip depending on sticky state
			stickynotice1: ["Press \"s\"", "or right click", "to sticky box"], //customize tooltip status message
			stickynotice2: "Click outside this box to hide it", //customize tooltip status message

			//***** NO NEED TO EDIT BEYOND HERE

			isdocked: false,

			positiontooltip:function($, $tooltip, e){
				var x=e.pageX+this.tooltipoffsets[0], y=e.pageY+this.tooltipoffsets[1]
				var tipw=$tooltip.outerWidth(), tiph=$tooltip.outerHeight(), 
				x=(x+tipw>$(document).scrollLeft()+$(window).width())? x-tipw-(stickytooltip.tooltipoffsets[0]*2) : x
				y=(y+tiph>$(document).scrollTop()+$(window).height())? $(document).scrollTop()+$(window).height()-tiph-10 : y
				$tooltip.css({left:x, top:y})
			},
			
			showbox:function($, $tooltip, e){
				$tooltip.fadeIn(this.fadeinspeed)
				this.positiontooltip($, $tooltip, e)
			},

			hidebox:function($, $tooltip){
				if (!this.isdocked){
					$tooltip.stop(false, true).hide()
					$tooltip.css({borderColor:'black'}).find('.stickystatus:eq(0)').css({background:this.stickybordercolors[0]}).html(this.stickynotice1)
				}
			},

			docktooltip:function($, $tooltip, e){
				this.isdocked=true
				$tooltip.css({borderColor:'darkred'}).find('.stickystatus:eq(0)').css({background:this.stickybordercolors[1]}).html(this.stickynotice2)
			},


			init:function(targetselector, tipid){
				jQuery(document).ready(function($){
					var $targets=$(targetselector)
					var $tooltip=$('#'+tipid).appendTo(document.body)
					if ($targets.length==0)
						return
					var $alltips=$tooltip.find('div.atip')
					if (!stickytooltip.rightclickstick)
						stickytooltip.stickynotice1[1]=''
					stickytooltip.stickynotice1=stickytooltip.stickynotice1.join(' ')
					stickytooltip.hidebox($, $tooltip)
					$targets.bind('mouseenter', function(e){
						$alltips.hide().filter('#'+$(this).attr('data-tooltip')).show()
						stickytooltip.showbox($, $tooltip, e)
					})
					$targets.bind('mouseleave', function(e){
						stickytooltip.hidebox($, $tooltip)
					})
					$targets.bind('mousemove', function(e){
						if (!stickytooltip.isdocked){
							stickytooltip.positiontooltip($, $tooltip, e)
						}
					})
					$tooltip.bind("mouseenter", function(){
						stickytooltip.hidebox($, $tooltip)
					})
					$tooltip.bind("click", function(e){
						e.stopPropagation()
					})
					$(this).bind("click", function(e){
						if (e.button==0){
							stickytooltip.isdocked=false
							stickytooltip.hidebox($, $tooltip)
						}
					})
					$(this).bind("contextmenu", function(e){
						if (stickytooltip.rightclickstick && $(e.target).parents().andSelf().filter(targetselector).length==1){ //if oncontextmenu over a target element
							stickytooltip.docktooltip($, $tooltip, e)
							return false
						}
					})
					$(this).bind('keypress', function(e){
						var keyunicode=e.charCode || e.keyCode
						if (keyunicode==115){ //if "s" key was pressed
							stickytooltip.docktooltip($, $tooltip, e)
						}
					})
				}) //end dom ready
			}
		}
		stickytooltip.init(selector, tooltipID)
	}
