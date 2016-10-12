jQuery(document).ready(function() {
	
	//on load page
	var number_of_sections = jQuery('#metanumber_of_sections').val();	
	for (var i=0; i <= 20; i++) {
		if(i <= number_of_sections) {	
			jQuery('#meta_section_'+i+'_wrap').show();
		}else{
			jQuery('#meta_section_'+i+'_wrap').hide();	
		}
	};
	
	jQuery( "#metanumber_of_sections" ).change(function() {		
 	 var number_of_sections_on_change = jQuery('#metanumber_of_sections').val();

		for (var i=0; i <= 20; i++) {
			if(i <= number_of_sections_on_change) {	
				jQuery('#meta_section_'+i+'_wrap').show();
			}else{
				jQuery('#meta_section_'+i+'_wrap').hide();	
			}
		};
	
	});
	
	
	var active_page_builder = jQuery('#active_page_builder').prop('checked');	
	if(jQuery('#active_page_builder').prop('checked')){
		jQuery('#postdivrich').hide();
	}
		
	jQuery( "#active_page_builder:checkbox" ).change(function() {
		if(jQuery('#active_page_builder').prop('checked')){
			jQuery('#postdivrich').hide();
		}else{
			jQuery('#postdivrich').show();
		}
	
	});
	
	
});