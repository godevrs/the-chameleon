<?php global $TheChameleon, $data;	
	
	$title_size    	 = isset( $data['title_size'] )   ? $data['title_size']   : '';		
	$meta_pattern    = isset( $data['meta_pattern'] ) ? $data['meta_pattern'] : '';
	$excerpt_size    = isset( $data['excerpt_size'] ) ? $data['excerpt_size'] : '';	
	wp_enqueue_script( 'TheChameleon-cycle'); ?>

    <?php if ( $data['show_post_title']=="1" ) : ?>
		<header class="col100 post-widget-header">
		    <?php if ( $title_size == '' ) : ?>
	 			<h3 itemprop="name" style="text-align:left;"><a href="<?php the_permalink(); ?>#post-<?php the_ID(); ?>" itemprop="url"><?php the_title(); ?></a></h3>
	 	    <?php else : ?>
	 			<h3 title="<?php the_title(); ?>"  itemprop="name" style="text-align:left;"><a href="<?php the_permalink(); ?>#post-<?php the_ID(); ?>" itemprop="url"><?php echo  $TheChameleon->the_title_maxlength( get_the_title(), $title_size ); ?></a></h3>
	 		<?php endif; ?>
		</header>
	<?php endif; ?>
	
	<?php if ( $meta_pattern != '' ) : ?>			
		<section class="col100 post-widget-meta">									
	   	  <?php echo $TheChameleon->get_meta_view( $meta_pattern ); ?>	
	   	</section>														
	<?php endif; ?>

	<?php if( $data['show_post_media'] or $data['show_post_excerpt'] ) : ?>
		<section class="col100 post-widget-content">	
				
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
			<?php if( $data['show_post_excerpt'] ) :?>
				<?php if ( $excerpt_size == '0' ) : 								
						 the_content();		
					 elseif( $excerpt_size > '0' ) :	
						$TheChameleon->the_excerpt_maxlength( $excerpt_size );					
					 else : 											
				 		 the_excerpt();													
			 		 endif; ?>
			<?php endif;?>
		</section>
	<?php endif;?>	
                          
                             
                                                                 
                                                                  