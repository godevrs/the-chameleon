<?php
	global $TheChameleon; 	
	global $TheChameleonTermOption;
?>
 <article id="post-<?php the_ID(); ?>" <?php post_class('col100 post-loop'); ?> itemscope itemtype="http://schema.org/Article">
	
<!-- Post Content -->
<section class="col100 post-content-no-title post-content post-content-loop post-content-no-title-loop">

	<figure class="post-media post-content-no-titlepost-media-standard post-media-loop post-media-standard-loop alignleft">				
		<?php echo get_avatar( get_the_author_meta( 'ID' ), 80 )  ?>	
	</figure>	
	<?php if ( $TheChameleonTermOption['post_meta'] != 'hide' or $TheChameleonTermOption['post_meta'] == '' ) : ?>		
		<!-- Post Meta -->											
	   	  <?php echo $TheChameleon->get_meta_view( $TheChameleonTermOption['post_meta'] ); ?>		   																		
	<?php endif; ?>

	<?php the_content(); ?>
	<!-- Post Tags -->
	<span itemprop="keywords"><?php echo get_the_term_list( $post->ID, 'post_tag', '<i class="fa fa-tags"></i> ', ', ', '' ); ?></span>		
</section>
</article>