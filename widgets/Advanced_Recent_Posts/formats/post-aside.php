<?php
	global $TheChameleon;
	global $TheChameleonData;

	$TheChameleonData['title_size']    = isset( $TheChameleonData['title_size'] )   ? $TheChameleonData['title_size']   : 'full_title';		
	$TheChameleonData['meta_pattern']  = isset( $TheChameleonData['meta_pattern'] ) ? $TheChameleonData['meta_pattern'] : 'By %author% on %date% in %categories% | %comments%';
	$TheChameleonData['excerpt_size']  = isset( $TheChameleonData['excerpt_size'] ) ? $TheChameleonData['excerpt_size'] : 'full_excerpt';
?>
<section class="col100 post-widget-content-no-title post-widget-content">

	<?php if ( $TheChameleon->has_post_media( $post->ID ) or has_post_thumbnail() ) : ?>	

			<figure class="post-media post-widget-media-standard alignleft">				

				<?php echo $TheChameleon->get_post_featured_media(  $post->ID, 'standard', array() ); ?>
			
			</figure>

	<?php endif; ?>
		
	<?php the_content(); ?>
	
	<span itemprop="keywords"><?php echo get_the_term_list( $post->ID, 'post_tag', '<i class="fa fa-tags"></i> ', ', ', '' ); ?></span>
	
</section>
