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
<section class="col100 post-content-no-title post-content post-content-loop post-content-no-title-loop">

	<figure class="post-media post-content-no-titlepost-media-standard post-media-loop post-media-standard-loop alignleft">				
		<?php echo get_avatar( get_the_author_meta( 'ID' ), 80 )  ?>	
	</figure>	
	<?php if ( $meta_pattern != 'hide' or $meta_pattern == '' ) : ?>		
		<!-- Post Meta -->											
	   	  <?php echo $TheChameleon->get_meta_view( $meta_pattern ); ?>		   																		
	<?php endif; ?>

	<?php the_content(); ?>
	<!-- Post Tags -->
	<span itemprop="keywords"><?php echo get_the_term_list( $post->ID, 'post_tag', '<i class="fa fa-tags"></i> ', ', ', '' ); ?></span>		
</section>
</article>