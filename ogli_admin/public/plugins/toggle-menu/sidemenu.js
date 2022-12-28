(function () {
	"use strict";

	var slideMenu = $('.side-menu');
	$('.app').addClass('sidebar-mini');
	
	// Toggle Sidebar
	$(document).on("click", "[data-toggle='sidebar']", function(event) {
		event.preventDefault();
		$('.app').toggleClass('sidenav-toggled');
	});
	 
	if ( $(window).width() > 739) {     
		$('.app-sidebar').on("mouseover", function(event) {
			event.preventDefault();
			$('.app').removeClass('sidenav-toggled');
		});
	}
	
	// Activate sidebar slide toggle
	$(document).on("click", "[data-toggle='slide']", function(event) {
		event.preventDefault();
		if(!$(this).parent().hasClass('is-expanded')) {
			slideMenu.find("[data-toggle='slide']").parent().removeClass('is-expanded');
		}
		$(this).parent().toggleClass('is-expanded');
	});

	// Set initial active toggle
	$("[data-toggle='slide.'].is-expanded").parent().toggleClass('is-expanded');


	// Activate sidebar slide toggle
	$(document).on("click", "[data-toggle='subslide']", function(event) {
		event.preventDefault();
		//alert($(this).parent().parent().parent().attr('class'));
		
		// var submenuname = slideMenu.find(".submenu").attr('id');
		// alert(submenuname);
		if(!$(this).parent().parent().parent().hasClass('is-expanded')) {
			//alert('in if');
			slideMenu.find("[data-toggle='subslide']").parent().parent().parent().removeClass('is-expanded');
			if($(this).find(".submenu").css( "display", "block" )) {
				//alert('in any if');
				slideMenu.find(".submenu").css( "display", "block" );
				$(this).parent().parent().parent().toggleClass('is-expanded');
			}else{
				//alert('in else');
				slideMenu.find(".submenu").css( "display", "none" );
			}
				//slideMenu.find(".submenu").css( "display", "block" );
			
		}
		//$(this).parent().parent().parent().toggleClass('is-expanded');
	});

	// Set initial active toggle
	//$("[data-toggle='subslide.'].is-expanded").parent().parent().parent().toggleClass('is-expanded');

	//Activate bootstrip tooltips
	$("[data-toggle='tooltip']").tooltip();

})();
