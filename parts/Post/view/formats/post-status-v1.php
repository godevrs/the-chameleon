<?php
	global $TheChameleon;
	global $TheChameleonOption;
?>
<?php if ( $TheChameleonOption['post_meta_pattern'] != 'hide' or $TheChameleonOption['post_meta_pattern'] =='' ) : ?>			
	<!-- Post Meta -->
	<section class="col100 post-meta post-meta-single">	   											
   	  <?php echo $TheChameleon->get_meta_view( 	$TheChameleonOption['post_meta_pattern'] ); ?>		   				
   	</section>														
<?php endif; ?>

<!-- Post Content -->
<section class="col100 post-content post-content-single">
	<figure class="post-media post-media-standard post-media-single post-media-standard-single alignleft">				
		<?php echo get_avatar( get_the_author_meta( 'ID' ), 80 )  ?>	
	</figure>

	<?php the_content(); ?>
	
	<!-- Post Tag s-->
	<span  itemprop="keywords"><?php echo get_the_term_list( $post->ID, 'post_tag', '<i class="fa fa-tags"></i> ', ', ', '' ); ?></span>
</section>

