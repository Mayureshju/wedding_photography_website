"use strict";function mainmenu(){$(".main-menu li.dropdown ul").length&&($(".main-menu li.dropdown").append('<div class="dropdown-btn"></div>'),$(".main-menu li.dropdown .dropdown-btn").on("click",function(){$(this).prev("ul").slideToggle(500)}))}function languageSwitcher(){$("#polyglot-language-options").length&&$("#polyglotLanguageSwitcher").polyglotLanguageSwitcher({effect:"slide",animSpeed:500,testMode:!0,onChange:function(e){alert("The selected language is: "+e.selectedItem)}})}function stickyHeader(){if($(".stricky").length){$(window).scrollTop()>100?($(".stricky").addClass("stricky-fixed"),$(".scroll-to-top").fadeIn(1500)):$(this).scrollTop()<=100&&($(".stricky").removeClass("stricky-fixed"),$(".scroll-to-top").fadeOut(1500))}}function headerStyle(){if($(".header-upper-style1").length){var e=$(window).scrollTop(),t=$(".header-upper-style1"),a=$(".fixed-header .sticky-header"),o=$(".scroll-to-top-style2");e>50?(t.addClass("fixed-header"),a.addClass("animated slideInDown"),o.fadeIn(300)):(t.removeClass("fixed-header"),a.removeClass("animated slideInDown"),o.fadeOut(300))}}function scrollToTop(){$(".scroll-to-target").length&&$(".scroll-to-target").on("click",function(){var e=$(this).attr("data-target");$("html, body").animate({scrollTop:$(e).offset().top},1e3)})}function searchbox(){$(".seach-toggle").length&&$(".seach-toggle").on("click",function(){$(this).toggleClass("active"),$(this).next(".search-box").toggleClass("now-visible")})}function prealoader(){$(".preloader").length&&$(".preloader").delay(.3).fadeOut(.3)}function CounterNumberChanger(){var e=$(".timer");e.length&&e.appear(function(){e.countTo()})}function singleProductTab(){$(".tabs-box").length&&$(".tabs-box .tab-buttons .tab-btn").on("click",function(e){e.preventDefault();var t=$($(this).attr("data-tab"));if($(t).is(":visible"))return!1;t.parents(".tabs-box").find(".tab-buttons").find(".tab-btn").removeClass("active-btn"),$(this).addClass("active-btn"),t.parents(".tabs-box").find(".tabs-content").find(".tab").fadeOut(0),t.parents(".tabs-box").find(".tabs-content").find(".tab").removeClass("active-tab"),$(t).fadeIn(300),$(t).addClass("active-tab")})}function priceFilter(){$(".price-ranger").length&&($(".price-ranger #slider-range").slider({range:!0,min:10,max:200,values:[11,99],slide:function(e,t){$(".price-ranger .ranger-min-max-block .min").val("$"+t.values[0]),$(".price-ranger .ranger-min-max-block .max").val("$"+t.values[1])}}),$(".price-ranger .ranger-min-max-block .min").val("$"+$(".price-ranger #slider-range").slider("values",0)),$(".price-ranger .ranger-min-max-block .max").val("$"+$(".price-ranger #slider-range").slider("values",1)))}function accordion(){$(".accordion-box").length&&$(".accordion-box").on("click",".accord-btn",function(){!0!==$(this).hasClass("active")&&$(".accordion .accord-btn").removeClass("active"),$(this).next(".accord-content").is(":visible")?($(this).removeClass("active"),$(this).next(".accord-content").slideUp(500)):($(this).addClass("active"),$(".accordion .accord-content").slideUp(500),$(this).next(".accord-content").slideDown(500))})}function cartTouchSpin(){$(".quantity-spinner").length&&$("input.quantity-spinner").TouchSpin({verticalbuttons:!0})}function datepicker(){$("#datepicker").length&&$("#datepicker").datepicker()}function timepicker(){$('input[name="time"]').length&&$('input[name="time"]').ptTimeSelect()}function tooltip(){$(".tool_tip").length&&$(".tool_tip").tooltip(),$}function projectMasonaryLayout(){($(".masonary-layout").length&&$(".masonary-layout").isotope({layoutMode:"masonry"}),$(".post-filter").length&&$(".post-filter li").children(".filter-text").on("click",function(){var e=$(this),t=e.parent().attr("data-filter");return $(".post-filter li").removeClass("active"),e.parent().addClass("active"),$(".filter-layout").isotope({filter:t,animationOptions:{duration:500,easing:"linear",queue:!1}}),!1}),$(".post-filter.has-dynamic-filters-counter").length)&&$(".post-filter.has-dynamic-filters-counter").find("li").each(function(){var e=$(this).data("filter"),t=$(".filter-layout").find(e).length;$(this).children(".filter-text").append('<span class="count">'+t+"</span>")})}function countryInfo(){$(".area_select").length&&$(".area_select").change(function(){var e=$(this).val();e?($(".state:not(#value"+e+")").slideUp(),$("#value"+e).slideDown()):$(".state").slideDown()})}function selectDropdown(){if($(".selectmenu").length){$(".selectmenu").selectmenu();$(".selectmenu").selectmenu({change:function(e,t){$(this).trigger("change",t)}})}}function countDownTimer(){$(".time-countdown").length&&$(".time-countdown").each(function(){var e=$(this),t=e.data("countdown-time");e.countdown(t,function(e){$(this).html("<h2>"+e.strftime("%D : %H : %M : %S")+"</h2>")})}),$(".time-countdown-two").length&&$(".time-countdown-two").each(function(){var e=$(this),t=e.data("countdown-time");e.countdown(t,function(e){$(this).html('<li> <div class="box"> <span class="days">'+e.strftime("%D")+'</span> <span class="timeRef">days</span> </div> </li> <li> <div class="box"> <span class="hours">'+e.strftime("%H")+'</span> <span class="timeRef clr-1">hours</span> </div> </li> <li> <div class="box"> <span class="minutes">'+e.strftime("%M")+'</span> <span class="timeRef clr-2">minutes</span> </div> </li> <li> <div class="box"> <span class="seconds">'+e.strftime("%S")+'</span> <span class="timeRef clr-3">seconds</span> </div> </li>')})})}function aboutCarousel(){$(".about-carousel-box").length&&$(".about-carousel-box").owlCarousel({dots:!0,Default:!1,loop:!1,margin:0,nav:!1,navText:['<span class="fa fa-angle-left left"><p>Prev</p></span>','<span class="fa fa-angle-right right"><p>Next</p></span>'],autoplayHoverPause:!1,autoplay:!1,responsive:{0:{items:1},600:{items:1},800:{items:1},1024:{items:1},1100:{items:1},1200:{items:1}}})}function projectCarousel(){$(".project-carousel").length&&$(".project-carousel").owlCarousel({dots:!0,loop:!0,margin:10,nav:!1,navText:['<i class="fa fa-angle-left"></i>','<i class="fa fa-angle-right"></i>'],autoplayHoverPause:!1,autoplay:15e3,smartSpeed:700,responsive:{0:{items:1},600:{items:2},800:{items:3},1024:{items:4},1100:{items:4},1200:{items:5}}})}function brandCarousel(){$(".brand-items-carousel").length&&$(".brand-items-carousel").owlCarousel({dots:!1,loop:!0,margin:30,nav:!0,navText:['<i class="flaticon-back"></i>','<i class="flaticon-arrow"></i>'],autoplayHoverPause:!1,autoplay:6e3,smartSpeed:1e3,responsive:{0:{items:1},600:{items:3},800:{items:4},1024:{items:5},1100:{items:5},1200:{items:6}}})}function brochuresCarousel(){$(".brochures-carousel-box").length&&$(".brochures-carousel-box").owlCarousel({dots:!0,loop:!0,margin:0,nav:!1,navText:['<i class="flaticon-back"></i>','<i class="flaticon-arrow"></i>'],autoplayHoverPause:!1,autoplay:6e3,smartSpeed:1e3,responsive:{0:{items:1},600:{items:1},800:{items:1},1024:{items:1},1100:{items:1},1200:{items:1}}})}function projectCarouselv2(){$(".project-carousel-v2").length&&$(".project-carousel-v2").owlCarousel({dots:!0,loop:!0,margin:10,nav:!1,navText:['<i class="fa fa-angle-left"></i>','<i class="fa fa-angle-right"></i>'],autoplayHoverPause:!1,autoplay:15e3,smartSpeed:700,responsive:{0:{items:1},600:{items:1},800:{items:2},1024:{items:2},1100:{items:3},1200:{items:3}}})}function workingProcessCarousel(){$(".working-process-carousel").length&&$(".working-process-carousel").owlCarousel({dots:!1,loop:!0,margin:30,nav:!0,navText:['<i class="flaticon-back"></i>','<i class="flaticon-arrow"></i>'],autoplayHoverPause:!1,autoplay:6e3,smartSpeed:1e3,responsive:{0:{items:1},600:{items:1},800:{items:1},1024:{items:2},1100:{items:2},1200:{items:3}}})}function testimonialCarousel(){$(".testimonial-carousel").length&&$(".testimonial-carousel").owlCarousel({dots:!0,loop:!0,margin:30,nav:!1,navText:['<i class="flaticon-back"></i>','<i class="flaticon-arrow"></i>'],autoplayHoverPause:!1,autoplay:6e3,smartSpeed:1e3,responsive:{0:{items:1},600:{items:1},800:{items:1},1024:{items:1},1100:{items:1},1200:{items:1}}})}function servicesCarousel(){$(".services-carousel").length&&$(".services-carousel").owlCarousel({dots:!0,loop:!0,margin:30,nav:!1,navText:['<span class="fa fa-angle-left left"><p>Prev</p></span>','<span class="fa fa-angle-right right"><p>Next</p></span>'],autoplayHoverPause:!1,autoplay:6e3,smartSpeed:1e3,responsive:{0:{items:1},600:{items:1},800:{items:1},1024:{items:1},1100:{items:1},1200:{items:1}}})}function projectCarouselv3(){$(".project-carousel-v3").length&&$(".project-carousel-v3").owlCarousel({dots:!1,loop:!0,margin:60,nav:!0,navText:['<i class="flaticon-back"></i>','<i class="flaticon-arrow"></i>'],autoplayHoverPause:!1,autoplay:6e3,smartSpeed:1e3,responsive:{0:{items:1},600:{items:1},800:{items:2},1024:{items:3},1100:{items:3},1200:{items:4}}})}function testimonialCarouselV2(){$(".testimonial-carousel-2").length&&$(".testimonial-carousel-2").owlCarousel({dots:!0,loop:!0,margin:30,nav:!0,navText:['<i class="flaticon-back"></i>','<i class="flaticon-arrow"></i>'],autoplayHoverPause:!1,autoplay:6e3,smartSpeed:1e3,responsive:{0:{items:1},600:{items:1},800:{items:1},1024:{items:1},1100:{items:2},1200:{items:2}}})}function historyCarousel(){$(".history-carousel").length&&$(".history-carousel").owlCarousel({dots:!0,loop:!0,margin:0,nav:!0,navText:['<i class="flaticon-back"></i>','<i class="flaticon-arrow"></i>'],autoplayHoverPause:!1,autoplay:6e3,smartSpeed:1e3,responsive:{0:{items:1},600:{items:1},800:{items:1},1024:{items:1},1100:{items:1},1200:{items:1}}})}if($(".progress-levels .progress-box .bar-fill").length&&$(".progress-box .bar-fill").each(function(){$(".progress-box .bar-fill").appear(function(){var e=$(this).attr("data-percent");$(this).css("width",e+"%")})},{accY:0}),$(".count-box").length&&$(".count-box").appear(function(){var e=$(this),t=e.find(".count-text").attr("data-stop"),a=parseInt(e.find(".count-text").attr("data-speed"),10);e.hasClass("counted")||(e.addClass("counted"),$({countNum:e.find(".count-text").text()}).animate({countNum:t},{duration:a,easing:"linear",step:function(){e.find(".count-text").text(Math.floor(this.countNum))},complete:function(){e.find(".count-text").text(this.countNum)}}))},{accY:0}),$(".hidden-bar").length){var hiddenBar=$(".hidden-bar"),hiddenBarOpener=$(".hidden-bar-opener"),hiddenBarCloser=$(".hidden-bar-closer"),navToggler=$(".nav-toggler");$(".hidden-bar-wrapper").mCustomScrollbar(),hiddenBarOpener.on("click",function(){hiddenBar.toggleClass("visible-sidebar"),navToggler.toggleClass("open")}),hiddenBarCloser.on("click",function(){hiddenBar.toggleClass("visible-sidebar"),navToggler.toggleClass("open")})}if($(".lightbox-image").length&&$(".lightbox-image").fancybox({openEffect:"fade",closeEffect:"fade",youtube:{controls:0,showinfo:0},helpers:{media:{}}}),$(".paroller").length&&$(".paroller").paroller({factor:.05,factorLg:.05,type:"foreground",direction:"horizontal"}),$(".wow").length){var wow=new WOW({boxClass:"wow",animateClass:"animated",offset:0,mobile:!1,live:!0});wow.init()}$("#contact-form").length&&$("#contact-form").validate({submitHandler:function(e){var t=$(e).find('button[type="submit"]');$("#form-result").remove(),t.before('<div id="form-result" class="alert alert-success" role="alert" style="display: none;"></div>');var a=t.html();t.html(t.prop("disabled",!0).data("loading-text")),$(e).ajaxSubmit({dataType:"json",success:function(o){(o.status="true")&&$(e).find(".form-control").val(""),t.prop("disabled",!1).html(a),$("#form-result").html(o.message).fadeIn("slow"),setTimeout(function(){$("#form-result").fadeOut("slow")},6e3)}})}}),$("#add-comment-form").length&&$("#add-comment-form").validate({submitHandler:function(e){var t=$(e).find('button[type="submit"]');$("#form-result").remove(),t.before('<div id="form-result" class="alert alert-success" role="alert" style="display: none;"></div>');var a=t.html();t.html(t.prop("disabled",!0).data("loading-text")),$(e).ajaxSubmit({dataType:"json",success:function(o){(o.status="true")&&$(e).find(".form-control").val(""),t.prop("disabled",!1).html(a),$("#form-result").html(o.message).fadeIn("slow"),setTimeout(function(){$("#form-result").fadeOut("slow")},6e3)}})}}),$("#appoinment-form").length&&$("#appoinment-form").validate({submitHandler:function(e){var t=$(e).find('button[type="submit"]');$("#form-result").remove(),t.before('<div id="form-result" class="alert alert-success" role="alert" style="display: none;"></div>');var a=t.html();t.html(t.prop("disabled",!0).data("loading-text")),$(e).ajaxSubmit({dataType:"json",success:function(o){(o.status="true")&&$(e).find(".form-control").val(""),t.prop("disabled",!1).html(a),$("#form-result").html(o.message).fadeIn("slow"),setTimeout(function(){$("#form-result").fadeOut("slow")},6e3)}})}}),jQuery(document).on("ready",function(){jQuery,mainmenu(),scrollToTop(),languageSwitcher(),searchbox(),CounterNumberChanger(),singleProductTab(),priceFilter(),accordion(),cartTouchSpin(),selectDropdown(),datepicker(),timepicker(),tooltip(),countryInfo(),countDownTimer(),aboutCarousel(),projectCarousel(),brandCarousel(),brochuresCarousel(),projectCarouselv2(),workingProcessCarousel(),testimonialCarousel(),servicesCarousel(),projectCarouselv3(),testimonialCarouselV2(),historyCarousel()}),jQuery(window).on("scroll",function(){jQuery,stickyHeader(),headerStyle()}),jQuery(window).on("load",function(){jQuery,prealoader(),projectMasonaryLayout()}),$(window).enllax();