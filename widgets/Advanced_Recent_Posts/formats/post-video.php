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
	
   <?php if ( $show_post_title=='1' ) : ?>
		<header class="col100 post-widget-header">	
			<?php if ( $title_length != null and $title_length !='0') : ?>	
			 		<h4 title="<?php the_title(); ?>"  itemprop="name" style="text-align:left;"><a href="<?php the_permalink(); ?>#post-<?php the_ID(); ?>" itemprop="url"><?php echo  $TheChameleon->the_title_maxlength( get_the_title(), $title_length ); ?></a></h4>
 	    	<?php else : ?>
					<h4 itemprop="name" style="text-align:left;"><a href="<?php the_permalink(); ?>#post-<?php the_ID(); ?>" itemprop="url"><?php the_title(); ?></a></h4>
	 		<?php endif; ?>
		</header>		
   <?php endif; ?>
		
	<?php if ( $meta_pattern != 'hide' or $meta_pattern == '' ) : ?>			
		<section class="col100 post-widget-meta">										
	   	 	<small><?php echo $TheChameleon->get_meta_view( $meta_pattern ); ?></small>				
	   	</section>														
	<?php endif; ?>
	
	
	<section class="col100 post-widget-content">
		
		<?php if( $show_post_media =='1' ) : ?>
			<?php if ( $TheChameleon->has_post_media( $post->ID ) or has_post_thumbnail() ) : ?>	
				<figure class="post-widget-media post-widget-media-standard aligncenter">				
					<?php echo $TheChameleon->get_post_featured_media(  $post->ID, 'video', array() ); ?>	
				</figure>
			<?php endif; ?>
		<?php endif; ?>
		
		<?php if ( $show_post_excerpt == '1' ) : 
				if ( $length < '0') :						
					 the_content();													
				elseif ( $length == '0' ) : 							
					echo "<p>";	the_excerpt(); echo "</p>";												
				 elseif ( $length > '0' ) : 								
			 		echo "<p>";	$TheChameleon->the_excerpt_maxlength( $length ); echo "</p>";					
				endif; ?>
		<?php endif; ?>
						
		<?php if ( $show_post_tags == '1' ) : ?>
			<small itemprop="keywords"><?php echo get_the_term_list( $post->ID, 'post_tag', '<i class="fa fa-tags"></i> ', ', ', '' ); ?></small>
		<?php endif;?>
						
	</section>