<?php
	global $TheChameleon;
	global $TheChameleonOption;
?>                             
<section class="col100 post-content post-content-single">
<?php if ( $TheChameleon->has_post_media( $post->ID ) or has_post_thumbnail() ) : ?>	
	<figure class="post-media post-media-standard post-media-single post-media-standard-single alignleft">				
		<?php echo $TheChameleon->get_post_featured_media(  $post->ID, 'standard', array() ); ?>
	</figure>
<?php endif; ?>

<?php $get_post_meta = get_post_meta( get_the_ID(), 'the_chameleon_meta', TRUE );		
	  $link 	     = ! empty( $get_post_meta['link'] ) ? $get_post_meta['link'] : ''; ?>

	  <a href="<?php echo $link ?>" target="_blank"><strong><?php echo get_the_title() ?></strong></a><br />

	  <?php the_content(); ?>
	
	<!-- Post Tags -->
	<?php echo get_the_term_list( $post->ID, 'post_tag', '<span itemprop="keywords"><span><i class="fa fa-tags"></i></span><span>', ',</span><span> ', '</span></span>' ); ?>	
</section>
