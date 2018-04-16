function setCookie(cname, cvalue, exdays) {
  var d = new Date();
  d.setTime(d.getTime() + (exdays*24*60*60*1000));
  var expires = "expires="+d.toUTCString();
  document.cookie = cname + "=" + cvalue + ";" + expires + ";path=/";
}

function getCookie(cname) {
  var name = cname + "=";
  var ca = document.cookie.split(';');
  for(var i = 0; i < ca.length; i++) {
    var c = ca[i];
    while (c.charAt(0) == ' ') {
      c = c.substring(1);
    }
    if (c.indexOf(name) == 0) {
      return c.substring(name.length, c.length);
    }
  }
  return "";
}

jQuery(document).ready(function($){
	$('#homepage-slider ul').lightSlider({
		item:1,
		slideMargin:0,
		loop:true, 
		pager: true,
		auto: true,	
		pause: 5000,
		speed: 500,
		mode: "fade",
		enableTouch: false,
		enableDrag: true,
		controls: true,
		currentPagerPosition: 'middle',
    onBeforeStart: function (el) {$('#homepage-slider').removeClass('cs-hidden');},
    onSliderLoad: function (el) {
     $( ".slider-inner #content img, .slider-inner #content p" ).fadeIn();
   },
   onBeforeSlide: function (el) {
   },
   onAfterSlide: function (el) {
     $( ".slider-inner #content img, .slider-inner #content p" ).fadeIn();
   },
   onBeforeNextSlide: function (el) {
     $( ".slider-inner #content img, .slider-inner #content p" ).hide();        	
   },
   onBeforePrevSlide: function (el) {
     $( ".slider-inner #content img, .slider-inner #content p" ).hide();  
   },	

   responsive : [
   {
    breakpoint:540,
    settings: {
      enableTouch: true,
      controls: false,
      pager: false
    }
  }
  ]	

});
  $(".icon").click(function () {
    if($(this).hasClass('fixed')){
     $(this).removeClass('fixed');
     $('html').removeClass('noscroll');
     $('body').on('scroll mousewheel touchstart touchmove');
   } else {
     $(this).addClass('fixed');
     $('html').addClass('noscroll');
     $('body').off('scroll mousewheel touchstart touchmove');
   }
   function stopScrolling (e) {
    e.preventDefault();
    e.stopPropagation();
    return true;
  }
  $(".mobilenav").fadeToggle(500);
  $(".top-menu").toggleClass("top-animate");
  $("body").toggleClass("noscroll");
  $(".mid-menu").toggleClass("mid-animate");
  $(".bottom-menu").toggleClass("bottom-animate");
});

  $('.menu-toggle-mobile').click(function(e){
    $(".site-navigation-wrapper").animate({"top": "0", "opacity":"1"}, 600);          
    e.preventDefault();
  });

  $('.menu-close-mobile').click(function(e){
    $(".site-navigation-wrapper").animate({"top": "-100%", "opacity":"0"}, 600);
    e.preventDefault();
  });


  $(".menu-item-has-children").each(function(){
    $(this).append( "<span class='toggle-sub-menu'></span>" )
    $(this).find(".toggle-sub-menu").click(function(){
      $(this).toggleClass("active");
      $(this).closest(".menu-item-has-children").find(".sub-menu").slideToggle(400);
    });
  });    

  $('.faq-list .accordion-btn').click(function(e){
    e.preventDefault();
    if($(this).hasClass('enabled')){
      $(this).removeClass('enabled');
    } else {
      $('.accordion-btn').removeClass('enabled');
      $(this).addClass('enabled');
    }
    $('.accordion-content:visible').slideToggle(400);
    $(this).next('.accordion-content:hidden').slideToggle(400);
  });    

  
  $(window).scroll(function() {
      //sticky header
      var navbar = $('#site-header').offset().top + $('#site-header').height();
      var scrolldown = $(window).scrollTop();
      if(navbar < scrolldown){
        if(!$('.header-wrapper').hasClass('fixedtop')){
          $('.header-wrapper').addClass('fixedtop');
        } 
      }else if(navbar>= scrolldown && $(window).width() > 767){
        if($('.header-wrapper').hasClass('fixedtop')){
          $('.header-wrapper').removeClass('fixedtop');
        }
      }else if(navbar>= scrolldown && $(window).width() < 767){
        if($('.header-wrapper').hasClass('fixedtop')){
          $('.header-wrapper').removeClass('fixedtop');
        }
      }    

      //go top button
      if ($(this).scrollTop() > 100) {
        $('#scrollup').fadeIn();
      } else {
        $('#scrollup').fadeOut();
      }
    });
  $('#scrollup').click(function (e) {
    $("html, body").animate({
      scrollTop: 0
    }, 600);
    return false;
    e.preventDefault();
  });

  $('#grid-view').on("click",function(){
    setCookie('view','grid-view');
    $('.archive .product').removeClass('list-view');
    $('.archive .products').hide();
    $('.archive .products').fadeIn();
    $(this).addClass('active');
    $('#list-view').removeClass('active');
  });
  
  $('#list-view').on("click",function(){
    setCookie('view','list-view');
    $('.archive .product').addClass('list-view');
    $('.archive .products').hide();
    $('.archive .products').fadeIn();
    $(this).addClass('active');
    $('#grid-view').removeClass('active');  
  });
});

