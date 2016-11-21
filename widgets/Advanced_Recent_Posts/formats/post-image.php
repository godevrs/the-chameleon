<?php global $TheChameleon, $data;	
	
	$title_size    	 = isset( $data['title_size'] )   ? $data['title_size']   : '';		
	$meta_pattern    = isset( $data['meta_pattern'] ) ? $data['meta_pattern'] : '';
	$excerpt_size    = isset( $data['excerpt_size'] ) ? $data['excerpt_size'] : '';	?>

    <?php if ( $data['show_post_title']=="1" ) : ?>
		<header class="col100 post-widget-header">
		    <?php if ( $title_size == '' ) : ?>
	 			<h3 itemprop="name"><a href="<?php the_permalink(); ?>#post-<?php the_ID(); ?>" itemprop="url"><?php the_title(); ?></a></h3>
	 	    <?php else : ?>
	 			<h3 title="<?php the_title(); ?>"  itemprop="name" ><a href="<?php the_permalink(); ?>#post-<?php the_ID(); ?>" itemprop="url"><?php echo  $TheChameleon->the_title_maxlength( get_the_title(), $title_size ); ?></a></h3>
	 		<?php endif; ?>
		</header>
	<?php endif; ?>
	
	<?php if ( $meta_pattern != '' ) : ?>			
		<section class="col100 post-widget-meta">									
	   	  <?php echo $TheChameleon->get_meta_view( $meta_pattern ); ?>	
	   	</section>														
	<?php endif; ?>

	<?php if( $data['show_post_media'] or $data['show_post_excerpt'] ) : ?>
		<section class="col100 post-widget-content">		
			<?php if ( $TheChameleon->has_post_media( $post->ID ) or has_post_thumbnail() and $data['show_post_media']) : ?>	
				<figure class="post-media post-widget-media-standard aligncenter">				
					<a href="<?php the_permalink(); ?>#post-<?php the_ID(); ?>" itemprop="url"><?php echo $TheChameleon->get_post_featured_media( $post->ID, 'image', array() ); ?></a>
				</figure>
			<?php endif; ?>
			<?php if( $data['show_post_excerpt'] ) :?>
				<?php if ( $excerpt_size == '0' ) : 								
						 the_content();		
					 elseif( $excerpt_size > '0' ) :	
						$TheChameleon->the_excerpt_maxlength( $excerpt_size );					
					 else : 											
				 		 the_excerpt();													
			 		 endif; ?>
			<?php endif;?>
		</section>
	<?php endif;?>	