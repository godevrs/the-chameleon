<?php
	
	global  $TheChameleon, $TheChameleonWidgetData;
	$show_post_title     = isset( $TheChameleonWidgetData['show_post_title'] )   ? $TheChameleonWidgetData['show_post_title']   : '0';	
	$title_length    	 = isset( $TheChameleonWidgetData['title_length'] )      ? $TheChameleonWidgetData['title_length']   : '0';	
	$meta_pattern    	 = isset( $TheChameleonWidgetData['meta_pattern'] ) ? $TheChameleonWidgetData['meta_pattern'] : 'By %author% on %date% in %categories% | %comments%';
	$show_post_media     = isset( $TheChameleonWidgetData['show_post_media'] )   ? $TheChameleonWidgetData['show_post_media']   : '0';		
	$show_post_excerpt   = isset( $TheChameleonWidgetData['show_post_excerpt'] )  ? $TheChameleonWidgetData['show_post_excerpt'] : null;			
	$length    			 = isset( $TheChameleonWidgetData['length'] ) ? $TheChameleonWidgetData['length'] : '100';	
	$show_post_tags      = isset( $TheChameleonWidgetData['show_post_tags'] ) ? $TheChameleonWidgetData['show_post_tags'] : null;	
	
	$url = get_post_meta( get_the_ID(), 'link', TRUE );				
	$url = ! empty( $url ) ? $url : '#';
	?>

	<section class="col100 post-widget-content">
		
		<?php if( $show_post_media =='1' ) : ?>
				<?php if ( $TheChameleon->has_post_media( $post->ID ) or has_post_thumbnail() ) : ?>					
					<figure class="post-widget-media post-widget-media-standard alignleft">	
						<a href="<?php echo $url ?>" target="_blank">		
							<?php echo $TheChameleon->get_post_featured_media(  $post->ID, 'standard', array() ); ?>
						</a>	
					</figure>
			<?php endif; ?>
		<?php endif; 	?>

		<a href="<?php echo $url ?>" target="_blank"><strong><?php echo get_the_title() ?></strong></a> <br />

		<?php the_content(); ?>
		
		<?php if ( $show_post_tags == '1' ) : ?>
			<small itemprop="keywords"><?php echo get_the_term_list( $post->ID, 'post_tag', '<i class="fa fa-tags"></i> ', ', ', '' ); ?></small>
		<?php endif;?>
						
	</section>