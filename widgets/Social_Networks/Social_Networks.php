<?php
	/**
	 * 	Social Networks Widget
	 *
	 *
	 * @author 		Goran Petrovic <goran.petrovic@godev.rs>
	 * @package     WordPress
	 * @subpackage  The Chameleon
	 * @since 		The Chameleon 3.0.6
	 *
	 * @version 	1.0.0
	 *
	 *
	 **/
	class TheChameleon_Social_Networks_Widget extends WP_Widget {

		function __construct() {
			$widget_ops = array( 'classname' => 'widget_social_networks', 'description' => __( "Add social networks icon.", 'the-chameleon' ) );
			parent::__construct('TheChameleon_Widget_Social_Networks', __('Social Networks - The Chameleon', 'the-chameleon'), $widget_ops);
		}

		function widget( $args, $instance ) {
			extract( $args );	
					
			$title 		 = apply_filters('widget_title', empty( $instance['title'] ) ? __( 'Follow Us', 'the-chameleon' ) : $instance['title'], $instance, $this->id_base);			
			$twitter	 = isset ( $instance['twitter'] ) 	  ? esc_url ( $instance['twitter'] ) 	  : '';
			$linkedin	 = isset ( $instance['linkedin'] ) 	  ? esc_url ( $instance['linkedin'] ) 	  : '';
			$facebook	 = isset ( $instance['facebook'] ) 	  ? esc_url ( $instance['facebook'] ) 	  : '';
			$google_plus = isset ( $instance['google_plus'] ) ? esc_url ( $instance['google_plus'] )  : '';
			$skype 		 = isset ( $instance['skype'] ) 	  ? esc_url ( $instance['skype'] ) 	  	  : '';
			$pinterest	 = isset ( $instance['pinterest'] )   ? esc_url ( $instance['pinterest'] )    : '';
			$flickr		 = isset ( $instance['flickr'] )      ? esc_url ( $instance['flickr'] ) 	  : '';
			$instagram 	 = isset ( $instance['instagram'] )   ? esc_url ( $instance['instagram'] )    : '';
			$youtube	 = isset ( $instance['youtube'] )     ? esc_url ( $instance['youtube'] ) 	  : '';
			$bitbucket	 = isset ( $instance['bitbucket'] )   ? esc_url ( $instance['bitbucket'] )    : '';
			$github		 = isset ( $instance['github'] )      ? esc_url ( $instance['github'] ) 	  : '';	
			$foursquare	 = isset ( $instance['foursquare'] )  ? esc_url ( $instance['foursquare'] )   : '';				
			$size 		 = isset ( $instance['size'] )        ? esc_attr ( $instance['size'] )        : '';		
			$style 		 = isset ( $instance['style'] )       ? esc_attr ( $instance['style'] ) 	  : 'style-1';

			echo $before_widget;
		
				if ( $title )
		
			echo $before_title . $title . $after_title; 

	
				if(	$style == 'style-1' ) :
				
					$twitter_icon 	  = 'fa-twitter';				
					$linkedin_icon    = 'fa-linkedin'; 	
					$facebook_icon    = 'fa-facebook'; 				
					$google_plus_icon =	'fa-google-plus';				
					$pinterest_icon   = 'fa-pinterest';				
					$youtube_icon     = 'fa-youtube';		
					$bitbucket_icon   = 'fa-bitbucket';
					$github_icon      = 'fa-github';
				
				else:
				
					$twitter_icon     = 'fa-twitter-square';
					$linkedin_icon    = 'fa-linkedin-square'; 
					$facebook_icon    = 'fa-facebook-square'; 
					$google_plus_icon =	'fa-google-plus-square';
					$pinterest_icon   = 'fa-pinterest-square';
					$youtube_icon     = 'fa-youtube-square';
					$bitbucket_icon   = 'fa-bitbucket-square';
					$github_icon      = 'fa-github-square';
				
				endif;
		
				echo ! empty( $twitter ) 	 ? '<a href="' . esc_url( $twitter ) . '" class="tt" title="Twitter"><i class="fa '. $twitter_icon .' '.$size.'"></i></a>': NULL ;
				echo ! empty( $linkedin )    ? '<a href="' . esc_url( $linkedin ) .'" class="tt" title="Linkedin"><i class="fa '.$linkedin_icon .' '.$size.'"></i></a>': NULL ;
				echo ! empty( $facebook )    ? '<a href="' . esc_url( $facebook ) .'" class="tt" title="Facebook"><i class="fa '.$facebook_icon .' '.$size.'"></i></a>': NULL ;
				echo ! empty( $google_plus ) ? '<a href="' . esc_url( $google_plus ) .'" class="tt" title="Google Plus"><i class="fa '.$google_plus_icon .' '.$size.'"></i></a>': NULL ;
				echo ! empty( $skype ) 	 	 ? '<a href="' . esc_url( $skype ) .'" class="tt" title="Skype"><i class="fa fa-skype '.$size.'"></i></a>': NULL ;
				echo ! empty( $pinterest ) 	 ? '<a href="' . esc_url( $pinterest ) .'" class="tt" title="Pinterest"><i class="fa '.$pinterest_icon .' '.$size.'"></i></a>': NULL ;
				echo ! empty( $flickr ) 	 ? '<a href="' . esc_url( $flickr ) .'" class="tt" title="Flickr"><i class="fa fa-flickr '.$size.'"></i></a>': NULL ;
				echo ! empty( $instagram ) 	 ? '<a href="' . esc_url( $instagram ) .'" class="tt" title="Instagram"><i class="fa fa-instagram '.$size.'"></i></a>': NULL ;
				echo ! empty( $youtube ) 	 ? '<a href="' . esc_url( $youtube ) .'" class="tt" title="Youtube"><i class="fa '.$youtube_icon .' '.$size.'"></i></a>': NULL ;
				echo ! empty( $bitbucket ) 	 ? '<a href="' . esc_url( $bitbucket ) .'" class="tt" title="Bitbucket"><i class="fa '.$bitbucket_icon .' '.$size.'"></i></a>': NULL ;
				echo ! empty( $github ) 	 ? '<a href="' . esc_url( $github ) .'" class="tt" title="Github"><i class="fa '.$github_icon .' '.$size.'"></i></a>': NULL ;
				echo ! empty( $foursquare )  ? '<a href="' . esc_url( $foursquare ) .'" class="tt" title="Foursquare"><i class="fa fa-foursquare '.$size.'"></i></a>': NULL ;
		
			echo $after_widget;
		}

		function update( $new_instance, $old_instance ) {
		
			$instance 	 = $new_instance;				
			$title 		 = isset ( $instance['title'] ) 	  ? esc_url ( $instance['title'] ) 	      : '';
			$twitter	 = isset ( $instance['twitter'] ) 	  ? esc_url ( $instance['twitter'] ) 	  : '';
			$linkedin	 = isset ( $instance['linkedin'] ) 	  ? esc_url ( $instance['linkedin'] ) 	  : '';
			$facebook	 = isset ( $instance['facebook'] ) 	  ? esc_url ( $instance['facebook'] ) 	  : '';
			$google_plus = isset ( $instance['google_plus'] ) ? esc_url ( $instance['google_plus'] )  : '';
			$skype 		 = isset ( $instance['skype'] ) 	  ? esc_url ( $instance['skype'] ) 	  	  : '';
			$pinterest	 = isset ( $instance['pinterest'] )   ? esc_url ( $instance['pinterest'] )    : '';
			$flickr		 = isset ( $instance['flickr'] ) 	  ? esc_url ( $instance['flickr'] ) 	  : '';
			$instagram 	 = isset ( $instance['instagram'] )   ? esc_url ( $instance['instagram'] )    : '';
			$youtube	 = isset ( $instance['youtube'] ) 	  ? esc_url ( $instance['youtube'] )      : '';
			$bitbucket	 = isset ( $instance['bitbucket'] )   ? esc_url ( $instance['bitbucket'] )    : '';
			$github		 = isset ( $instance['github'] ) 	  ? esc_url ( $instance['github'] ) 	  : '';	
			$dribbble	 = isset ( $instance['dribbble'] )    ? esc_url ( $instance['dribbble'] )     : '';
			$foursquare	 = isset ( $instance['foursquare'] )  ? esc_url ( $instance['foursquare'] )   : '';	
			$size 		 = isset ( $instance['size'] )        ? esc_url ( $instance['size'] ) 		  : '';
			$style 		 = isset ( $instance['style'] ) 	  ? esc_url ( $instance['style'] ) 	      : 'style-1';
		
			return $instance;
		}

	
		function form( $instance ) { 
		
			//Defaults
			$instance 		= wp_parse_args( (array) $instance, array( 'title' => '') );
			$title 			= esc_attr( $instance['title'] );			
			$twitter		= isset ( $instance['twitter'] ) 	 ? esc_url ( $instance['twitter'] ) 	 : '';
			$linkedin		= isset ( $instance['linkedin'] ) 	 ? esc_url ( $instance['linkedin'] ) 	 : '';
			$facebook		= isset ( $instance['facebook'] ) 	 ? esc_url ( $instance['facebook'] ) 	 : '';
			$google_plus	= isset ( $instance['google_plus'] ) ? esc_url ( $instance['google_plus'] )  : '';
			$skype 			= isset ( $instance['skype'] ) 		 ? esc_url ( $instance['skype'] ) 		 : '';
			$pinterest		= isset ( $instance['pinterest'] ) 	 ? esc_url ( $instance['pinterest'] ) 	 : '';
			$flickr			= isset ( $instance['flickr'] ) 	 ? esc_url ( $instance['flickr'] ) 	 	 : '';
			$instagram 		= isset ( $instance['instagram'] ) 	 ? esc_url ( $instance['instagram'] )    : '';
			$youtube		= isset ( $instance['youtube'] ) 	 ? esc_url ( $instance['youtube'] ) 	 : '';
			$bitbucket		= isset ( $instance['bitbucket'] ) 	 ? esc_url ( $instance['bitbucket'] )    : '';
			$github			= isset ( $instance['github'] ) 	 ? esc_url ( $instance['github'] ) 	 	 : '';	
			$dribbble		= isset ( $instance['dribbble'] ) 	 ? esc_url ( $instance['dribbble'] )     : '';
			$foursquare		= isset ( $instance['foursquare'] )  ? esc_url ( $instance['foursquare'] )   : '';	
			$size 			= isset ( $instance['size'] ) 		 ? esc_attr ( $instance['size'] ) 		 : '';
			$style 			= isset ( $instance['style'] ) 		 ? esc_attr ( $instance['style'] ) 		 : 'style-1';
		
			?>	
		
			<p><label for="<?php echo $this->get_field_id('title'); ?>"><?php echo __( 'Title:', 'the-chameleon' ); ?></label>
			<input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo $title; ?>" /></p>
		
			<p><label for="<?php echo $this->get_field_id('twitter'); ?>"><?php echo __( 'Twitter:', 'the-chameleon' ); ?></label>
			<input class="widefat" id="<?php echo $this->get_field_id('twitter'); ?>" name="<?php echo $this->get_field_name('twitter'); ?>" type="text" value="<?php echo $twitter; ?>" /></p>

			<p><label for="<?php echo $this->get_field_id('linkedin'); ?>"><?php echo __( 'Linkedin:', 'the-chameleon' ); ?></label>
			<input class="widefat" id="<?php echo $this->get_field_id('linkedin'); ?>" name="<?php echo $this->get_field_name('linkedin'); ?>" type="text" value="<?php echo $linkedin; ?>" /></p>
		
			<p><label for="<?php echo $this->get_field_id('facebook'); ?>"><?php echo __( 'Facebook:', 'the-chameleon' ); ?></label>
			<input class="widefat" id="<?php echo $this->get_field_id('facebook'); ?>" name="<?php echo $this->get_field_name('facebook'); ?>" type="text" value="<?php echo $facebook; ?>" /></p>
		
			<p><label for="<?php echo $this->get_field_id('google_plus'); ?>"><?php echo __( 'Google Plus:', 'the-chameleon' ); ?></label>
			<input class="widefat" id="<?php echo $this->get_field_id('google_plus'); ?>" name="<?php echo $this->get_field_name('google_plus'); ?>" type="text" value="<?php echo $google_plus; ?>" /></p>
	
			<p><label for="<?php echo $this->get_field_id('skype'); ?>"><?php echo __( 'Skype:', 'the-chameleon' ); ?></label>
			<input class="widefat" id="<?php echo $this->get_field_id('skype'); ?>" name="<?php echo $this->get_field_name('skype'); ?>" type="text" value="<?php echo $skype; ?>" /></p>

			<p><label for="<?php echo $this->get_field_id('pinterest'); ?>"><?php echo __( 'Pinterest:', 'the-chameleon' ); ?></label>
			<input class="widefat" id="<?php echo $this->get_field_id('pinterest'); ?>" name="<?php echo $this->get_field_name('pinterest'); ?>" type="text" value="<?php echo $pinterest; ?>" /></p>
	
			<p><label for="<?php echo $this->get_field_id('flickr'); ?>"><?php echo __( 'Flickr:', 'the-chameleon' ); ?></label>
			<input class="widefat" id="<?php echo $this->get_field_id('flickr'); ?>" name="<?php echo $this->get_field_name('flickr'); ?>" type="text" value="<?php echo $flickr; ?>" /></p>

	       	<p><label for="<?php echo $this->get_field_id('instagram'); ?>"><?php echo __( 'Instagram:', 'the-chameleon' ); ?></label>
	       	<input class="widefat" id="<?php echo $this->get_field_id('instagram'); ?>" name="<?php echo $this->get_field_name('instagram'); ?>" type="text" value="<?php echo $instagram; ?>" /></p>

			<p><label for="<?php echo $this->get_field_id('youtube'); ?>"><?php echo __( 'Youtube:', 'the-chameleon' ); ?></label>
	       	<input class="widefat" id="<?php echo $this->get_field_id('youtube'); ?>" name="<?php echo $this->get_field_name('youtube'); ?>" type="text" value="<?php echo $youtube; ?>" /></p>

	        <p><label for="<?php echo $this->get_field_id('bitbucket'); ?>"><?php echo __( 'Bitbucket:', 'the-chameleon' ); ?></label>
	        <input class="widefat" id="<?php echo $this->get_field_id('bitbucket'); ?>" name="<?php echo $this->get_field_name('bitbucket'); ?>" type="text" value="<?php echo $bitbucket; ?>" /></p>

	       <p><label for="<?php echo $this->get_field_id('github'); ?>"><?php echo __( 'Github:', 'the-chameleon' ); ?></label>
	       <input class="widefat" id="<?php echo $this->get_field_id('github'); ?>" name="<?php echo $this->get_field_name('github'); ?>" type="text" value="<?php echo $github; ?>" /></p>

		    <p><label for="<?php echo $this->get_field_id('dribbble'); ?>"><?php echo __( 'Dribbble:', 'the-chameleon' ); ?></label>
	       	<input class="widefat" id="<?php echo $this->get_field_id('dribbble'); ?>" name="<?php echo $this->get_field_name('dribbble'); ?>" type="text" value="<?php echo $dribbble; ?>" /></p>
			
			<p><label for="<?php echo $this->get_field_id('foursquare'); ?>"><?php echo __( 'Foursquare:', 'the-chameleon' ); ?></label>
	       	<input class="widefat" id="<?php echo $this->get_field_id('foursquare'); ?>" name="<?php echo $this->get_field_name('foursquare'); ?>" type="text" value="<?php echo $foursquare; ?>" /></p>
					
			<p><label for="<?php echo $this->get_field_id('size'); ?>"><?php _e('Size:', 'the-chameleon'); ?></label>
			<select id="<?php echo $this->get_field_id('size'); ?>" name="<?php echo $this->get_field_name('size'); ?>" class="widefat">
				<?php $sizes = array( 
								  '' 	 => ' --- ' , 
								 'fa-lg' => 'Large', 
								 'fa-2x' => '2x', 
								 'fa-3x' => '3x', 
								 'fa-4x' => '4x', 
								 'fa-5x' => '5x'
								);
				 foreach ( $sizes as $key => $value ) : ?>
					<option value="<?php echo $key ?>" <?php echo $key == $size ? 'selected="selected"' : '' ?>><?php echo $value ?></option>
				<?php endforeach; ?>
			</select></p>
			
			<p><label for="<?php echo $this->get_field_id('style'); ?>"><?php _e('Style:', 'the-chameleon'); ?></label>
			<select id="<?php echo $this->get_field_id('style'); ?>" name="<?php echo $this->get_field_name('style'); ?>" class="widefat">
				<?php $styles = array( 
									'style-1' => 'Normal', 
									'style-2' => 'Square'
								   );
				 foreach ( $styles as $key => $value ) : ?>
					<option value="<?php echo $key ?>" <?php echo $key == $style ? 'selected="selected"' : '' ?>><?php echo $value ?></option>
				<?php endforeach; ?>
			</select></p>

	<?php
		}

	}


