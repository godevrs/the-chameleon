<?php
	global $data;
	global $TheChameleon;
	$title_size    	 = isset( $data['title_size'] )   ? $data['title_size']   : 'full_title';		
	$meta_pattern    = isset( $data['meta_pattern'] ) ? $data['meta_pattern'] : 'By %author% on %date% in %categories% | %comments%';
	$excerpt_size    = isset( $data['excerpt_size'] ) ? $data['excerpt_size'] : 'full_excerpt';	
	?>



	<section class="col100 post-widget-content-no-title post-widget-content">
	
		<figure class="post-widget-media post-widget-content-no-title post-widget-media-standard alignleft">				

			<?php echo get_avatar( get_the_author_meta( 'ID' ), 80 )  ?>	

		</figure>
 		<?php if ( $meta_pattern != 'hide' or $meta_pattern == '' ) : ?>			
		
		   	  <?php echo $TheChameleon->get_meta_view( $meta_pattern ); ?>	

		 													
		<?php endif; ?>

			<?php the_content(); ?>

		<span itemprop="keywords"><?php echo get_the_term_list( $post->ID, 'post_tag', '<i class="fa fa-tags"></i> ', ', ', '' ); ?></span>
			
	</section>
	
