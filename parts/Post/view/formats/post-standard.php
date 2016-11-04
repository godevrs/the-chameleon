<?php
	global $TheChameleon;
	global $TheChameleonOption;
?>
<!-- Post Title -->
<header class="col100 post-header post-header-single">	
	<h1 itemprop="name"><?php the_title(); ?></h1>	
</header>

<?php if ( $TheChameleonOption['post_meta_pattern'] != 'hide' or $TheChameleonOption['post_meta_pattern'] =='' ) : ?>			
	<!-- Post Meta -->
	<section class="col100 post-meta post-meta-loop post-meta-single">	   											
   	  <?php echo $TheChameleon->get_meta_view( 	$TheChameleonOption['post_meta_pattern'] ); ?>		   				
   	</section>														
<?php endif; ?>
	
<!-- Post Content -->
<section class="col100 post-content post-content-single">	
	<?php if (  $TheChameleon->has_post_media( $post->ID ) or has_post_thumbnail() ) : ?>	
		<figure class="post-media post-media-standard post-media-single post-media-standard-single alignleft">		
			<?php echo  $TheChameleon->get_post_featured_media(  $post->ID, 'standard', array('width'=>'950', 'height'=>'450') ); ?>	
		</figure>
	<?php endif; ?>

	<?php the_content(); ?>
	

	<!-- Post Tags -->
	<?php echo get_the_term_list( $post->ID, 'post_tag', '<span itemprop="keywords"><span><i class="fa fa-tags"></i></span><span>', ',</span><span> ', '</span></span>' ); ?>	
	
</section>

