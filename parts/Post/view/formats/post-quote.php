<?php
	global $TheChameleon;
	global $TheChameleonOption;
?>
<?php if ( $TheChameleonOption['post_meta_pattern'] != 'hide' or $TheChameleonOption['post_meta_pattern'] =='' ) : ?>			
	<!-- Post Meta -->
	<section class="col100 post-meta  post-meta-single">	   											
   	  <?php echo $TheChameleon->get_meta_view( 	$TheChameleonOption['post_meta_pattern'] ); ?>		   				
   	</section>														
<?php endif; ?>

<!-- Post Content -->	
<section class="col100 post-content post-content-single">
	<?php if ( $TheChameleon->has_post_media( $post->ID ) or has_post_thumbnail() ) : ?>	
		<figure class="post-media post-media-standard post-media-single post-media-standard-single alignleft">				
			<?php echo $TheChameleon->get_post_featured_media(  $post->ID, 'standard', array() ); ?>	
		</figure>
	<?php endif; ?>

	<?php	
		$get_post_meta = get_post_meta( get_the_ID(), 'the_chameleon_meta', TRUE );		
		$author 	   = ! empty( $get_post_meta['quote_author_name'] ) ? $get_post_meta['quote_author_name'] : '';

     	echo '<q>'.get_the_content() .'</q><br /><i> -- ' . $author . '</i>'; ?>

		<!-- Post Tags -->
		<span  itemprop="keywords"><?php echo get_the_term_list( $post->ID, 'post_tag', '<i class="fa fa-tags"></i> ', ', ', '' ); ?></span>
</section>

