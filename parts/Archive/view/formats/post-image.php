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
 <article id="post-<?php the_ID(); ?>" <?php post_class('col100 post post-loop'); ?> itemscope itemtype="http://schema.org/Article">


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

<?php if ( 	$meta_pattern != 'hide' or 	$meta_pattern == '' ) : ?>		
	<!-- Post Meta -->
	<section class="col100 post-meta  post-meta-loop">											
   	  <?php echo $TheChameleon->get_meta_view(	$meta_pattern ); ?>		   				
   	</section>															
<?php endif; ?>


<!-- Post Content -->	
<section class="col100 post-content post-content-loop">

	<?php if ( has_post_thumbnail() ) : ?>	
		<figure class="post-media post-media-standard post-media-loop post-media-standard-loop aligncenter">				
			<a href="<?php the_permalink(); ?>#post-<?php the_ID(); ?>"><?php echo $TheChameleon->get_post_featured_media(  $post->ID, 'image', array() );?></a>
		</figure>
	<?php endif; ?>

	
	<?php if ( $TheChameleonTermOption['post_content'] 	  == 'full' ) : 								
		 	the_content();													
		 elseif ( $TheChameleonTermOption['post_content']  == 'excerpt' ) : 												
	 		the_excerpt();										
	 	 elseif ( $TheChameleonTermOption['post_content'] != 'hide' ) : 								
 			$TheChameleon->the_excerpt_maxlength( $TheChameleonTermOption['post_content'] ); 				
 		endif; 
	?>
	<!-- Post Tags -->
	<?php echo get_the_term_list( $post->ID, 'post_tag', '<span itemprop="keywords"><span><i class="fa fa-tags"></i></span><span>', ',</span><span> ', '</span></span>' ); ?>	
</section>

</article>