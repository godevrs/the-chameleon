	<?php
	
	global  $TheChameleon;
	
	global $data;
	
	$title_size    	 = isset( $data['title_size'] )   ? $data['title_size']   : 'full_title';		
	$meta_pattern    = isset( $data['meta_pattern'] ) ? $data['meta_pattern'] : 'By %author% on %date% in %categories% | %comments%';
	$excerpt_size    = isset( $data['excerpt_size'] ) ? $data['excerpt_size'] : 'full_excerpt';	
	$title_tag    	 = isset( $data['title_tag'] ) ? $data['title_tag'] : 'h2';	
	?>
	
	

	<header class="col100 post-widget-header">
		
	    <?php if ( $title_size == 'full_title' ) : ?>

 			<h3 itemprop="name" style="text-align:left;"><a href="<?php the_permalink(); ?>#post-<?php the_ID(); ?>" itemprop="url"><?php the_title(); ?></a></h4>

 	    <?php elseif ( $title_size != 'hide' ) : ?>
	
 			<h4 title="<?php the_title(); ?>"  itemprop="name" style="text-align:left;"><a href="<?php the_permalink(); ?>#post-<?php the_ID(); ?>" itemprop="url"><?php echo  $TheChameleon->the_title_maxlength( get_the_title(), $title_size ); ?></a></h4>

 		<?php endif; ?>
	
	</header>
	
	
	<?php if ( $meta_pattern != 'hide' or $meta_pattern == '' ) : ?>			
		<section class="col100 post-widget-meta">
  											
	   	  <?php echo $TheChameleon->get_meta_view( $meta_pattern ); ?>	
	   				
	   	</section>														
	<?php endif; ?>

	<section class="col100 post-widget-content">
		
			<?php if ( $TheChameleon->has_post_media( $post->ID ) or has_post_thumbnail() ) : ?>	

					<figure class="post-media post-widget-media-standard alignleft">				

							<?php echo $TheChameleon->get_post_featured_media(  $post->ID, 'standard', array() ); ?>
					
					</figure>

			<?php endif; ?>

			<p><?php if ( $excerpt_size == 'full_content' ) : 								
					 the_content();													
				elseif ( $excerpt_size == 'full_excerpt' ) : 												
				 	the_excerpt();										
				 elseif ( $excerpt_size != 'hide' ) : 								
			 		$TheChameleon->the_excerpt_maxlength( $excerpt_size ); 				
			 	endif; ?></p>
				
	<!--		<span itemprop="keywords"><?php echo get_the_term_list( $post->ID, 'post_tag', '<i class="fa fa-tags"></i> ', ', ', '' ); ?></span>-->
			
	</section>

	