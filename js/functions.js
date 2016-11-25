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
		
	//add icon for open respoinsive menu
	jQuery( "li.menu-item-has-children" ).prepend('<i class="fa fa-chevron-down open-sub-menu"  style="position:absolute; right:0px;" aria-hidden="true"></i>');
		
	//main menu responsvise open
	jQuery('li.main-menu-item .open-sub-menu').click(function() {
		jQuery(this).parent().children("ul.sub-menu").toggle();			
	});

	//widget-menu responsive open
	jQuery('.widget_nav_menu li.menu-item-has-children .open-sub-menu').click(function() {	
		jQuery(this).parent().children("ul.sub-menu").toggle();
	});
	
	//responsiv menu
	jQuery( ".widget_nav_menu .widget-content" ).prepend('<i class="fa fa-bars fa-2x responsive-menu-icon"></i>');
		
	
	//main menu
	jQuery( ".standard-menu" ).prepend('<i class="fa fa-bars fa-2x responsive-menu-icon"></i>');

	//responsiv menu
	jQuery('.responsive-menu-icon').click(function() {
		jQuery(this).parent().children().children( "ul.menu" ).toggle();			
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
	

 	//posts widgets
	if (data.archive_animate!='') {
		 jQuery('.post .widget').addClass("hidden").viewportChecker({
	       	classToAdd: data.archive_delay + ' '+ data.archive_duration +' animated '+ data.archive_animate,
			classToRemove: 'hidden',
	        offset: 1
	     });
	}

		
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




    //Sticky
	if ( jQuery( '.upper').length ) {
	  var upper = jQuery('.upper');
  	  var origOffsetYUpper = upper.offset().top;
	}
	
	if ( jQuery( '.header').length ) {
  	  var header = jQuery('.header');
  	  var origOffsetYHeader = header.offset().top;
	}
    
	if ( jQuery( '.menu-wrap').length ) {
    	var mainMenu = jQuery('.menu-wrap');
    	var origOffsetYMainMenu = mainMenu.offset().top;
    }
    
    //On Scrolle
    function scroll() {
		
	 	if(data.upper_sticky =='1'){
	        if (jQuery(window).scrollTop() > origOffsetYUpper) {
	              jQuery('.upper').addClass('sticky');
	         } else {
	              jQuery('.upper').removeClass('sticky');
	         }
	     }

		if(data.sticky_header =='1'){
	        if (jQuery(window).scrollTop() > origOffsetYHeader) {
	            jQuery('.header').addClass('sticky');
	        } else {
	            jQuery('.header').removeClass('sticky');
	        }
		}	

    
		if(data.primary_menu_sticky =='1'){ 
	        if (jQuery(window).scrollTop() >= origOffsetYMainMenu) {
               jQuery('.menu-wrap').addClass('sticky');
            } else {
               jQuery('.menu-wrap').removeClass('sticky');
           }
		}
       
    }

    document.onscroll = scroll;
		

	
});
