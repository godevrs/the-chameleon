<?php
	global $TheChameleon; 	
	global $TheChameleonTermOption;
	global $TheChameleonOption;
	
	/*Define meta for blog or taxs*/		
	if ( is_home() ) :	
		$meta_pattern  = $TheChameleonOption['archive_meta'];								
	elseif ( is_category() or is_tax() or is_archive() or is_search() or is_tag()  ):							
		$meta_pattern  = $TheChameleonTermOption['post_meta'];						
	else:			
		$meta_pattern  = $TheChameleonTermOption['post_meta'];							
	endif; 
		
?>

<article id="post-<?php the_ID(); ?>" <?php post_class('col100 post-loop'); ?> itemscope itemtype="http://schema.org/Article">
	
<!-- Post Content -->
<section class="col100 post-content post-content-loop post-content-no-title-loop">
	<?php if ( has_post_thumbnail() ) : ?>	
		<figure class="post-media post-media-standard post-media-loop post-media-standard-loop alignleft">				
			<?php echo $TheChameleon->get_post_featured_media(  $post->ID, 'standard', array() ); ?>
		</figure>
	<?php endif; 

	$get_post_meta = get_post_meta( get_the_ID(), 'the_chameleon_meta', TRUE );		
	$link 	   = ! empty( $get_post_meta['link'] ) ? $get_post_meta['link'] : ''; ?>

	<a href="<?php echo $link ?>" target="_blank"><strong><?php echo get_the_title() ?></strong></a><br />
	
	<?php the_content(); ?>
	
	<!-- Post Tags -->
	<?php echo get_the_term_list( $post->ID, 'post_tag', '<span itemprop="keywords"><span><i class="fa fa-tags"></i></span><span>', ',</span><span> ', '</span></span>' ); ?>	
</section>

</article>