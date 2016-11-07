<?php global $TheChameleon, $data;
	
	$title_size    	 = isset( $data['title_size'] )   ? $data['title_size']   : '';		
	$meta_pattern    = isset( $data['meta_pattern'] ) ? $data['meta_pattern'] : '';
	$excerpt_size    = isset( $data['excerpt_size'] ) ? $data['excerpt_size'] : '';?>
    
	<?php if( $data['show_post_media'] or $data['show_post_excerpt'] ) : ?>
		<section class="col100 post-widget-content post-widget-content-no-title">		
			
			<figure class="post-media post-widget-media-standard alignleft">				
				<?php echo get_avatar( get_the_author_meta( 'ID' ), 80 )  ?>	
			</figure>
			
			<?php if ( $meta_pattern != '' ) : ?>			
				<section class="post-widget-meta ">									
			   	  <?php echo $TheChameleon->get_meta_view( $meta_pattern ); ?>	
			   	</section>														
			<?php endif; ?>

			<?php if( $data['show_post_excerpt'] ) :
					 if ( $excerpt_size == '0' ) : 								
						 the_content();		
					 elseif( $excerpt_size > '0' ) :	
						$TheChameleon->the_excerpt_maxlength( $excerpt_size );					
					 else : 											
				 		 the_excerpt();													
			 		 endif; 
				 endif;?>
		</section>
	<?php endif;?>
