<?php
	global $TheChameleon;
	global $TheChameleonTermOption;
?>

<article id="post-<?php the_ID(); ?>" <?php post_class('col100 post-loop'); ?> itemscope itemtype="http://schema.org/Article">

	<!-- Post Content -->
	<section class="col100 post-content-no-title post-content-loop post-content-no-title-loop">
		<?php if ( $TheChameleon->has_post_media( $post->ID ) or has_post_thumbnail() ) : ?>	
			<figure class="post-media post-media-standard post-media-loop post-media-video-loop alignleft">				
				<?php echo $TheChameleon->get_post_featured_media(  $post->ID, 'standard', array() ); ?>		
			</figure>
		<?php endif; ?>
		
		<?php the_content(); ?>
		
		<!-- Post Tags -->
		<span itemprop="keywords"><?php echo get_the_term_list( $post->ID, 'post_tag', '<i class="fa fa-tags"></i> ', ', ', '' ); ?></span>	
	</section>

</article>