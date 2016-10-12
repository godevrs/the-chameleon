<?php
	global $data;
	global $TheChameleon;
	$title_size    	 = isset( $data['title_size'] )   ? $data['title_size']   : 'full_title';		
	$meta_pattern    = isset( $data['meta_pattern'] ) ? $data['meta_pattern'] : 'By %author% on %date% in %categories% | %comments%';
	$excerpt_size    = isset( $data['excerpt_size'] ) ? $data['excerpt_size'] : 'full_excerpt';
	$title_tag    	 = isset( $data['title_tag'] ) ? $data['title_tag'] : 'h5';		
 	wp_enqueue_script( 'TheChameleon-cycle');
 
	?>
	
	

	<header class="col100 post-widget-header">
		
	    <?php if ( $title_size == 'full_title' ) : ?>

 			<h5 itemprop="name"><a href="<?php the_permalink(); ?>#post-<?php the_ID(); ?>" itemprop="url"><?php the_title(); ?></a></h5>

 	    <?php elseif ( $title_size != 'hide' ) : ?>
	
 			<h5 title="<?php the_title(); ?>"  itemprop="name"><a href="<?php the_permalink(); ?>#post-<?php the_ID(); ?>" itemprop="url"><?php echo TheChameleon_the_title_maxlength( get_the_title(), $title_size ); ?></a></h5>

 		<?php endif; ?>
	
	</header>                                            
                                                                  
                                                                  
  <?php if ( $meta_pattern != 'hide' or $meta_pattern =='' ) : ?>			
  	<section class="col100 post-widget-meta">       
    											                     
     	  <?php echo $TheChameleon->get_meta_view( $meta_pattern ); ?>	         
    				                                                 
     	</section>												    	
  <?php endif; ?>                                              
 	                                                             
                                                                  
                                                                  
  <section class="col100  post-widget-content">      
 	                                                             

	  <?php	if( ! has_shortcode( $post->the_content, 'gallery' ) )  : ?>                                           
		                                                 
			<figure class="post-media post-widget-media-standard aligncenter">				
                                                               
				<?php  // Retrieve the first gallery in the post
				$gallery = get_post_gallery_images( $post ); ?> 
		                                    
				<div class="cycle-slideshow" 	
				    data-cycle-speed="800"
				    data-cycle-pause-on-hover="false"
				    data-cycle-timeout="3000"
				    data-cycle-easing="linear"
					data-cycle-loader="true"
					data-cycle-fx="fade">
					
					<?php // Loop through each image in each gallery
						foreach( $gallery as $image_url ) :

							echo '<img src="' . $image_url . '" class="aligncenter" /> ';

						endforeach; ?>	
			 </div>                   
                                         
			</figure>   
                              
       <?php endif; ?>                                                
 	                                                         
 		<p><?php if ( $excerpt_size == 'full_content' ) : 		    					
 				 the_content();								    				
 			elseif ( $excerpt_size == 'full_excerpt' ) : 	    										
 			 	the_excerpt();								    	
 			 elseif ( $excerpt_size != 'hide' ) : 			    				
 		 		$TheChameleon->the_excerpt_maxlength( $excerpt_size ); 				
 		 	endif; ?></p>                                      
                                                                 
          	<span itemprop="keywords"><?php echo get_the_term_list( $post->ID, 'post_tag', '<i class="fa fa-tags"></i> ', ', ', '' ); ?></span>
                                             
  </section>                                                       
                             
                                                                 
                                                                  