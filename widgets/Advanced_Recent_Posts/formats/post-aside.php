<?php

	global $TheChameleon, $data;		
	$title_size    	 = isset( $data['title_size'] )   ? $data['title_size']   : '';		
	$meta_pattern    = isset( $data['meta_pattern'] ) ? $data['meta_pattern'] : '';
	$excerpt_size    = isset( $data['excerpt_size'] ) ? $data['excerpt_size'] : '';	?>

	<?php if( $data['show_post_media'] or $data['show_post_excerpt'] ) : ?>
		<section class="col100 post-widget-content post-widget-content-no-title">		
			<?php if ( has_post_thumbnail() or $TheChameleon->has_post_audio( $post->ID ) and $data['show_post_media']) : ?>	
				<figure class="post-media post-widget-media-standard alignleft">				
					<?php echo $TheChameleon->get_post_featured_media( $post->ID, 'standard', array() ); ?>
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