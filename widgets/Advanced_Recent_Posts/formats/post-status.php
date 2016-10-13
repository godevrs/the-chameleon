<?php
	
	global  $TheChameleon, $TheChameleonWidgetData;
	$show_post_title     = isset( $TheChameleonWidgetData['show_post_title'] )   ? $TheChameleonWidgetData['show_post_title']   : '0';	
	$title_length    	 = isset( $TheChameleonWidgetData['title_length'] )      ? $TheChameleonWidgetData['title_length']   : '0';	
	$meta_pattern    	 = isset( $TheChameleonWidgetData['meta_pattern'] ) ? $TheChameleonWidgetData['meta_pattern'] : 'By %author% on %date% in %categories% | %comments%';
	$show_post_media     = isset( $TheChameleonWidgetData['show_post_media'] )   ? $TheChameleonWidgetData['show_post_media']   : '0';		
	$show_post_excerpt   = isset( $TheChameleonWidgetData['show_post_excerpt'] )  ? $TheChameleonWidgetData['show_post_excerpt'] : null;			
	$length    			 = isset( $TheChameleonWidgetData['length'] ) ? $TheChameleonWidgetData['length'] : '100';	
	$show_post_tags      = isset( $TheChameleonWidgetData['show_post_tags'] ) ? $TheChameleonWidgetData['show_post_tags'] : null;	

	?>

	<section class="col100 post-widget-content">
		
		<?php if( $show_post_media =='1' ) : ?>
			<?php if ( $TheChameleon->has_post_media( $post->ID ) or has_post_thumbnail() ) : ?>	
				<figure class="post-widget-media post-widget-media-standard alignleft">				
					<?php echo get_avatar( get_the_author_meta( 'ID' ), 80 )  ?>	
				</figure>
			<?php endif; ?>
		<?php endif; ?>
		
		<?php if ( $meta_pattern != 'hide' or $meta_pattern == '' ) : ?>										
		   	<small><?php echo $TheChameleon->get_meta_view( $meta_pattern ); ?></small>				
		<?php endif; ?>
		
		<?php if ( $show_post_excerpt == '1' ) :  ?>
			<?php the_content(); ?>
		<?php endif; ?>
						
		<?php if ( $show_post_tags == '1' ) : ?>
			<small itemprop="keywords"><?php echo get_the_term_list( $post->ID, 'post_tag', '<i class="fa fa-tags"></i> ', ', ', '' ); ?></small>
		<?php endif;?>
						
	</section>