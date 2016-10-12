<?php
	global $TheChameleon;
	global $TheChameleonTermOption;
?>

<article id="post-<?php the_ID(); ?>" <?php post_class('col100 post-loop'); ?> itemscope itemtype="http://schema.org/Article">
	
<!-- Post Title -->
<?php if ( $TheChameleonTermOption['post_title'] == 'full' ) : ?>
	<header class="col100 post-header post-header-loop">
		<h2 itemprop="name"><a href="<?php the_permalink(); ?>#post-<?php the_ID(); ?>" itemprop="url"><?php the_title(); ?></a></h2>
	</header>
<?php elseif ( $TheChameleonTermOption['post_title'] != 'hide' ) : ?>
	<header class="col100 post-header post-header-loop">
		<h2 title="<?php the_title(); ?>"  itemprop="name"><a href="<?php the_permalink(); ?>#post-<?php the_ID(); ?>" itemprop="url"><?php echo $TheChameleon->the_title_maxlength( get_the_title(), $TheChameleonTermOption['post_title'] ); ?></a></h2>
	</header>
<?php endif; ?>

<?php if ( $TheChameleonTermOption['post_meta'] != 'hide' or $TheChameleonTermOption['post_meta'] == '' ) : ?>		
	<!-- Post Meta -->
	<section class="col100 post-meta  post-meta-loop">					        				
   	  <?php echo $TheChameleon->get_meta_view( $TheChameleonTermOption['post_meta'] ); ?>	
   	</section>							        						
<?php endif; ?>

<!-- Post Content -->
<section class="col100 post-content-loop">
	
	<?php if ( has_post_thumbnail() or $TheChameleon->has_post_audio( $post->ID ) ) : ?>	
		<figure class="post-media post-media-standard post-media-loop post-media-video-loop aligncenter">				
				<?php echo $TheChameleon->get_post_featured_media( $post->ID, 'audio', array() ); ?>		
		</figure>
	<?php endif; ?>
	


	<?php if ( $TheChameleonTermOption['post_content'] == 'full' ) : 								
			 the_content();													
		elseif ( $TheChameleonTermOption['post_content'] == 'excerpt' ) : 												
		 	the_excerpt();										
		 elseif ( $TheChameleonTermOption['post_content'] != 'hide' ) : 								
	 		$TheChameleon->the_excerpt_maxlength( $TheChameleonTermOption['post_content'] ); 				
	 	endif; 
	?>
	<!-- Post Tags -->
	<span itemprop="keywords"><?php echo get_the_term_list( $post->ID, 'post_tag', '<i class="fa fa-tags"></i> ', ', ', '' ); ?></span>
</section>

</article>