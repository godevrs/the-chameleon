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
	
	
	<!-- Post Title -->
	<header class="col100 post-header post-header-loop">
	
		<!-- Post media -->
		<figure class="post-media post-media-standard post-media-loop post-media-standard-loop alignleft">			
			<?php echo get_avatar( get_the_author_meta( 'ID' ), 45 )  ?>
		</figure>
	
		<h2 itemprop="name" style="display:inline-block;"><a href="<?php the_permalink(); ?>#post-<?php the_ID(); ?>" itemprop="url"><?php echo $TheChameleon->get_meta_view( '%author%' ); ?></a></h2>

		<?php if ( $meta_pattern != 'hide' or $meta_pattern == '' ) : ?>		
			<!-- Post Meta -->	
		      <br />
	   	      <?php echo $TheChameleon->get_meta_view( $meta_pattern ); ?>		   																		
		<?php endif; ?>

	</header>

	<!-- Post Content -->
	<section class="col100 post-content-no-title post-content post-content-loop post-content-no-title-loop">




		<?php the_content(); ?>
		<!-- Post Tags -->
		<?php echo get_the_term_list( $post->ID, 'post_tag', '<span itemprop="keywords"><span><i class="fa fa-tags"></i></span><span>', ',</span><span> ', '</span></span>' ); ?>		
	</section>
</article>