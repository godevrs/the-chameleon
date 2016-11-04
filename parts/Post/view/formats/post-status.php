<?php
	global $TheChameleon; 	
	global $TheChameleonTermOption;
?>
 <article id="post-<?php the_ID(); ?>" <?php post_class('col100 post-loop'); ?> itemscope itemtype="http://schema.org/Article">
		
	<!-- Post Title -->
	<header class="col100 post-header post-header-loop">
	
		<!-- Post media -->
		<figure class="post-media post-media-standard post-media-loop post-media-standard-loop alignleft">			
			<?php echo get_avatar( get_the_author_meta( 'ID' ), 45 )  ?>
		</figure>
	
		<h1 itemprop="name" style="display:inline-block;"><?php echo $TheChameleon->get_meta_view( '%author%' ); ?></h1>

		<?php if ( $TheChameleonTermOption['post_meta'] != 'hide' or $TheChameleonTermOption['post_meta'] == '' ) : ?>		
			<!-- Post Meta -->	
		      <br />
	   	      <?php echo $TheChameleon->get_meta_view( $TheChameleonTermOption['post_meta'] ); ?>		   																		
		<?php endif; ?>

	</header>

	<!-- Post Content -->
	<section class="col100 post-content-no-title post-content post-content-loop post-content-no-title-loop">

		<?php the_content(); ?>
		<!-- Post Tags -->
		<?php echo get_the_term_list( $post->ID, 'post_tag', '<span itemprop="keywords"><span><i class="fa fa-tags"></i></span><span>', ',</span><span> ', '</span></span>' ); ?>		
	</section>
</article>