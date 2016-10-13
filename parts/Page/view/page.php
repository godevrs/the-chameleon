<?php 
	
	global $TheChameleon; 
	global $TheChameleonOption;
	global $TheChameleonMeta;
	
	$main_wrap = !empty($TheChameleonMeta['main_wrap']) ? $TheChameleonMeta['main_wrap'] : $TheChameleonOption['main_wrap'] ;		
	$page_class = !empty( $TheChameleonMeta['section_1_sidebar'] ) ?  'col100 page-builder-wrap' : 'col100 page-wrap' ; ?>
	

	<?php echo ( $TheChameleonMeta['custom_css'] ) ? '<style>' .  $TheChameleonMeta['custom_css']  . '</style>' : NULL; ?>
	
	<?php echo ( $main_wrap  == 'fullwidth'  and  $TheChameleonMeta['active_page_builder'] =="1" ) ? '<style>.main, .main-content{padding-left:0px !important; padding-right:0px !important;}</style>' : NULL; ?>
	
<!-- Start page -->
<section id="page-<?php the_ID(); ?>" <?php post_class( $page_class ); ?>>
		

	<?php if ( $main_wrap  == 'stretch' ) : ?>
		<div id="page-<?php the_ID(); ?>-container" class="container page-container page-container-<?php the_ID(); ?>">
	<?php endif;?>


			<section  id="page-content-<?php the_ID();?>" class="col100 <?php echo !empty( $TheChameleonMeta['section_1_sidebar'] ) ?  'page-content-widgets' : 'page-content' ; ?> page-content-<?php the_ID();?>">

				
				<?php if (  $TheChameleonMeta['active_page_builder'] =="1" ) : //if is active page builder ?>

					 <?php for ($i=1; $i <= $TheChameleonMeta['number_of_sections'] ; $i++) : ?> 
						
	       				<?php echo '<!-- Page Builde Section '.$i.'-->'; ?>
	
							<?php if ( !empty( $TheChameleonMeta['section_'.$i.'_sidebar'] ) ) : ?>
								
		                       	<?php if ( $TheChameleonMeta['section_'.$i.'_wrap']  == 'normal' ) : ?>
									<div id="page-builder-section-<?php echo $i ?>-<?php the_ID(); ?>-container" class="container page-container page-container-<?php the_ID(); ?>">
								<?php endif;?>  
								                      
									<section id="page-builder-section-<?php echo $i ?>" class="col100 page-builder <?php echo $TheChameleonMeta['section_'.$i.'_class'].' '.$TheChameleonMeta['section_'.$i.'_custom_class'].' '.$TheChameleonMeta['section_'.$i.'_col'] ?>">
					                 
										<?php if (  $TheChameleonMeta['section_'.$i.'_wrap']   == 'stretch' ) : ?>
											<div id="page-builder-section-<?php echo $i ?>-<?php the_ID(); ?>-container" class="container page-container page-container-<?php the_ID(); ?>">
										<?php endif;?>  
									                  
										<?php $TheChameleon->Widgets->set_data( array('sidebar' => $TheChameleonMeta['section_'.$i.'_sidebar'] ) );
											  $TheChameleon->Widgets->view(); ?>
												                     
		                                 <?php echo ( $TheChameleonMeta['section_'.$i.'_wrap']  == 'stretch' ) ? '</div>' : NULL; ?>	                    
									</section>  
								
								  <?php echo (  $TheChameleonMeta['section_'.$i.'_wrap'] == 'normal' ) ? '</div>' : NULL; ?>	               
		                                                     
							  <?php endif;  ?>	
							  
						  	<?php echo '<!-- End Page Builde Section '.$i.'-->'; ?>        
					     <?php endfor; ?>              

                                                             
				<?php elseif ( is_home() ) :                     
                                                             
						global $wp_query;                        
                                                             
						query_posts ( array( 'pagename' => 'home', 'posts_per_page' => -1, 'post_type'=>'page' ) );
                                                             
                                                             
					elseif ( is_404() ) :                    
                                                             
							$page = get_page_by_path( 'page-404' );	
                                                             
							 if ( !empty( $page ) ) :           
                               
								echo  do_shortcode( $page->post_content ); 
                                  
							 else: ?>	                         

								<h1><?php _e('Error 404 - Page not found!', 'the-chameleon'); ?></h1>
                                          
							<?php endif; ?>                          
   
                                            
				<?php elseif ( is_archive() ) :                  
                                                             
						$post_type = get_post_type();            
                                                             
						if ( $post_type ) {                      
						    $post_type_data = get_post_type_object( $post_type );
						    $post_type_slug = $post_type_data->rewrite['slug'];		  
						}                                        
                                                             
						$page = get_page_by_path( $post_type_slug ); 
                                   
						echo do_shortcode( $page->post_content ); 
					     
                                                             
				 	else: ?>                                   
                                                             
						<?php if ( have_posts() ) : ?>			    
							<?php while ( have_posts()) : the_post(); ?>
                      
									<?php the_content(); ?>
                                                             
							<?php endwhile; ?>                   
						<?php endif; ?>                          
						<?php wp_reset_query(); ?>	             
			                                                 
				<?php endif; ?>                                  
		
			</section><!--#page-content-->
	

<?php echo ( $main_wrap   ==  'stretch' ) ? '</div>' : NULL; ?>	


</section><!-- #end page -->