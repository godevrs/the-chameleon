jQuery(document).ready(function() {
	
	/*-------------------------------------------------*/
   /* =  preloader
   /*-------------------------------------------------*/
  	jQuery(window).load(function() { 
	    jQuery("body").removeClass('hidden');
	 });
	
		
	//SEARCH INPUT
	jQuery('input#s').each(function(){
		jQuery(this).attr('placeholder','Search...');
	});
	
	//comment form
	jQuery('#author').attr('placeholder', 'Name');
	jQuery('#email').attr('placeholder', 'Email');
	jQuery('#url').attr('placeholder', 'Website');
	jQuery('#comment').attr('placeholder', 'Comment');
			
	//RESPONSIVE MENU REDIRECT
	jQuery('.responsive-menu select').change(function() {			
		var url = jQuery(this).val();			
		window.location.href = url;				
	});
	
	

	jQuery( "li.menu-item-has-children" ).append('<i class="fa fa-chevron-down"  style="position:absolute; right:0; top:50%; transform:translate(0, -50%);"aria-hidden="true"></i>');
	
	
	
	
	//responsiv menu
	jQuery( ".widget_nav_menu .widget-content" ).prepend('<i class="fa fa-bars fa-2x responsive-menu-icon"></i>');
		
		
	//main menu
	jQuery( ".standard-menu" ).prepend('<i class="fa fa-bars fa-2x responsive-menu-icon"></i>');	
		
	//main menu
	jQuery('.standard-menu .responsive-menu-icon').click(function() {	
		jQuery( ".standard-menu ul.menu" ).toggle();
		return false;				
	});
		
		
	//responsiv menu upper
	jQuery('#upper .responsive-menu-icon').click(function() {	
		jQuery( "#upper .widget_nav_menu ul.menu" ).toggle();
		return false;				
	});

	//responsiv menu header
	jQuery('#header .responsive-menu-icon').click(function() {	
		jQuery( "#header .widget_nav_menu ul.menu" ).toggle();
		return false;				
	});

	//responsiv menu top
	jQuery('#top .responsive-menu-icon').click(function() {	
		jQuery( "#top .widget_nav_menu ul.menu" ).toggle();
		return false;				
	});

	//responsiv menu sidebar
	jQuery('#sidebar .responsive-menu-icon').click(function() {	
		jQuery( "#sidebar .widget_nav_menu ul.menu" ).toggle();
		return false;				
	});

	//responsiv menu bottom
	jQuery('#bottom .responsive-menu-icon').click(function() {	
		jQuery( "#bottom .widget_nav_menu ul.menu" ).toggle();
		return false;				
	});

	//responsiv menu footer
	jQuery('#footer .responsive-menu-icon').click(function() {	
		jQuery( "#footer .widget_nav_menu ul.menu" ).toggle();
		return false;				
	});

	//responsiv menu copyright
	jQuery('#copyright .responsive-menu-icon').click(function() {	
		jQuery( "#copyright .widget_nav_menu ul.menu" ).toggle();
		return false;				
	});
	
	//MESSAGE	
	jQuery('.message').click(function() {		
		jQuery(this).hide();
	});


	//Upper 
	if (data.upper_animate!='') {
		 jQuery('.upper .widget').addClass("hidden").viewportChecker({
	       	classToAdd: data.upper_delay + ' '+ data.upper_duration +' animated '+ data.upper_animate,
			classToRemove: 'hidden',
	        offset: 1
	     });
	}
		
	//Header 

	if (data.header_animate!='') {
		 jQuery('.header .widget').addClass("hidden").viewportChecker({
	       	classToAdd: data.header_delay + ' '+ data.header_duration +' animated '+ data.header_animate,
			classToRemove: 'hidden',
	        offset: 1
	     });
	}


	//Menu
	if (data.menu_animate!='') {		
		 jQuery('.primary-menu').addClass("hidden").viewportChecker({
	       	classToAdd: data.menu_delay + ' '+ data.menu_duration +' animated '+ data.menu_animate,
			classToRemove: 'hidden',
	        offset: 1
	     });
	
		 jQuery('.primary-menu_b').addClass("hidden").viewportChecker({
	       	classToAdd: data.menu_delay + ' '+ data.menu_duration +' animated '+ data.menu_animate,
			classToRemove: 'hidden',
	        offset: 1
	     });
	}

			
	//Top 
	if (data.top_animate!='') {
		 jQuery('.top .widget').addClass("hidden").viewportChecker({
	       	classToAdd: data.top_delay + ' '+ data.top_duration +' animated '+ data.top_animate,
			classToRemove: 'hidden',
	        offset: 1
	     });
	}


	//Archive
	if (data.archive_animate!='') {
		 jQuery('.post').addClass("hidden").viewportChecker({
	       	classToAdd: data.archive_delay + ' '+ data.archive_duration +' animated '+ data.archive_animate,
			classToRemove: 'hidden',
	        offset: 100
	     });
	}
	


	if (data.archive_animate!='') {
		 jQuery('.post .widget').addClass("hidden").viewportChecker({
	       	classToAdd: data.archive_delay + ' '+ data.archive_duration +' animated '+ data.archive_animate,
			classToRemove: 'hidden',
	        offset: 1
	     });
	}
	
/*
	if (data.archive_animate!='') {
		 jQuery('#main-content .widget').addClass("hidden").viewportChecker({
	       	classToAdd: data.archive_delay + ' '+ data.archive_duration +' animated '+ data.archive_animate,
			classToRemove: 'hidden',
	        offset: 100
	     });
	}*/

	
	
	
	//Sidebar
	if (data.sidebar_animate!='') {
		jQuery('#sidebar .widget').addClass("hidden").viewportChecker({
	       	classToAdd: data.sidebar_delay + ' '+ data.sidebar_duration +' animated '+ data.sidebar_animate,
			classToRemove: 'hidden',
	         offset: 1
	      });
	}

	//Sidebar Two
	if (data.sidebar_two_animate!='') {
		jQuery('#sidebar-two .widget').addClass("hidden").viewportChecker({
	      	classToAdd: data.sidebar_two_delay + ' '+ data.sidebar_two_delay +' animated '+ data.sidebar_two_animate,
			classToRemove: 'hidden',
	         offset: 1
	      });
	}



	//Bottom
	if (data.bottom_animate!='') {
		 jQuery('.bottom .widget').addClass("hidden").viewportChecker({
	       	classToAdd: data.bottom_delay + ' '+ data.bottom_duration +' animated '+ data.bottom_animate,
			classToRemove: 'hidden',
	        offset: 100
	     });
	}

	//Footer
	if (data.footer_animate!='') {
		 jQuery('.footer .widget').addClass("hidden").viewportChecker({
	       	classToAdd: data.footer_delay + ' '+ data.footer_duration +' animated '+ data.footer_animate,
			classToRemove: 'hidden',
	        offset: 100
	     });
	}

	//Copyright
	if (data.copyright_animate!='') {
		 jQuery('.copyright .widget').addClass("hidden").viewportChecker({
	       	classToAdd: data.copyright_delay + ' '+ data.copyright_duration +' animated '+ data.copyright_animate,
			classToRemove: 'hidden',
			 offset: 1
	     });
	}



	//Page Builder

	//Section 1
	if (data.section_1_animate!='') {
		 jQuery('#page-builder-section-1 .widget').addClass("hidden").viewportChecker({
	       	classToAdd: data.section_1_delay + ' '+ data.section_1_duration +' animated '+ data.section_1_animate,
			classToRemove: 'hidden',
	        offset: 100
	     });
	}

	//Section 2
	if (data.section_2_animate!='') {
		 jQuery('#page-builder-section-2 .widget').addClass("hidden").viewportChecker({
	       	classToAdd: data.section_2_delay + ' '+ data.section_2_duration +' animated '+ data.section_2_animate,
			classToRemove: 'hidden',
	        offset: 100
	     });
	}

	//Section 3
	if (data.section_3_animate!='') {
		 jQuery('#page-builder-section-3 .widget').addClass("hidden").viewportChecker({
	       	classToAdd: data.section_3_delay + ' '+ data.section_3_duration +' animated '+ data.section_3_animate,
			classToRemove: 'hidden',
	        offset: 100
	     });
	}
	
	
	//Section 4
	if (data.section_4_animate!='') {
		 jQuery('#page-builder-section-4 .widget').addClass("hidden").viewportChecker({
	       	classToAdd: data.section_4_delay + ' '+ data.section_4_duration +' animated '+ data.section_4_animate,
			classToRemove: 'hidden',
	        offset: 100
	     });
	}
	
	//Section 5
	if (data.section_5_animate!='') {
		 jQuery('#page-builder-section-5 .widget').addClass("hidden").viewportChecker({
	       	classToAdd: data.section_5_delay + ' '+ data.section_5_duration +' animated '+ data.section_5_animate,
			classToRemove: 'hidden',
	        offset: 100
	     });
	}
	
	//Section 6
	if (data.section_6_animate!='') {
		 jQuery('#page-builder-section-6 .widget').addClass('hidden').viewportChecker({
	       	classToAdd: data.section_6_delay + ' '+ data.section_6_duration +' animated '+ data.section_6_animate,
			classToRemove: 'hidden',
	        offset: 100
	     });
	}	
	
	//Section 7
	if (data.section_7_animate!='') {
		 jQuery('#page-builder-section-7 .widget').addClass('hidden').viewportChecker({
	       	classToAdd: data.section_7_delay + ' '+ data.section_7_duration +' animated '+ data.section_7_animate,
			classToRemove: 'hidden',
	        offset: 100
	     });
	}	
	
	//Section 8
	if (data.section_8_animate!='') {
		 jQuery('#page-builder-section-8 .widget').addClass('hidden').viewportChecker({
	       	classToAdd: data.section_8_delay + ' '+ data.section_8_duration +' animated '+ data.section_8_animate,
			classToRemove: 'hidden',
	        offset: 100
	     });
	}	
	
	//Section 9
	if (data.section_9_animate!='') {
		 jQuery('#page-builder-section-9 .widget').addClass('hidden').viewportChecker({
	       	classToAdd: data.section_9_delay + ' '+ data.section_9_duration +' animated '+ data.section_9_animate,
			classToRemove: 'hidden',
	        offset: 100
	     });
	}	
	
	//Section 10
	if (data.section_10_animate!='') {
		 jQuery('#page-builder-section-10 .widget').addClass('hidden').viewportChecker({
	       	classToAdd: data.section_10_delay + ' '+ data.section_10_duration +' animated '+ data.section_10_animate,
			classToRemove: 'hidden',
	        offset: 100
	     });
	}	
	
	//Section 11
	if (data.section_11_animate!='') {
		 jQuery('#page-builder-section-11 .widget').addClass('hidden').viewportChecker({
	       	classToAdd: data.section_11_delay + ' '+ data.section_11_duration +' animated '+ data.section_11_animate,
			classToRemove: 'hidden',
	        offset: 100
	     });
	}	
	
	//Section 12
	if (data.section_12_animate!='') {
		 jQuery('#page-builder-section-12 .widget').addClass('hidden').viewportChecker({
	       	classToAdd: data.section_12_delay + ' '+ data.section_12_duration +' animated '+ data.section_12_animate,
			classToRemove: 'hidden',
	        offset: 100
	     });
	}	
	
	//Section 13
	if (data.section_13_animate!='') {
		 jQuery('#page-builder-section-13 .widget').addClass('hidden').viewportChecker({
	       	classToAdd: data.section_13_delay + ' '+ data.section_13_duration +' animated '+ data.section_13_animate,
			classToRemove: 'hidden',
	        offset: 100
	     });
	}	
	
	//Section 14
	if (data.section_14_animate!='') {
		 jQuery('#page-builder-section-14 .widget').addClass('hidden').viewportChecker({
	       	classToAdd: data.section_14_delay + ' '+ data.section_14_duration +' animated '+ data.section_14_animate,
			classToRemove: 'hidden',
	        offset: 100
	     });
	}	
	
	//Section 15
	if (data.section_15_animate!='') {
		 jQuery('#page-builder-section-15 .widget').addClass('hidden').viewportChecker({
	       	classToAdd: data.section_15_delay + ' '+ data.section_15_duration +' animated '+ data.section_15_animate,
			classToRemove: 'hidden',
	        offset: 100
	     });
	}	
	
	//Section 16
	if (data.section_16_animate!='') {
		 jQuery('#page-builder-section-16 .widget').addClass('hidden').viewportChecker({
	       	classToAdd: data.section_16_delay + ' '+ data.section_16_duration +' animated '+ data.section_16_animate,
			classToRemove: 'hidden',
	        offset: 100
	     });
	}	
	
	//Section 17
	if (data.section_17_animate!='') {
		 jQuery('#page-builder-section-17 .widget').addClass('hidden').viewportChecker({
	       	classToAdd: data.section_17_delay + ' '+ data.section_17_duration +' animated '+ data.section_17_animate,
			classToRemove: 'hidden',
	        offset: 100
	     });
	}	
	
	//Section 18
	if (data.section_18_animate!='') {
		 jQuery('#page-builder-section-18 .widget').addClass('hidden').viewportChecker({
	       	classToAdd: data.section_18_delay + ' '+ data.section_18_duration +' animated '+ data.section_18_animate,
			classToRemove: 'hidden',
	        offset: 100
	     });
	}	
	
	//Section 19
	if (data.section_19_animate!='') {
		 jQuery('#page-builder-section-19 .widget').addClass('hidden').viewportChecker({
	       	classToAdd: data.section_19_delay + ' '+ data.section_19_duration +' animated '+ data.section_19_animate,
			classToRemove: 'hidden',
	        offset: 100
	     });
	}	
	
	//Section 20
	if (data.section_20_animate!='') {
		 jQuery('#page-builder-section-20 .widget').addClass('hidden').viewportChecker({
	       	classToAdd: data.section_20_delay + ' '+ data.section_20_duration +' animated '+ data.section_20_animate,
			classToRemove: 'hidden',
	        offset: 100
	     });
	}


	
});
