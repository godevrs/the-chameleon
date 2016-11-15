<?php

	namespace TheChameleon;


	/**
	 * Theme Bootstrap  
	 *
	 * This is bootstrap for GOX WordPress Framework
	 * 
	 *
	 * @author 		Goran Petrovic <goran.petrovic@godev.rs>
	 * @link 		http://wwww.godev.rs
	 * @package     WordPress
	 * @subpackage  GoX 
	 * @since 		GoX 1.0.0
	 *
	 * @version 	1.0.0
	 *
	 **/	
	class Bootstrap{

		public $slug;
		
		function __construct(){
							
			//add slug
			$config = Config::getInstance();
			$this->slug	= $config->slug;
							
			//get widgets and sidebars
			$Sidebars = new Sidebars();
					
			//Skins
			$Skins 	  = new Skins();
			
			//set parts
			$parts = $this->parts();
					
			//Meta boxes
			$MetaBoxes = new Meta_Boxes( $parts );

			//Customize Options
			$Customize = new Customize( $parts );
		
			//Term Options 
			$TermMeta = new Term_Meta( $parts );

				//add style and scripts
				add_action( 'wp_enqueue_scripts', array(&$this, 'scripts_and_styles' ));

				//theme supports
				add_action( 'after_setup_theme', array(&$this, 'theme_supports') );

				//custom css
				add_action('wp_head', array(&$this, 'custom_css'), 10, 2);

				//wp_title	
				add_filter( 'wp_title',  array(&$this, 'wp_title') );

				//load_theme_textdomain	
				add_action('after_setup_theme', array(&$this, 'load_theme_textdomain') );

				//admin_enqueue_scripts	
				add_action('admin_enqueue_scripts',  array(&$this, 'admin_scripts_and_styles') );

				//setup theme widgets
			 	add_action("after_switch_theme",  array(&$this, "after_switch_theme" ) );
			
			
				add_action('admin_menu',  array(&$this, 'theme_doc_menu' ) );
			
		}
		
		/**
		 * 	Theme doc menu
		 *
		 * @author Goran Petrovic
		 * @since 1.0
		 *
		 **/
		function theme_doc_menu() {
			add_theme_page('The Chameleon Doc', 'Theme Docs', 'edit_theme_options', 'the-chameleon-docs', array(&$this, 'theme_doc' ) );
		}
		
		/**
		 * 	Theme doc page
		 *
		 * @author Goran Petrovic
		 * @since 1.0
		 *
		 **/
		function theme_doc(){

			echo '<iframe src="https://chameleonthemes.net/docs" style="width:100%; border:0px; height:800px;"></iframe>';
		}
		
		/**
		 * 	Admin init 
		 *
		 * @author Goran Petrovic
		 * @since 1.0
		 *
		 **/
		function admin_init(){
			wp_redirect(admin_url('themes.php?page=the-chameleon-docs'));
			exit;
		}
		
		
		/**
		 * 	after switch theme 
		 *
		 * @author Goran Petrovic
		 * @since 1.0
		 *
		 **/	
		function after_switch_theme(){
			add_action('admin_init',  array(&$this, 'admin_init' ) );
	
		}


		/**
		 * 	Set all parts in to $this->part name  PARTS
		 *
		 * @author Goran Petrovic
		 * @since 1.0
		 *
		 **/
		 private function parts(){
			
			 $config = Config::getInstance();
		
			//register all parts like part name == class name	
			foreach (glob( get_template_directory().'/parts/*', GLOB_ONLYDIR ) as $paths) :
				$dir = explode('/', $paths);	
				$part =  end($dir);
				$this->parts[] = $part;
				//namespace class name, replace the ' fix 
				$class_name = str_replace("'",'',$config->namespace."\'".$part);				
				$this->{$part}  = new $class_name();	
				$parts[$part]  	= $this->{$part};						
			endforeach;
						
			return 	$parts;
			
		}
		
		
		
		/**
		* HTML5 template Generator
		*
		* Use this funtion to generate html5 elements (from arrays from framework/templates dir) with id and classes 
		* and call in to them parts from part directory
		*
		* @var $template array()
		* @return html	
		**/
		public function render_template( $template ) { 

			//VREDNOSTI ZA WRAP-ove
			$wraps 	  		  = array();
			$key 			  = NULL;	
			$element['class'] = NULL;

			if ( !empty( $template ) ) :


				foreach ( $template as $element ) : 

					if ( !empty( $element['id'] ) ) :

						$key  			= ( !empty( $element['id'] ) ) ? $element['id'] : '0';
						$custom_class 	= ( !empty( $element['class'] ) ) ? $element['class'] : 'no-class';

						$wrap[ $key ] 	= !empty( $element['wrap'] ) ? $element['wrap'] : ( ( !empty( $wraps ) and !empty( $wraps[ $key ]['wrap'] ) ) ? $wraps[ $key ]['wrap'] : 'normal' ) ;

						//html tag
						global $is_IE;
					    if ( $is_IE ): 				
							$tag[ $key ] = ( $element[ 'tag' ] == 'main' ) ? 'div' : $element[ 'tag' ];			
						else:						
							$tag[ $key ] = ( !empty( $element['tag'] ) ) ? $element['tag'] : 'div'; 					
						endif; 	

						//ID
						$id[ $key ] 			= $key;		
						$id_container[ $key ] 	= $key.'-container';

						//custom class			
						$my_class_container[ $key ] = $custom_class .'-container';

						//class	
						$class[ $key ] 			= $key .' col100 '.$custom_class;		 /*	= $key .' col100 '. $this->get_body_class( $key ).' '.$custom_class;*/		
						$class_container[$key] 	= 'container '. $key .'-container';

						echo strtoupper("<!-- START $key -->"); 

				 		//normal container 
						if ( $wrap[ $key ] == 'normal' and $wrap[ $key ] != 'fullwidth' ) echo '<div id="'. esc_attr( $id_container[ $key ] ) .'" class="'. esc_attr( $class_container[ $key ] ) .'">'; 

					   		//element wrap
					    	echo ' <'.$tag[ $key ].' id="'. esc_attr( $id[ $key ] ) .'" class="'. esc_attr( $class[$key] ) .'"> '; 

					      	   //stretch container 
								if ( $wrap[ $key ] == 'stretch' and $wrap[ $key ] != 'fullwidth' ) echo '<div id="'. esc_attr( $id_container[ $key ] ) .'" class="'. esc_attr( $class_container[ $key ]) .'">';

									//PARTS
									if ( ($element['parts'] ) ):

											foreach ( $element['parts'] as $part_key => $value ): 

												$tag[ $part_key ] 	= ( $value['tag'] ) ? $value['tag']  : 'div';
												$id[ $part_key ] 	= $value['id']; 
												$my_class 			= ( ($value['class'] ) ) ? $value['class']: '';			
												$class[ $part_key ] = 'col100 '.$id[ $part_key ] .' '. $my_class;			

													//html tag
													echo ' <' . $tag[ $part_key ] .' id="' . esc_attr( $id[ $part_key ] ) . '" class="' . esc_attr( $class[ $part_key ] ) . '"> ';

															global $data; //get part setting	
															$data = !empty( $value['setting'] ) ? $value['setting'] : NULL;

															if ( is_dir(  get_template_directory().'/parts/'.$value['part'] ) ):

																//define part view
																$view = !empty( $data['view'] )  ? $data['view'] : $value['part'];


																if ( file_exists( get_template_directory().'/parts/'.$value['part'].'/view/'.strtolower( $view ).'.php' ) ) :

																	$part = $value['part'];
														
																	//set data in to the Part object
																	if( method_exists($this->{$part}, 'set_data') ) :
																		$this->{$part}->set_data( $data );
																	 endif;


																	//call Part view
																	if( method_exists($this->{$part}, 'view') ) :
																		$this->{$part}->view( strtolower( $view ) ); 
																	endif;



																else:	
																	echo "View does not exists in $value[part] part";
																endif;	

															else:	

																echo "Part $value[part] does not exists";

															endif; 

													//end html tag		
													echo ' </' . $tag[ $part_key ] . '> ';		


									 	 endforeach;

									endif;	

					       		 //stretch container 
								 echo ( $wrap[ $key ] == 'stretch' and $wrap[ $key ] != 'fullwidth' ) ? ' </div> ' : ''; 

				   			//element wrap
				    		echo ' </'.$tag[ $key ].'> '; 

						 //normal container 
						echo ( $wrap[ $key ] == 'normal' and $wrap[ $key ] != 'fullwidth' ) ? ' </div> ' : '' ; 

						echo strtoupper("<!-- END $key -->"); 

				 		unset( $data );
						unset( $element );
					 	unset( $wrap );

					endif;

				endforeach; 

			endif;

		}

		/**
		 * Make new body clasees 
		 *
		 * Koritim ovo da bi promenuo imena kalsa za body 
		 *
		 * @author Goran Petrovic
		 * @since 1.0
		 *
		 * @param string $class 
		 * @param boolean $echo 
		 * @return string  classes names
		 **/	

		function get_body_class( $class = 'custom', $echo = false ){

			ob_start();

				body_class();	

			$body_class = ob_get_contents();
			ob_end_clean();

			$body_class = str_replace(array('class="', '"'),array('',''),	$body_class);

			if(!empty($class)) :

				$class_array = explode(" ", $body_class);	

				//lats class fix
				$last = count($class_array)-1;	
				$class_array[$last] = $class_array[$last].'-'.$class;

				$body_class = implode("-$class ", $class_array);

			endif;

			if($echo) :
				echo $body_class;			
			else:
				return $body_class;	
			endif;
		}


	
		/**
		 * Create meta by pattern  
		 *
		 * @author Goran Petrovic
		 * @since 1.0
		 *
		 * @param string $pattern '%author%', '%date%', '%categories%','%category%', '%comments%'
		 * @return html meta ordber by pattern in <span>
		 **/	
		function get_meta_view( $pattern ){

			global $post;

				$meta_autor = '<span class="mta-item meta-author" itemprop="author"><a href="' . get_author_posts_url( get_the_author_meta( 'ID' ) ) . '">' . get_the_author() . '</a></span>';
				$meta_date = '<span class="meta-item meta-date"><a href="' . get_month_link( get_the_time( 'Y' ), get_the_time( 'm' ) ) . '" itemprop="datePublished">' . get_the_date() . '</a></span>';

				$post_type = get_post_type();

				if ( $post_type == 'post') :

					$get_the_categoriy = get_the_category();		
				    $single_category   = '<a href="' . get_category_link( $get_the_categoriy[0]->term_id ).'" >' . $get_the_categoriy[0]->cat_name . '</a>';	

					$categories = '';
					foreach( $get_the_categoriy as $category ) :
					    $categories .= '<a href="'.get_category_link( $category->term_id ).'">' . $category->cat_name . '</a>, ';
					endforeach;

				else: 
					$single_category = '';
					$categories 	 = '';

				endif;

				$meta_category 	 = '<span class="meta-item meta-category" itemprop="articleSection">' . $single_category . '</span>';
				$meta_categories = '<span class="meta-item meta-category meta-categories" itemprop="articleSection">' .rtrim( $categories,', ' ) . '</span>';
				$meta_comments   = '<span class="meta-item meta-comments" ><a href="' . get_permalink() . '#comments" itemprop="commentCount" content="' . get_comments_number('0','1','%') . '">' . get_comments_number('0','1','%') .' ' . __('Comments', 'the-chameleon') . '</a></span>';

				$finde 			= array( '%author%', '%date%', '%categories%','%category%', '%comments%' );
				$replace 		= array( $meta_autor, $meta_date, $meta_categories, $meta_category, $meta_comments );

				return str_replace( $finde, $replace, htmlspecialchars_decode($pattern) );

		}
	
	
		/**
		 * Is post have media
		 *
		 * @author Goran Petrovic
		 * @since 1.0
		 *	 
		 * @param int $post_id 
		 * @return boolean
		 **/
		function has_post_media( $post_id = NULL ){

			global $post;

			$post_id = !empty( $post_id ) ? $post_id : $post->ID;	
			
			$post_meta  = get_post_meta($post_id,  $this->slug.'meta', TRUE );
		
			if ( !empty( $post_meta['featured_media'] ) ) :
				return TRUE;
			else:			    
				return FALSE;
			endif;

		}
		
		/**
		 * Has post have audio  
		 *
		 * @author Goran Petrovic
		 * @since 1.0
		 *
		 * @param int $post_id 
		 * @return boolean
		 **/
		function has_post_audio( $post_id = NULL ){

			global $post;

			$post_id = !empty( $post_id ) ? $post_id : $post->ID;	
			
			$post_meta  = get_post_meta($post_id,  $this->slug.'meta', TRUE );
	
			if ( !empty( $post_meta['featured_audio'] ) ) :
				return TRUE;
			else:				
				return FALSE;
			endif;

		}
		
		/**
	     * Get featured media. If have video show video if have featured image 
	     * show image...
	     *
	     * @author Goran Petrovic
	     * @since 1.0
	     *
	     * @param int $post_id 
	     * @param int $width 		 
	     * @param int $height 		 
	     * @param array $att html attributes 
	     * @param boolean $linked are media have link or not 
	     * @param boolean $force_image if have video fors to show image
	     * @param array $icons ImaheHover JS script...
	     * @return html embed, iframe foe youtube, vimeo, html5 video, image
	     **/		
		function get_post_featured_media( $post_id, $format = 'standard', $attr = array() ){

			if ( $format == 'video') :

					//if video have image
					if ( has_post_thumbnail( $post_id ) and !is_single() ) :

						return the_post_thumbnail( 'full', $attr ) ;
					//if video dont have image	
					else :
						$post_meta  = get_post_meta($post_id,  $this->slug.'meta', TRUE );
	
					/*	$attr = array('width'=>'750', 'height'=>'450');*/
						
						return  ( !empty( $post_meta['featured_media'] ) ) ?  wp_oembed_get( $post_meta['featured_media'], $attr ) : NULL ;

					endif;


			elseif ( $format == 'audio' ) :

					//if audio have image
					if ( has_post_thumbnail( $post_id ) and !is_single() ) : 

						return the_post_thumbnail('full', $attr) ;

					else :
						
						$post_meta  = get_post_meta($post_id,  $this->slug.'meta', TRUE );
					 	return ( !empty( $post_meta['featured_audio'] ) ) ?  wp_audio_shortcode( array( 'src' => $post_meta['featured_audio']  ) ) : NULL;

					endif;

			elseif ($format == 'image'):

				if ( has_post_thumbnail( $post_id ) ) : 
					return the_post_thumbnail('full', $attr);  // Other resolutions
				endif;	

			else: 

				if ( has_post_thumbnail( $post_id ) ) : 
					return the_post_thumbnail( 'thumbnail', $attr );  
				endif;

			endif;

		}
	
	
		/**
		 * Crop excerpt characters to custom length
		 *
		 * @author Goran Petrovic
		 * @since 1.0
		 *
		 * @param int $charlength 
		 * @param string $link_more show more [...] or hide
		 * @param boolean $echo 
		 * @return string html 
		 **/
		function the_excerpt_maxlength( $charlength, $link_more = 'show', $echo = TRUE) {

			global $post;

			$excerpt = get_the_excerpt();
			$charlength++;

			if ( mb_strlen( $excerpt ) > $charlength ) {
				$subex = mb_substr( $excerpt, 0, $charlength - 5 );
				$exwords = explode( ' ', $subex );
				$excut = - ( mb_strlen( $exwords[ count( $exwords ) - 1 ] ) );
				if ( $excut < 0 ) {
					$new_excerpt = mb_substr( $subex, 0, $excut );
				} else {
					$new_excerpt = $subex;
				}

				if ( $echo ):
					echo '<p>'.$new_excerpt.'<a href="' . get_permalink( $post->ID ) . '"> [...]</a></p>';
				else:
					return '<p>'.$new_excerpt.'<a href="' . get_permalink( $post->ID ) . '"> [...]</a></p>';
				endif;

			} else {

				if ( $echo ):	
					echo '<p>'.$excerpt.'</p>'; 	
				else: 
					return '<p>'.$excerpt.'</p>';	
				endif;

			}

		}

	
		/**
		 * 	Short text on character limit
		 *
		 * @author Goran Petrovic
		 * @since 1.0
		 *
		 **/
		function the_title_maxlength( $text, $chars_limit )
		{
		    // Check if length is larger than the character limit
		    if ( strlen( $text ) > $chars_limit )
		    {
		        // If so, cut the string at the character limit
		        $new_text = substr( $text, 0, $chars_limit );
		        // Trim off white space
		        $new_text = trim( $new_text );
		        // Add at end of text ...
		        return $new_text . "...";
		    }
		    // If not just return the text as is
		    else
		    {
		    return $text;
		    }
		}

   
  	   	/**
		 * 	Set skripts and styles
		 *
		 * @author Goran Petrovic
		 * @since 1.0
		 *
		 **/
   	    function scripts_and_styles(){
			
    		global $TheChameleonMeta;
    		global $TheChameleonOption;
    		global $TheChameleonTerm;
			
   	    	//style
   	    	wp_enqueue_style( 'the-chameleon', get_stylesheet_uri() );
      			
			include_once( ABSPATH . 'wp-admin/includes/plugin.php' );
			if ( !is_plugin_active( 'the-chameleon-css-generator/the-chameleon-css-generator.php' ) ) :
				
			
				if ( isset( $_COOKIE['theskin'] ) ) :
								
					$TheChameleonOption['skin'] = $_COOKIE['theskin'] ;
					
				endif;
			
				
				
				//skin
				wp_register_style( 'the-chameleon-skin', $TheChameleonOption['skin'], array('the-chameleon') );
				wp_enqueue_style( 'the-chameleon-skin' );
					
			endif;
		
			
			//responsive style
   	    	wp_enqueue_style( 'the-chameleon-responsove', get_template_directory_uri().'/css/responsove.css', array('the-chameleon') );
   	    	if ( !is_admin() ) :	
      
   	    		//functions			
   	    		wp_enqueue_script( 'the-chameleon-functions', get_template_directory_uri()  .'/js/functions.js', array( 'jquery' ), '1.0.0'  );
      
   	    		global $TheChameleonMeta;
   	    		global $TheChameleonOption;
   	    		global $TheChameleonTerm;
      
   	    		$data = array(
					
					
					'sticky_header'         => !empty( $TheChameleonOption['header_sticky'] ) 		? $TheChameleonOption['header_sticky'] 		: '', 					
					'primary_menu_sticky'   => !empty( $TheChameleonOption['primary_menu_sticky'] ) ? $TheChameleonOption['primary_menu_sticky'] : '', 	
					'upper_sticky' 			=> !empty( $TheChameleonOption['upper_sticky'] ) 		? $TheChameleonOption['upper_sticky'] : '', 
					
					
   	    			'site_url'				=> site_url(),
      
   	    			'upper_animate'			=> !empty( $TheChameleonOption['upper_animate'] ) 		? $TheChameleonOption['upper_animate'] 		: 'fadeIn',
   	    			'upper_duration'		=> !empty( $TheChameleonOption['upper_duration'] ) 		? $TheChameleonOption['upper_duration'] 	: 'animated07',
   	    			'upper_delay'			=> !empty( $TheChameleonOption['upper_delay'] ) 		? $TheChameleonOption['upper_delay'] 		: 'delay03',
      
   	    			'header_animate'		=> !empty( $TheChameleonOption['header_animate'] ) 		? $TheChameleonOption['header_animate'] 	: 'fadeIn',
   	    			'header_duration'		=> !empty( $TheChameleonOption['header_duration'] ) 	? $TheChameleonOption['header_duration'] 	: 'animated07',
   	    			'header_delay'			=> !empty( $TheChameleonOption['header_delay'] ) 		? $TheChameleonOption['header_delay'] 		: 'delay03',
      
   	    			'top_animate'			=> !empty( $TheChameleonMeta['top_animate'] ) 			? $TheChameleonMeta['top_animate']   		: ( !empty ( $TheChameleonOption['top_animate'] ) 	? $TheChameleonOption['top_animate']  	: 'fadeIn' ),
   	    			'top_duration'			=> !empty( $TheChameleonMeta['top_duration'] ) 			? $TheChameleonMeta['top_duration'] 		: ( !empty ( $TheChameleonOption['top_duration'] ) 	? $TheChameleonOption['top_duration']  	: 'animated07' ),
   	    			'top_delay'				=> !empty( $TheChameleonMeta['top_delay'] ) 			? $TheChameleonMeta['top_delay'] 		 	: ( !empty ( $TheChameleonOption['top_delay'] ) 	? $TheChameleonOption['top_delay']  	: 'delay03' ),
      
   	    			'menu_animate'			=> !empty( $TheChameleonOption['menu_animate'] ) 		? $TheChameleonOption['menu_animate']   	: 'fadeIn' ,
   	    			'menu_duration'			=> !empty( $TheChameleonOption['menu_duration'] ) 		? $TheChameleonOption['menu_duration'] 		: 'animated07' ,
   	    			'menu_delay'			=> !empty( $TheChameleonOption['menu_delay'] ) 			? $TheChameleonOption['menu_delay'] 	   	: 'delay03' ,
      
   	    			'archive_animate'		=> !empty( $TheChameleonTerm['archive_animate'] ) 		? $TheChameleonTerm['archive_animate']   	: ( !empty ( $TheChameleonOption['archive_animate'] ) 	? $TheChameleonOption['archive_animate']  	: 'fadeIn' ),
   	    			'archive_duration'		=> !empty( $TheChameleonTerm['archive_duration'] ) 		? $TheChameleonTerm['archive_duration'] 	: ( !empty ( $TheChameleonOption['archive_duration'] ) 	? $TheChameleonOption['archive_duration']  	: 'animated07' ),
   	    			'archive_delay'			=> !empty( $TheChameleonTerm['archive_delay'] ) 		? $TheChameleonTerm['archive_delay'] 	   	: ( !empty ( $TheChameleonOption['archive_delay'] ) 	? $TheChameleonOption['archive_delay']  	: 'delay03' ) ,
      
   	    			'sidebar_animate'		=> !empty( $TheChameleonMeta['sidebar_animate'] ) 		? $TheChameleonMeta['sidebar_animate']   	: ( !empty ( $TheChameleonOption['sidebar_animate'] ) 	? $TheChameleonOption['sidebar_animate']  	: 'fadeIn' ),
   	    			'sidebar_duration'		=> !empty( $TheChameleonMeta['sidebar_duration'] ) 		? $TheChameleonMeta['sidebar_duration'] 	: ( !empty ( $TheChameleonOption['sidebar_duration'] ) 	? $TheChameleonOption['sidebar_duration']  	: 'animated07' ) ,
   	    			'sidebar_delay'			=> !empty( $TheChameleonMeta['sidebar_delay'] ) 		? $TheChameleonMeta['sidebar_delay'] 	   	: ( !empty ( $TheChameleonOption['sidebar_delay'] ) 	? $TheChameleonOption['sidebar_delay']  	: 'delay03' ),
      
   	    			'sidebar_two_animate'	=> !empty( $TheChameleonMeta['sidebar_two_animate'] ) 	? $TheChameleonMeta['sidebar_two_animate']  : ( !empty ( $TheChameleonOption['sidebar_two_animate'] ) 	? $TheChameleonOption['sidebar_two_animate']  	: 'fadeIn' ),
   	    			'sidebar_two_duration'	=> !empty( $TheChameleonMeta['sidebar_two_duration'] ) 	? $TheChameleonMeta['sidebar_two_duration'] : ( !empty ( $TheChameleonOption['sidebar_two_duration'] ) 	? $TheChameleonOption['sidebar_two_duration']  	: 'animated07' ) ,
   	    			'sidebar_two_delay'		=> !empty( $TheChameleonMeta['sidebar_two_delay'] ) 	? $TheChameleonMeta['sidebar_two_delay'] 	: ( !empty ( $TheChameleonOption['sidebar_two_delay'] ) 	? $TheChameleonOption['sidebar_two_delay']  	: 'delay03' ) ,
      
   	    			'section_1_animate'		=> !empty( $TheChameleonMeta['section_1_animate'] ) 	? $TheChameleonMeta['section_1_animate'] 	: 'fadeIn',
   	    			'section_1_duration'	=> !empty( $TheChameleonMeta['section_1_duration'] ) 	? $TheChameleonMeta['section_1_duration'] 	: 'animated07',
   	    			'section_1_delay'		=> !empty( $TheChameleonMeta['section_1_delay'] ) 		? $TheChameleonMeta['section_1_delay'] 		: 'delay03',
      
   	    			'section_2_animate'		=> !empty( $TheChameleonMeta['section_2_animate'] ) 	? $TheChameleonMeta['section_2_animate'] 	: 'fadeIn',
   	    			'section_2_duration'	=> !empty( $TheChameleonMeta['section_2_duration'] ) 	? $TheChameleonMeta['section_2_duration'] 	: 'animated07',
   	    			'section_2_delay'		=> !empty( $TheChameleonMeta['section_2_delay'] ) 		? $TheChameleonMeta['section_2_delay'] 		: 'delay03',
      
   	    			'section_3_animate'		=> !empty( $TheChameleonMeta['section_3_animate'] ) 	? $TheChameleonMeta['section_3_animate'] 	: 'fadeIn',
   	    			'section_3_duration'	=> !empty( $TheChameleonMeta['section_3_duration'] ) 	? $TheChameleonMeta['section_3_duration'] 	: 'animated07',
   	    			'section_3_delay'		=> !empty( $TheChameleonMeta['section_3_delay'] ) 		? $TheChameleonMeta['section_3_delay'] 		: 'delay03',
      
   	    			'section_4_animate'		=> !empty( $TheChameleonMeta['section_4_animate'] ) 	? $TheChameleonMeta['section_4_animate'] 	: 'fadeIn',
   	    			'section_4_duration'	=> !empty( $TheChameleonMeta['section_4_duration'] ) 	? $TheChameleonMeta['section_4_duration'] 	: 'animated07',
   	    			'section_4_delay'		=> !empty( $TheChameleonMeta['section_4_delay'] ) 		? $TheChameleonMeta['section_4_delay'] 		: 'delay03',
      
   	    			'section_5_animate'		=> !empty( $TheChameleonMeta['section_5_animate'] ) 	? $TheChameleonMeta['section_5_animate'] 	: 'fadeIn',
   	    			'section_5_duration'	=> !empty( $TheChameleonMeta['section_5_duration'] ) 	? $TheChameleonMeta['section_5_duration'] 	: 'animated07',
   	    			'section_5_delay'		=> !empty( $TheChameleonMeta['section_5_delay'] ) 		? $TheChameleonMeta['section_5_delay'] 		: 'delay03',
      
   	    			'section_6_animate'		=> !empty( $TheChameleonMeta['section_6_animate'] ) 	? $TheChameleonMeta['section_6_animate'] 	: 'fadeIn',
   	    			'section_6_duration'	=> !empty( $TheChameleonMeta['section_6_duration'] ) 	? $TheChameleonMeta['section_6_duration'] 	: 'animated07',
   	    			'section_6_delay'		=> !empty( $TheChameleonMeta['section_6_delay'] ) 		? $TheChameleonMeta['section_6_delay'] 		: 'delay03',
   	    	
					'section_7_animate'		=> !empty( $TheChameleonMeta['section_7_animate'] ) 	? $TheChameleonMeta['section_7_animate'] 	: 'fadeIn',
   	    			'section_7_duration'	=> !empty( $TheChameleonMeta['section_7_duration'] ) 	? $TheChameleonMeta['section_7_duration'] 	: 'animated07',
   	    			'section_7_delay'		=> !empty( $TheChameleonMeta['section_7_delay'] ) 		? $TheChameleonMeta['section_7_delay'] 		: 'delay03',
				
					'section_8_animate'		=> !empty( $TheChameleonMeta['section_8_animate'] ) 	? $TheChameleonMeta['section_8_animate'] 	: 'fadeIn',
   	    			'section_8_duration'	=> !empty( $TheChameleonMeta['section_8_duration'] ) 	? $TheChameleonMeta['section_8_duration'] 	: 'animated07',
   	    			'section_8_delay'		=> !empty( $TheChameleonMeta['section_8_delay'] ) 		? $TheChameleonMeta['section_8_delay'] 		: 'delay03',
   	    		
					'section_9_animate'		=> !empty( $TheChameleonMeta['section_9_animate'] ) 	? $TheChameleonMeta['section_9_animate'] 	: 'fadeIn',
   	    			'section_9_duration'	=> !empty( $TheChameleonMeta['section_9_duration'] ) 	? $TheChameleonMeta['section_9_duration'] 	: 'animated07',
   	    			'section_9_delay'		=> !empty( $TheChameleonMeta['section_9_delay'] ) 		? $TheChameleonMeta['section_9_delay'] 		: 'delay03',
   	    		
					'section_10_animate'	=> !empty( $TheChameleonMeta['section_10_animate'] ) 	? $TheChameleonMeta['section_10_animate'] 	: 'fadeIn',
   	    			'section_10_duration'	=> !empty( $TheChameleonMeta['section_10_duration'] ) 	? $TheChameleonMeta['section_10_duration'] 	: 'animated07',
   	    			'section_10_delay'		=> !empty( $TheChameleonMeta['section_10_delay'] ) 		? $TheChameleonMeta['section_10_delay'] 	: 'delay03',
   	    			
					'section_11_animate'		=> !empty( $TheChameleonMeta['section_11_animate'] ) 	? $TheChameleonMeta['section_11_animate'] 	: 'fadeIn',
					'section_11_duration'	=> !empty( $TheChameleonMeta['section_11_duration'] ) 	? $TheChameleonMeta['section_11_duration'] 	: 'animated07',
					'section_11_delay'		=> !empty( $TheChameleonMeta['section_11_delay'] ) 		? $TheChameleonMeta['section_11_delay'] 		: 'delay03',

					'section_12_animate'		=> !empty( $TheChameleonMeta['section_12_animate'] ) 	? $TheChameleonMeta['section_12_animate'] 	: 'fadeIn',
					'section_12_duration'	=> !empty( $TheChameleonMeta['section_12_duration'] ) 	? $TheChameleonMeta['section_12_duration'] 	: 'animated07',
					'section_12_delay'		=> !empty( $TheChameleonMeta['section_12_delay'] ) 		? $TheChameleonMeta['section_12_delay'] 		: 'delay03',

					'section_13_animate'		=> !empty( $TheChameleonMeta['section_13_animate'] ) 	? $TheChameleonMeta['section_13_animate'] 	: 'fadeIn',
					'section_13_duration'	=> !empty( $TheChameleonMeta['section_13_duration'] ) 	? $TheChameleonMeta['section_13_duration'] 	: 'animated07',
					'section_13_delay'		=> !empty( $TheChameleonMeta['section_13_delay'] ) 		? $TheChameleonMeta['section_13_delay'] 		: 'delay03',

					'section_14_animate'		=> !empty( $TheChameleonMeta['section_14_animate'] ) 	? $TheChameleonMeta['section_14_animate'] 	: 'fadeIn',
					'section_14_duration'	=> !empty( $TheChameleonMeta['section_14_duration'] ) 	? $TheChameleonMeta['section_14_duration'] 	: 'animated07',
					'section_14_delay'		=> !empty( $TheChameleonMeta['section_14_delay'] ) 		? $TheChameleonMeta['section_14_delay'] 		: 'delay03',

					'section_15_animate'		=> !empty( $TheChameleonMeta['section_15_animate'] ) 	? $TheChameleonMeta['section_15_animate'] 	: 'fadeIn',
					'section_15_duration'	=> !empty( $TheChameleonMeta['section_15_duration'] ) 	? $TheChameleonMeta['section_15_duration'] 	: 'animated07',
					'section_15_delay'		=> !empty( $TheChameleonMeta['section_15_delay'] ) 		? $TheChameleonMeta['section_15_delay'] 		: 'delay03',

					'section_16_animate'		=> !empty( $TheChameleonMeta['section_16_animate'] ) 	? $TheChameleonMeta['section_16_animate'] 	: 'fadeIn',
					'section_16_duration'	=> !empty( $TheChameleonMeta['section_16_duration'] ) 	? $TheChameleonMeta['section_16_duration'] 	: 'animated07',
					'section_16_delay'		=> !empty( $TheChameleonMeta['section_16_delay'] ) 		? $TheChameleonMeta['section_16_delay'] 		: 'delay03',

					'section_17_animate'		=> !empty( $TheChameleonMeta['section_17_animate'] ) 	? $TheChameleonMeta['section_17_animate'] 	: 'fadeIn',
					'section_17_duration'	=> !empty( $TheChameleonMeta['section_17_duration'] ) 	? $TheChameleonMeta['section_17_duration'] 	: 'animated07',
					'section_17_delay'		=> !empty( $TheChameleonMeta['section_17_delay'] ) 		? $TheChameleonMeta['section_17_delay'] 		: 'delay03',

					'section_18_animate'		=> !empty( $TheChameleonMeta['section_18_animate'] ) 	? $TheChameleonMeta['section_18_animate'] 	: 'fadeIn',
					'section_18_duration'	=> !empty( $TheChameleonMeta['section_18_duration'] ) 	? $TheChameleonMeta['section_18_duration'] 	: 'animated07',
					'section_18_delay'		=> !empty( $TheChameleonMeta['section_18_delay'] ) 		? $TheChameleonMeta['section_18_delay'] 		: 'delay03',

					'section_19_animate'		=> !empty( $TheChameleonMeta['section_19_animate'] ) 	? $TheChameleonMeta['section_19_animate'] 	: 'fadeIn',
					'section_19_duration'	=> !empty( $TheChameleonMeta['section_19_duration'] ) 	? $TheChameleonMeta['section_19_duration'] 	: 'animated07',
					'section_19_delay'		=> !empty( $TheChameleonMeta['section_19_delay'] ) 		? $TheChameleonMeta['section_19_delay'] 		: 'delay03',

					'section_20_animate'	=> !empty( $TheChameleonMeta['section_20_animate'] ) 	? $TheChameleonMeta['section_20_animate'] 	: 'fadeIn',
					'section_20_duration'	=> !empty( $TheChameleonMeta['section_20_duration'] ) 	? $TheChameleonMeta['section_20_duration'] 	: 'animated07',
					'section_20_delay'		=> !empty( $TheChameleonMeta['section_20_delay'] ) 		? $TheChameleonMeta['section_20_delay'] 	: 'delay03',

					'bottom_animate'		=> !empty( $TheChameleonMeta['bottom_animate'] ) 		? $TheChameleonMeta['bottom_animate'] 	  	: ( !empty ( $TheChameleonOption['bottom_animate'] ) 	? $TheChameleonOption['bottom_animate']  	: 'fadeIn' ) ,
   	    			'bottom_duration'		=> !empty( $TheChameleonMeta['bottom_duration'] ) 		? $TheChameleonMeta['bottom_duration']  	: ( !empty ( $TheChameleonOption['bottom_duration'] ) 	? $TheChameleonOption['bottom_duration']  	: 'animated07' ) ,
   	    			'bottom_delay'			=> !empty( $TheChameleonMeta['bottom_delay'] ) 			? $TheChameleonMeta['bottom_delay'] 		: ( !empty ( $TheChameleonOption['bottom_delay'] ) 		? $TheChameleonOption['bottom_delay']  		: 'delay03' ) ,
      
   	    			'footer_animate'		=> !empty( $TheChameleonOption['footer_animate'] )  	? $TheChameleonOption['footer_animate']  	: 'fadeIn',
   	    			'footer_duration'		=> !empty( $TheChameleonOption['footer_duration'] ) 	? $TheChameleonOption['footer_duration'] 	: 'animated07',
   	    			'footer_delay'			=> !empty( $TheChameleonOption['footer_delay'] ) 		? $TheChameleonOption['footer_delay'] 	 	: 'delay03',
      
   	    			'copyright_animate'		=> !empty( $TheChameleonOption['copyright_animate'] )  	? $TheChameleonOption['copyright_animate']  : 'fadeIn',
   	    			'copyright_duration'	=> !empty( $TheChameleonOption['copyright_duration'] ) 	? $TheChameleonOption['copyright_duration'] : 'animated07',
   	    			'copyright_delay'		=> !empty( $TheChameleonOption['copyright_delay'] ) 	? $TheChameleonOption['copyright_delay'] 	: 'delay03',
      
      
   	    		);
   	    		wp_localize_script( 'the-chameleon-functions', 'data', $data );
      
   	    		//easing	
   	    		wp_enqueue_script( 'the-chameleon-jquery-easing', get_template_directory_uri()  .'/js/jquery.easing.1.3.js', array( 'jquery' ), '1.3.0', true  );
      
   	    		//jquery.viewportchecker.js
   	    		wp_register_script( 'the-chameleon-viewport-checker', get_template_directory_uri()  .'/js/jQuery-viewport-checker/src/jquery.viewportchecker.js', array( 'jquery' ), '1.0.0', true );
   	    		wp_enqueue_script( 'the-chameleon-viewport-checker' );
          

				//cycle 2 scripts
			 	wp_enqueue_script('the-chameleon-cycle', 		    get_template_directory_uri() .'/js/cycle2/cycle2.js',      array('jquery', 'the-chameleon-jquery-easing'), '2.1.6', true);			
				wp_register_script('the-chameleon-cycle-flip', 	    get_template_directory_uri() .'/js/cycle2/Flip.js',        array('jquery', 'the-chameleon-jquery-easing', 'the-chameleon-cycle'), '1.0.0', true);			
				wp_register_script('the-chameleon-cycle-tile', 	    get_template_directory_uri() .'/js/cycle2/Tile.js',        array('jquery', 'the-chameleon-jquery-easing', 'the-chameleon-cycle'), '1.0.0', true);			
				wp_register_script('the-chameleon-cycle-scrollVert', get_template_directory_uri() .'/js/cycle2/ScrollVert.js', array('jquery', 'the-chameleon-jquery-easing', 'the-chameleon-cycle'), '1.0.0', true);			
				wp_register_script('the-chameleon-cycle-ie-fade',    get_template_directory_uri() .'/js/cycle2/IE-Fade.js',    array('jquery', 'the-chameleon-jquery-easing', 'the-chameleon-cycle'), '1.0.0', true);			
				wp_register_script('the-chameleon-cycle-shuffle',    get_template_directory_uri() .'/js/cycle2/Shuffle.js',    array('jquery', 'the-chameleon-jquery-easing', 'the-chameleon-cycle'), '1.0.0', true);			
				wp_register_script('the-chameleon-cycle-carousel',   get_template_directory_uri() .'/js/cycle2/Carousel.js',   array('jquery', 'the-chameleon-jquery-easing', 'the-chameleon-cycle'), '1.0.0', true);			
				wp_register_script('the-chameleon-cycle-caption',   get_template_directory_uri() .'/js/cycle2/Caption2.js',    array('jquery', 'the-chameleon-jquery-easing', 'the-chameleon-cycle'), '1.0.0', true);
				wp_enqueue_script( 'the-chameleon-cycle' );


   	    		//comments	
   	    		if ( is_singular() && get_option( 'thread_comments' ) )
   	    			wp_enqueue_script( 'comment-reply' );
      
      
   	    	endif;
      
   	    
      
      
   	    }

	 	/**
		 * 	Set admin skripts and styles
		 *
		 * @author Goran Petrovic
		 * @since 1.0
		 *
		 **/
   	    function admin_scripts_and_styles(){

			//functions			
   	    	wp_enqueue_script( 'the-chameleon-functions', get_template_directory_uri()  .'/js/admin.js', array( 'jquery' ), '1.0.0'  );

	
		}


	   	
		/**
		 * 	Theme support 
		 *
		 * @author Goran Petrovic
		 * @since 1.0
		 *
		 **/
		function theme_supports() {		

		$defaults = array(
						'default-color'          => '',
						'default-image'          => '',
						'default-repeat'         => '',
						'default-position-x'     => '',
						'default-attachment'     => '',
						'wp-head-callback'       => '_custom_background_cb',
						'admin-head-callback'    => '',
						'admin-preview-callback' => ''
					);
			add_theme_support( 'custom-background', $defaults );			
			add_theme_support( 'custom-header' );
			add_theme_support( "title-tag" );

			$args = array(
				'search-form',
				'comment-form',
				'comment-list',
				'gallery',
				'caption'
			);
			add_theme_support( 'html5', $args );
			
			//define content width
			if ( ! isset( $content_width ) ) {
				$content_width = 600;
			}

			$defaults = array(
				'post'       => '500',
				'page'       => '500',
				'attachment' => '650',
				'artist'     => '300',
				'movie'      => '400'
			);
			add_theme_support( 'content-width', $defaults );

			// Register theme support
			if ( function_exists( 'add_theme_support' ) ) { 
				add_theme_support( 'post-thumbnails');			
			}

			//add editor style
			add_editor_style('css/editor-style.css');

			//Add image size 800x600
			add_image_size( 'single-photo', 800, 600 );

			//custom background
			add_theme_support( 'custom-background' );

			// This theme supports a variety of post formats.
			add_theme_support( 'post-formats', array( 'aside', 'image', 'video', 'audio', 'gallery', 'quote',  'status', 'link') );

			//automatic-feed-links
			add_theme_support( 'automatic-feed-links' );


		}

		/**
		 * 	Load language in i18n dir
		 *
		 * @author Goran Petrovic
		 * @since 1.0
		 *
		 **/
		function load_theme_textdomain(){
		    load_theme_textdomain('the-chameleon', get_template_directory() . '/i18n');
		}

		/**
		 * Customize the title for the home page, if one is not set.
		 *
		 * @param string $title The original title.
		 * @return string The title to use.
		 */
		function wp_title( $title ) {
		  if ( empty( $title ) && ( is_home() || is_front_page() ) ) :
		    $title = get_bloginfo('name') . ' &raquo; ' . get_bloginfo( 'description' );
		  else :
			 $title =  $title .get_bloginfo('name');
		  endif;

		  return $title;	 
		}
		

		/**
		 * 	Custom header background  and theme css
		 *
		 * @author Goran Petrovic
		 * @since 1.0
		 *
		 **/
		function custom_css() {

		 	global $TheChameleonOption;

			if( get_header_image() ) : 
				echo '<style> #header { background:transparent url("' . get_header_image() . '"); } #header h1, #header h2, #header h3, #header h4, #header h5, #header h6, #header h1 a, #header h2 a, #header h3 a, #header h4 a, #header h5 a, #header h6 a, #header p, #header a {color:#' . get_header_textcolor() . ';}'.	 $TheChameleonOption['custom_css'] .'</style>';
			else:
				echo '<style>' . $TheChameleonOption['custom_css'] . '</style>';		
			endif;
		}

		

	}
	
?>