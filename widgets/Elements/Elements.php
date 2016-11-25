<?php
	/**
	 * Elements Widget
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
	class TheChameleon_Elements_Widget extends WP_Widget {

		function __construct() {
			$widget_ops = array( 'classname' => 'widget_elements', 'description' => __( "Add site elements Logo, Breadcrumb, Title or Copyright.", 'the-chameleon' ) );
			parent::__construct('TheChameleon_Widget_Elements', __('Elements - The Chameleon', 'the-chameleon'), $widget_ops);
		}

		function widget( $args, $instance ) {
			extract( $args );		
		
			$title 		= apply_filters( 'widget_title', empty( $instance['title'] ) ? __( 'Elements', 'the-chameleon' ) : $instance['title'], $instance, $this->id_base );			
			$element 	= isset ( $instance ['element'] ) 	? esc_attr ( $instance ['element'] ) 	: 'logo';		
			$delimiter  = isset ( $instance ['delimiter'] ) ? esc_attr ( $instance ['delimiter'] ) 	: '»';
			$logo 		= isset ( $instance ['logo'] ) 		? esc_url( $instance ['logo'] )   		: get_template_directory_uri().'/img/logo.png';
			$logo_sticky= isset ( $instance ['logo_sticky'] ) ? esc_url( $instance ['logo_sticky'] ): get_template_directory_uri().'/img/logo.png';
			$logo_type  = isset ( $instance ['logo_type'] ) ? esc_attr ( $instance ['logo_type'] )	: 'image';
			$copyright  = isset ( $instance ['copyright'] ) ? $instance ['copyright'] 				: 'Copyright &copy; %year% '.get_bloginfo('name').'. <a href="https://chameleonthemes.net">The Chameleon</a> Theme. Powered by <a href="http://wordpress.org">WordPress</a>.';			

			echo $before_widget;
		
			global $data;
		
			echo $before_title . ' ' . $after_title; 

				if( $element == 'logo' ) :
				
					$logo_text 		= get_bloginfo( 'name' );
					$logo_sub_text 	= get_bloginfo( 'description' ) ;
					
					if ( $logo_type == "image" ) : 
						echo '<figure class="logo">';
							echo '<a href="'.site_url().'"><img src="'.esc_url( $logo ).'" alt="'.$logo_text.'" class="logo logo_no_sticky"/></a>';
							echo '<a href="'.site_url().'"><img src="'.esc_url( $logo_sticky ).'" alt="'.$logo_text .'" class="logo logo_sticky"/></a>';
						echo '</figure>';
				 else :
			
						echo '<hgroup class="logo"><h1 class="site-name"><a href="' . esc_url( site_url() ).'">'. $logo_text .'</a></h1>'.'<h3 class="site-description">'. $logo_sub_text .'</h3></hgroup>';

					endif ; 
					
				elseif( $element == 'breadcrumb' ):	
							
					$data['delimiter']	= $delimiter;
							
					get_template_part( 'parts/Breadcrumb/view/breadcrumb' );
					
				elseif( $element == 'copyright' ):		
							
				 	$year 	 = date('Y');	
				
					?><p id="copyright"><?php echo str_replace( "%year%", $year, $copyright ); ?></p><?php
			

				elseif( $element == 'title' ):			
					
					get_template_part( 'parts/Title/view/title' );
							
				elseif( $element == 'date' ):	?>
									
					<span class="part-date">
						<?php if ( get_option( 'timezone_string' ) ) :		
							  	date_default_timezone_set( get_option( 'timezone_string' ) );			
							  endif;			
							  echo date( get_option( 'date_format' ), current_time( 'timestamp', get_option( 'gmt_offset' ) ) ); 
						?>
					</span> <!-- #date -->
					
				<?php			
				else:
	
				endif;

			echo $after_widget;
		}

		function update( $new_instance, $old_instance ) {
		
			$instance 	= $new_instance;				
			$title 		= isset ( $instance ['title'] ) 	? esc_attr ( $instance ['title'] ) 		: '';		
			$element 	= isset ( $instance ['element'] ) 	? esc_attr ( $instance ['element'] ) 	: 'logo';
			$delimiter 	= isset ( $instance ['delimiter'] ) ? esc_attr ( $instance ['delimiter'] )  : '»';	
			$logo 		= isset ( $instance ['logo'] ) 		? esc_url( $instance ['logo'] )  		: get_template_directory_uri().'/img/logo.png';
			$logo_sticky= isset ( $instance ['logo_sticky'] )? esc_url( $instance ['logo_sticky'] ) : get_template_directory_uri().'/img/logo.png';
			
			$logo_type  = isset ( $instance ['logo_type'] ) ? esc_attr( $instance ['logo_type'] ) 	: 'image';
			$copyright  = isset ( $instance ['copyright'] ) ? $instance ['copyright'] 				: 'Copyright &copy; %year% '.get_bloginfo('name').'. <a href="https://chameleonthemes.net">The Chameleon</a> Theme. Powered by <a href="http://wordpress.org">WordPress</a>.';	

			return $instance;
		}

		function form( $instance ) { 
		
			//Defaults
			$instance 	= wp_parse_args( (array) $instance, array( 'title' => '') );
			$title 		= esc_attr( $instance['title'] );					
			$element 	= isset ( $instance ['element'] ) 	? esc_attr ( $instance ['element'] ) 	: 'logo';
			$delimiter 	= isset ( $instance ['delimiter'] ) ? esc_attr ( $instance ['delimiter'] ) 	: '»';
			$logo 		= isset ( $instance ['logo'] ) 		? esc_url( $instance ['logo'] )			: get_template_directory_uri().'/img/logo.png';
			$logo_sticky= isset ( $instance ['logo_sticky'] ) ? esc_url( $instance ['logo_sticky'] )  		: get_template_directory_uri().'/img/logo.png';
			$logo_type  = isset ( $instance ['logo_type'] ) ? esc_attr( $instance ['logo_type'] ) 	: 'image';
			$copyright  = isset ( $instance ['copyright'] ) ? $instance ['copyright'] 				: 'Copyright &copy; %year% '.get_bloginfo('name').'. <a href="https://chameleonthemes.net">The Chameleon</a> Theme. Powered by <a href="http://wordpress.org">WordPress</a>.';
			
		 	?>	
				
			<p><label for="<?php echo $this->get_field_id('title'); ?>"><?php echo __( 'Title:', 'the-chameleon' ); ?></label>
			<input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo $title; ?>" /></p>
		
			<p><label for="<?php echo $this->get_field_id('element'); ?>"><?php _e('Element:', 'the-chameleon'); ?></label>
			<select id="<?php echo $this->get_field_id('element'); ?>" name="<?php echo $this->get_field_name('element'); ?>" class="widefat">	
						
				<?php $elements = array(
									'logo'		 => 'Logo', 
									'breadcrumb' => 'Breadcrumb', 
									'title'		 => 'The Title', 
									'date'		 => 'Date', 
									'copyright'	 => 'Copyright'
								  );
				?>					
				<?php foreach ( $elements as $key => $value ) : ?>
					<option value="<?php echo $key ?>" <?php echo $key == $element ? 'selected="selected"' : '' ?>><?php echo $value ?></option>
				<?php endforeach; ?>
			</select></p>
		
			
			<p><label for="<?php echo $this->get_field_id('logo_type'); ?>"><?php _e('Logo Type:', 'the-chameleon'); ?></label>
			<select id="<?php echo $this->get_field_id('logo_type'); ?>" name="<?php echo $this->get_field_name('logo_type'); ?>" class="widefat">					

				<?php $logo_types = array(
										'image' => __('Image', 'the-chameleon'), 
										'text'  => __('Text', 'the-chameleon'), 
									);
				?>		
				<?php foreach ( $logo_types as $key => $value ) : ?>	
					<option value="<?php echo $key ?>" <?php echo $key == $logo_type ? 'selected="selected"' : '' ?>><?php echo $value ?></option>	
				<?php endforeach; ?>				
			</select></p>
			

			<p><label for="<?php echo $this->get_field_id('logo'); ?>"><?php echo __( 'Logo:', 'the-chameleon' ); ?></label>
			<input class="widefat" id="<?php echo $this->get_field_id('logo'); ?>" name="<?php echo $this->get_field_name('logo'); ?>" type="url" value="<?php echo esc_url( $logo ); ?>" placeholder="Enter your logo url" /></p>

			<p><label for="<?php echo $this->get_field_id('logo_sticky'); ?>"><?php echo __( 'Logo Sticky:', 'the-chameleon' ); ?></label>
			<input class="widefat" id="<?php echo $this->get_field_id('logo_sticky'); ?>" name="<?php echo $this->get_field_name('logo_sticky'); ?>" type="url" value="<?php echo esc_url( $logo_sticky ); ?>" placeholder="Enter your logo url" /></p>
			

	
			<p><label for="<?php echo $this->get_field_id('copyright'); ?>"><?php _e('Copyright:', 'the-chameleon'); ?> <br /> <textarea
				id="<?php echo $this->get_field_id('copyright'); ?>"
				name="<?php echo $this->get_field_name('copyright'); ?>" class="widefat"
				><?php echo $copyright ?></textarea></label></p>
				
	
			<p><label for="<?php echo $this->get_field_id('delimiter'); ?>"><?php _e('Breadcrumb delimiter:', 'the-chameleon'); ?></label>
					<select id="<?php echo $this->get_field_id('delimiter'); ?>" name="<?php echo $this->get_field_name('delimiter'); ?>" class="widefat">					
				
						<?php $delimiters = array(
												 '›', 
											 	 '»', 
											 	 '/', 
											 	 '|', 
												 '●', 
												 '•',
												 '→'
											);
						?>		
						<?php foreach ( $delimiters as $value ) : ?>	
							<option value="<?php echo $value ?>" <?php echo $value == $delimiter ? 'selected="selected"' : '' ?>><?php echo $value ?></option>	
						<?php endforeach; ?>				
					</select></p>
			

	
	
	
	<?php
		}

	}