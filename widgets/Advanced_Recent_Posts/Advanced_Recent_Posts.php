<?php
	/**
	 * 	Advanced Recent Posts Widget
	 *
	 * 
	 * @author 		Goran Petrovic <goran.petrovic@godev.rs>
	 * @package     WordPress
	 * @subpackage  The Chameleon
	 * @since 		The Chameleon 3.0.6
	 *
	 * @version 	1.0.1
	 *
	 *
	 **/

	class TheChameleon_Advanced_Recent_Posts_Widget extends WP_Widget {

		function __construct() {
			$widget_ops = array( 'classname' => 'widget_advanced_recent_posts', 'description' => __( "Your site's most recent Posts with advanced functions.", 'the-chameleon' ) );
			parent::__construct('TheChameleon_Advanced_Recent_Posts', __('Recent Posts - The Chameleon', 'the-chameleon'), $widget_ops);
		}

		function widget( $args, $instance ) {
			extract( $args );		
	
			$title 				= apply_filters('widget_title', empty( $instance['title'] ) ? __( '', 'the-chameleon' ) : $instance['title'], $instance, $this->id_base);					
	
			$tag 				= isset ( $instance ['tag'] ) 		? esc_attr ( $instance ['tag'] ) : '';
			$category 			= isset ( $instance ['category'] ) 	? esc_attr ( $instance ['category'] ) : '';

			$posts_per_page 	= isset ( $instance ['posts_per_page'] ) && is_numeric ( $instance ['posts_per_page'] ) ? esc_attr ( $instance ['posts_per_page'] ) : '4';
			$orderby 			= isset ( $instance ['orderby'] ) 	? $instance ['orderby'] : '';
			$order 				= isset ( $instance ['order'] ) 	? $instance ['order'] : '';
			$columns 				= isset ( $instance ['columns'] ) 	? $instance ['columns'] : 'col-1';
			
			$show_post_title 	= isset ( $instance ['show_post_title'] ) ? ( bool ) $instance ['show_post_title'] : false;
			$title_length 		= isset ( $instance ['title_length'] ) && is_numeric ( $instance ['title_length'] ) ? $instance ['title_length'] : 'full_title';

			$meta_pattern 		= isset ( $instance ['meta_pattern'] ) 	  ? esc_attr ( $instance ['meta_pattern'] ) : '';

			$show_post_media 	= isset ( $instance ['show_post_media'] ) ? ( bool ) $instance ['show_post_media'] : false;
			$width 				= isset ( $instance ['width'] ) && is_numeric ( $instance ['width'] ) ? $instance ['width'] : '60';
			$height 			= isset ( $instance ['height'] ) && is_numeric ( $instance ['height'] ) ? $instance ['height'] : '60';

			$show_post_excerpt 	= isset ( $instance ['show_post_excerpt'] ) ? ( bool ) $instance ['show_post_excerpt'] : false;
			$length 			= isset ( $instance ['length'] ) && is_numeric ( $instance ['length'] ) ? $instance ['length'] : '100';

			$template 			= isset ( $instance ['template'] ) ? $instance ['template'] : 'recent';
		
			echo $before_widget;
		
			if ( $title )
		
			echo $before_title . $title . $after_title; 

			   		query_posts( 
							array( 
								'tag_id'		 => ( $tag !='-1') ? $tag : NULL, 
								'cat'	 	 	 => ( $category !='-1') ? $category : NULL, 
								'posts_per_page' => $posts_per_page, 
								'orderby' 		 => $orderby, 
								'order'		 	 => $order, 
								'nopagging' 	 => true
							));
					?>
						<style type="text/css" media="screen">

							.post-widget img{ max-height:100%;}
						
						</style>
						
					<section class="<?php echo 	$columns ?>">	
						
						
					<?php 
				
					global 	$data;	
					$data =
						array(
							'title_tag' 	=> 'h6',
							'meta_pattern'  => $meta_pattern,
							'title_size' 	=> $title_length,
							'excerpt_size'	=> $length ,
							);
				
					$i=0; while ( have_posts() ) : the_post(); ?>

							<?php if( $template == 'recent' ) : ?>
							
							
									<article id="post-<?php the_ID(); ?>" <?php post_class('  post-widget'); ?> itemscope itemtype="http://schema.org/Article" style="">

										<?php	
										$format = get_post_format();
										if ( false === $format )
											$format = 'standard';
									
											
											get_template_part( 'widgets/Advanced_Recent_Posts/formats/post', $format ); 
										?>

									</article>
	
							<?php elseif ( $template == 'featured' ) : ?>
	
								<?php if ($i == 0 ) : ?>
		
									
											<article id="post-<?php the_ID(); ?>" <?php post_class('  post-widget'); ?> itemscope itemtype="http://schema.org/Article" style=" ">

												<?php	
												$format = get_post_format();
												if ( false === $format )
													$format = 'standard';

														get_template_part( 'widgets/Advanced_Recent_Posts/formats/post', $format ); 
												?>

											</article>

								<?php else: ?>
					
					
								
										<article id="post-<?php the_ID(); ?>" <?php post_class('  post-widget'); ?> itemscope itemtype="http://schema.org/Article" style="">

											<header class="col100 post-title  post-title-widget">

												<h5 itemprop="name"><a href="<?php the_permalink(); ?>#post-<?php the_ID(); ?>" itemprop="url"><?php the_title(); ?></a></h5>

											</header>
									
										</article>
					
							
					
							  <?php endif; ?>
	
						<?php endif; ?>

					<?php $i++;	endwhile;
					wp_reset_query();
					wp_reset_postdata(); 

					echo "</section>";
					
			echo $after_widget;
		}

		function update( $new_instance, $old_instance ) {
		
			$instance 			= $new_instance;				
			$title 				= isset ( $instance ['title'] ) 	? esc_attr ( $instance ['title'] ) : '';
		
			$tag 				= isset ( $instance ['tag'] ) 		? esc_attr ( $instance ['tag'] ) : '';
			$category 			= isset ( $instance ['category'] ) 	? esc_attr ( $instance ['category'] ) : '';
	
			$posts_per_page 	= isset ( $instance ['posts_per_page'] ) && is_numeric ( $instance ['posts_per_page'] ) ? esc_attr ( $instance ['posts_per_page'] ) : '4';
			$orderby 			= isset ( $instance ['orderby'] ) 	? $instance ['orderby'] : '';
			$order 				= isset ( $instance ['order'] ) 	? $instance ['order'] : '';
			$columns 				= isset ( $instance ['columns'] ) 	? $instance ['columns'] : 'col-1';
			
			$show_post_title 	= isset ( $instance ['show_post_title'] ) ? ( bool ) $instance ['show_post_title'] : false;
			$title_length 		= isset ( $instance ['title_length'] ) && is_numeric ( $instance ['title_length'] ) ? $instance ['title_length'] : '';

			$meta_pattern 		= isset ( $instance ['meta_pattern'] ) 	  ? esc_attr ( $instance ['meta_pattern'] ) : '';

			$show_post_media 	= isset ( $instance ['show_post_media'] ) ? ( bool ) $instance ['show_post_media'] : false;
			$width 				= isset ( $instance ['width'] ) && is_numeric ( $instance ['width'] ) ? $instance ['width'] : '60';
			$height 			= isset ( $instance ['height'] ) && is_numeric ( $instance ['height'] ) ? $instance ['height'] : '60';
	
			$show_post_excerpt 	= isset ( $instance ['show_post_excerpt'] ) ? ( bool ) $instance ['show_post_excerpt'] : false;
			$length 			= isset ( $instance ['length'] ) && is_numeric ( $instance ['length'] ) ? $instance ['length'] : '100';

			$template 			= isset ( $instance ['template'] ) ? $instance ['template'] : 'recent';
		
			return $instance;
		}
	
		function form( $instance ) { ?>

			<?php
		
			//Defaults
			$instance 			= wp_parse_args( (array) $instance, array( 'title' => '') );
			$title 				= esc_attr( $instance['title'] );			
		
			$tag 				= isset ( $instance ['tag'] ) 		? esc_attr ( $instance ['tag'] ) : '';
			$category 			= isset ( $instance ['category'] ) 	? esc_attr ( $instance ['category'] ) : '';
	
			$posts_per_page 	= isset ( $instance ['posts_per_page'] ) && is_numeric ( $instance ['posts_per_page'] ) ? esc_attr ( $instance ['posts_per_page'] ) : '4';
			$orderby 			= isset ( $instance ['orderby'] ) 	? $instance ['orderby'] : '';
			$order 				= isset ( $instance ['order'] ) 	? $instance ['order'] : '';
			$columns 				= isset ( $instance ['columns'] ) 	? $instance ['columns'] : 'col-1';

	
			$show_post_title 	= isset ( $instance ['show_post_title'] ) ? ( bool ) $instance ['show_post_title'] : false;
			$title_length 		= isset ( $instance ['title_length'] ) && is_numeric ( $instance ['title_length'] ) ? $instance ['title_length'] : '';

			$meta_pattern 		= isset ( $instance ['meta_pattern'] ) 	  ? esc_attr ( $instance ['meta_pattern'] ) : '';

			$show_post_media 	= isset ( $instance ['show_post_media'] ) ? ( bool ) $instance ['show_post_media'] : false;
			$width 				= isset ( $instance ['width'] ) && is_numeric ( $instance ['width'] ) ? $instance ['width'] : '60';
			$height 			= isset ( $instance ['height'] ) && is_numeric ( $instance ['height'] ) ? $instance ['height'] : '60';
	
			$show_post_excerpt 	= isset ( $instance ['show_post_excerpt'] ) ? ( bool ) $instance ['show_post_excerpt'] : false;
			$length 			= isset ( $instance ['length'] ) && is_numeric ( $instance ['length'] ) ? $instance ['length'] : '100';

			$template 			= isset ( $instance ['template'] ) ? $instance ['template'] : 'recent';
		
			?>
				
			<p><label for="<?php echo $this->get_field_id('title'); ?>"><?php echo __( 'Title:', 'the-chameleon' ); ?></label>
				<input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo $title; ?>" /></p>

			<p><label for="<?php echo $this->get_field_id('tag'); ?>"><?php _e('Tag:', 'the-chameleon'); ?></label>
				<?php $args = array(
						'show_option_all'    => '',
						'show_option_none'   => 'All',
						'orderby'            => 'ID', 
						'order'              => 'ASC',
						'show_count'         => 1,
						'hide_empty'         => 1, 
						'child_of'           => 0,
						'exclude'            => '',
						'echo'               => 1,
						'selected'           => $tag,
						'hierarchical'       => 0, 
						'name'               => $this->get_field_name('tag'),
						'id'                 => 'tag',
						'class'              => 'widefat',
						'depth'              => 0,
						'tab_index'          => 0,
						'taxonomy'           => 'post_tag',
						'hide_if_empty'      => false,
					); ?>
					<?php wp_dropdown_categories( $args ); ?></p>

			<p><label for="<?php echo $this->get_field_id('category'); ?>"><?php _e('Category:', 'the-chameleon'); ?></label>
				<?php $args = array(
						'show_option_all'    => '',
						'show_option_none'   => 'All',
						'orderby'            => 'ID', 
						'order'              => 'ASC',
						'show_count'         => 1,
						'hide_empty'         => 1, 
						'child_of'           => 0,
						'exclude'            => '',
						'echo'               => 1,
						'selected'           => $category ,
						'hierarchical'       => 1, 
						'name'               => $this->get_field_name('category'),
						'id'                 => 'category',
						'class'              => 'widefat',
						'depth'              => 0,
						'tab_index'          => 0,
						'taxonomy'           => 'category',
						'hide_if_empty'      => false,
					); ?>
					<?php wp_dropdown_categories( $args ); ?></p>	
					
			<p><label for="<?php echo $this->get_field_id('orderby'); ?>"><?php _e('Order by:', 'the-chameleon'); ?></label>
			<select id="<?php echo $this->get_field_id('orderby'); ?>" name="<?php echo $this->get_field_name('orderby'); ?>" class="widefat">			
				<option value="date"   <?php echo 'date'   == $orderby ? 'selected="selected"' : '' ?>><?php _e('Date', 'the-chameleon'); ?></option>
				<option value="ID"     <?php echo 'ID'     == $orderby ? 'selected="selected"' : '' ?>><?php _e('ID', 'the-chameleon'); 	?></option>
				<option value="title"  <?php echo 'title'  == $orderby ? 'selected="selected"' : '' ?>><?php _e('Title','the-chameleon'); ?></option>
				<option value="author" <?php echo 'author' == $orderby ? 'selected="selected"' : '' ?>><?php _e('Author', 'the-chameleon'); ?></option>
				<option value="rand"   <?php echo 'rand'   == $orderby ? 'selected="selected"' : '' ?>><?php _e('Random', 'the-chameleon'); ?></option>
				<option value="comment_count" <?php echo 'comment_count' == $orderby ? 'selected="selected"' : '' ?>><?php _e('Comment count', 'the-chameleon'); ?></option>
			</select></p>

			<p><label for="<?php echo $this->get_field_id('order'); ?>"><?php _e('Order:', 'the-chameleon'); ?></label>
			<select id="<?php echo $this->get_field_id('order'); ?>" name="<?php echo $this->get_field_name('order'); ?>" class="widefat">
				<option value="DESC" <?php echo 'DESC' == $order ? 'selected="selected"' : '' ?>><?php _e('DESC', 'the-chameleon'); ?></option>
				<option value="ASC" <?php echo 'ASC' == $order ? 'selected="selected"' : '' ?>><?php _e('ASC', 'the-chameleon'); ?></option>
			</select></p>

			<p><label for="<?php echo $this->get_field_id('posts_per_page'); ?>"><?php _e('Number of posts to show:', 'the-chameleon'); ?></label>
				<input id="<?php echo $this->get_field_id('posts_per_page'); ?>" name="<?php echo $this->get_field_name('posts_per_page'); ?>" type="number" size="3" style="width:50px;" value="<?php echo $posts_per_page; ?>" /></p>


			<p><label for="<?php echo $this->get_field_id('columns'); ?>"><?php _e('Columns:', 'the-chameleon'); ?></label>
			<?php global $config;	?>
			<select id="<?php echo $this->get_field_id('columns'); ?>" name="<?php echo $this->get_field_name('columns'); ?>" class="widefat">	
			
				<?php foreach ($config->columns  as $key => $col) : ?>
					
					<option value="<?php echo  $key ?>"   <?php echo $key    == $columns ? 'selected="selected"' : '' ?>><?php echo $col ?></option>
				
				<?php endforeach; ?>

			</select></p>


			<p><input id="<?php echo $this->get_field_id('show_post_title'); ?>" name="<?php echo $this->get_field_name('show_post_title'); ?>" type="checkbox" <?php checked( $show_post_title ); ?> /> 
				<label for="<?php echo $this->get_field_id('show_post_title'); ?>"><?php _e('Show Post Title', 'the-chameleon'); ?></label>
				<br />
				<small><?php _e('Post title length (characters)', 'the-chameleon'); ?></small>
				<input id="<?php echo $this->get_field_id('title_length'); ?>" name="<?php echo $this->get_field_name('title_length'); ?>" type="number" step="5" style="width:50px;"  value="<?php echo $title_length; ?>" /><br />	</p>
				
			<p><label for="<?php echo $this->get_field_id('meta_pattern'); ?>"><?php echo __( 'Meta Pattern:', 'the-chameleon' ); ?></label>
				<input class="widefat" id="<?php echo $this->get_field_id('meta_pattern'); ?>" name="<?php echo $this->get_field_name('meta_pattern'); ?>" type="text" value="<?php echo $meta_pattern; ?>" /></p>


			<p><input id="<?php echo $this->get_field_id('show_post_media'); ?>" name="<?php echo $this->get_field_name('show_post_media'); ?>" type="checkbox" <?php checked( $show_post_media ); ?> /> 			
		 	   <label for="<?php echo $this->get_field_id('show_post_media'); ?>"><?php _e('Show Post Media', 'the-chameleon'); ?></label>
		 	   <br />
		 	   <small><?php _e('Media size (W-H):', 'the-chameleon'); ?></small>		
		 	   <input type="number" step="5" name="<?php echo $this->get_field_name('width'); ?>" value="<?php echo $width; ?>"  style="width:50px;" />px 
		 	   <input type="number" step="5" name="<?php echo $this->get_field_name('height'); ?>" value="<?php echo $height; ?>" style="width:50px;" />px</p>

			<p><input id="<?php echo $this->get_field_id('show_post_excerpt'); ?>" name="<?php echo $this->get_field_name('show_post_excerpt'); ?>" type="checkbox" <?php checked( $show_post_excerpt ); ?> /> 			
			<label for="<?php echo $this->get_field_id('show_post_excerpt'); ?>"><?php _e('Show Post Excerpt', 'the-chameleon'); ?></label><br />
			<small><?php _e('Post excerpt length (characters)', 'the-chameleon'); ?></small>	
			<input id="<?php echo $this->get_field_id('length'); ?>" name="<?php echo $this->get_field_name('length'); ?>" type="number" step="5" value="<?php echo $length; ?>" style="width:50px;" /></p>	
				

			<p><label for="<?php echo $this->get_field_id('template'); ?>"><?php _e('Template:', 'the-chameleon'); ?></label>
			<select id="<?php echo $this->get_field_id('template'); ?>" name="<?php echo $this->get_field_name('template'); ?>" class="widefat">
				<option value="recent" <?php echo 'recent' == $template ? 'selected="selected"' : '' ?>><?php _e('Recent Posts', 'the-chameleon'); ?></option>
				<option value="featured" <?php echo 'featured' == $template ? 'selected="selected"' : '' ?>><?php _e('Featured 1 of 5', 'the-chameleon'); ?></option>	
			</select></p>	

	<?php
		}

	}


