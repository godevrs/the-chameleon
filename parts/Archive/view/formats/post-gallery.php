<?php
	global $TheChameleon, $post; 	
	global $TheChameleonTermOption;
	
	
	// Use full size gallery images for the next gallery shortcode: 
	add_filter( 'shortcode_atts_gallery', 'the_chameleon_shortcode_atts_gallery' );

	/**
	 * Set the size attribute to 'full' in the next gallery shortcode.
	 */
	function the_chameleon_shortcode_atts_gallery( $out ){
	    remove_filter( current_filter(), __FUNCTION__ );
	    $out['size'] = 'full';
	    return $out;
	} ?>

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
<section class="col100  post-content-loop">      

<?php if( ! has_shortcode( $post->the_content, 'gallery' ) )  : ?>                                                                                      
	<figure class="post-media post-media-standard post-media-loop post-media-video-loop aligncenter">				                                                         
		<?php  // Retrieve the first gallery in the post
		$gallery = get_post_gallery_images( $post ); ?>                                  
		<div class="cycle-slideshow" 	
		    data-cycle-speed="800"
		    data-cycle-pause-on-hover="false"
		    data-cycle-timeout="3000"
		    data-cycle-easing="linear"
			data-cycle-loader="true"
			data-cycle-fx="fade">		
			<?php // Loop through each image in each gallery
				foreach( $gallery as $image_url ) :
					echo '<img src="' . $image_url . '" class="aligncenter" /> ';
				endforeach;
			 ?>	
	 	</div>                                                     
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
    <span itemprop="keywords"><?php echo get_the_term_list( $post->ID, 'post_tag', '<i class="fa fa-tags"></i> ', ', ', '' ); ?></span>                                    
</section> 

</article>                                                            