<?php
	global $data;
	global $TheChameleon;
	$title_size    	 = isset( $data['title_size'] )   ? $data['title_size']   : 'full_title';		
	$meta_pattern    = isset( $data['meta_pattern'] ) ? $data['meta_pattern'] : 'By %author% on %date% in %categories% | %comments%';
	$excerpt_size    = isset( $data['excerpt_size'] ) ? $data['excerpt_size'] : 'full_excerpt';
?>

	<section class="col100 post-widget-content ppost-widget-content-no-title">

		<?php if ( has_post_thumbnail() ) : ?>	

				<figure class="post-media post-widget-media-standard alignleft">				

						<?php echo $TheChameleon->get_post_featured_media(  $post->ID, 'standard', array() ); ?>

				</figure>

		<?php endif; 


		$url = get_post_meta( get_the_ID(), 'link', TRUE );		
		$url = ! empty( $url ) ? $url : '#'; ?>

		<a href="<?php echo $url ?>" target="_blank"><strong><?php echo get_the_title() ?></strong></a> <br />

		<?php the_content(); ?>
	
		<span itemprop="keywords"><?php echo get_the_term_list( $post->ID, 'post_tag', '<i class="fa fa-tags"></i> ', ', ', '' ); ?></span>
	</section>
