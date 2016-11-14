<?php

	namespace TheChameleon;
	
	/**
	 * 	Sidebars and Widgets 
	 *
	 * @author 		Goran Petrovic <goran.petrovic@godev.rs>
	 * @package     WordPress
	 * @subpackage  Gox
	 * @since 		Gox  1.0.0
	 *
	 * @version 	1.0.0
	 *
	 **/
	
	class Sidebars{
		
		public $namespace;
		
		function __construct(){
			
			
			global $config;
			
			$this->namespace = 	$config->namespace;
			
			$this->slug = 	$config->slug;
			
			//set Sidebars
			$this->set_sidebars();

			//register Sidebars 
			add_action('widgets_init', array(&$this,'register_sidebars'), 1 );	 

			//register widgets
			add_action( 'widgets_init', array(&$this, 'register_widgets') );

			//default widget title
			add_filter( 'widget_title', array(&$this, 'default_widget_title'), 10, 3 );

			//custom sidebars setting
			add_action( 'widgets_admin_page',  array(&$this, 'custom_sidebars_setting' ), 10, 2);
		
		}
		
	
		/**
		 * 	Set all parts in to $this->part name 
		 *
		 * @author Goran Petrovic
		 * @since 1.0
		 *
		 **/
		 function register_widgets(){
			
			global $config;
			//register all parts like part name == class name	
			foreach (glob( $config->DIR.'/widgets/*', GLOB_ONLYDIR ) as $paths) :

				$dir = explode('/', $paths);	
				$widget =  end($dir);

				$this->widegt[] = $widget;
				
				//class name
				$widget_class_name = $this->namespace.'_'.$widget.'_Widget';
				
					if ( !is_blog_installed() )
							return;

					register_widget( $widget_class_name ) ;	
			
			endforeach;			
			
		}
		
		
		/**
		 * 	Set sidebars
		 *
		 * @author Goran Petrovic
		 * @since 1.0
		 *
		 **/
		function set_sidebars(){

			$defaul_sidebars = 
				array(	
					''				=> __( 'Select Sidebar', 'the-chameleon' ),
					'Upper'			=> __( 'Upper', 'the-chameleon' ),
					'Header'		=> __( 'Header', 'the-chameleon' ),
					'Top'			=> __( 'Top', 'the-chameleon' ),
					'Page'			=> __( 'Page', 'the-chameleon' ),
					'Post Top'		=> __( 'Post Top', 'the-chameleon' ),
					'Post'			=> __( 'Post', 'the-chameleon' ),
					'Post Footer'	=> __( 'Post Footer', 'the-chameleon' ),			
					'Bottom'		=> __( 'Bottom', 'the-chameleon' ),
					'Footer'		=> __( 'Footer', 'the-chameleon' ),
					'Copyright'		=> __( 'Copyright', 'the-chameleon' ),
				);

			$custom =  get_option( $this->slug.'custom_sidebars', array() );
			$custom = !empty( $custom ) ? array_combine( $custom, $custom )  : array();		
			asort( $custom );
			
				
			$this->sidebars = array_merge( $defaul_sidebars, $custom ); 

			global $config;
			$config->sidebars = $this->sidebars;
			
		   return $this->sidebars;


		}

		/**
		 * 	Register sidebars
		 *
		 * @author Goran Petrovic
		 * @since 1.0
		 *
		 **/
		function register_sidebars(){



			foreach ( $this->sidebars as $key => $value ) :
				if ( !empty( $key ) ) :
					register_sidebar(
							array(
								'name'          => $key,
								'id'			=> sanitize_title($key),
								'before_widget' => '<section id="%1$s" class="widget hidden %2$s">',
								'after_widget'  => '</section></section><!-- end widget-->',
								'before_title'  => '<header class="widget-header"><h4>',
								'after_title'   => '</h4></header><section class="widget-content">' )
							);
				endif;
			endforeach;

		}

		/**
		 * 	Define default widgets title 
		 *
		 *
		 * @author Goran Petrovic
		 * @since 1.0
		 *
		 * @return void
		 **/
		function default_widget_title( $title, $instance = NULL ) {

			$instance['title'] = ( ! empty( $instance['title'])) ? $instance['title'] : NULL;
			$title = ( !empty( $instance['title'] ) ) ? $instance['title'] : ( ( !empty( $title ) ) ? $title : ' ');
			return $title;	
		}
		
			
		/** 
		 * Add/delete unlimeted sidebars in widgest arena 
		 *
		 *
		 * @author Goran Petrovic
		 * @since 1.0
		 *
		 * @return html in widgets section
		 **/	
		function custom_sidebars_setting() { ?>

			<script type="text/javascript">
			    jQuery(document).ready(function() {
					jQuery('.my-widget-holder').hide();
			     // toggles the slickbox on clicking the noted link  
			      jQuery('#my_sidebar-name-arrow, #my_sb').click(function() {			
					var idrel = jQuery(this).attr("data");
			        jQuery('.my-widget-holder').toggle();
			        return false;
			      });
			    });
			</script>

			<?php //add sidebar

					$get_custom_sidebars = get_option($this->slug.'custom_sidebars', array());
					$get_custom_sidebars  = !empty($get_custom_sidebars) ? $get_custom_sidebars : array();

				if ( ! empty( $_POST['create_sidebar'] ) ) :


					update_option( $this->slug . 'custom_sidebars', array_unique( array_merge( $get_custom_sidebars, array( trim( esc_html( $_POST['create_sidebar'] ) ) ) ) ) );

					echo '<div id="message" class="updated"><p>'. __('New sidebar is successfully added. Please <a href="">refresh page</a>.', 'the-chameleon') .'</p></div>';

				elseif( ! empty( $_POST['delete_sidebar'] ) ) :	

					if ( ( $key = array_search( trim( $_POST['delete_sidebar'] ) , 	$get_custom_sidebars ) ) !== false ) :
					    unset( $get_custom_sidebars[ $key ] );
					endif;

				    update_option( $this->slug . 'custom_sidebars', array_unique( $get_custom_sidebars) );

					echo '<div id="message" class="updated"><p>' . __('Sidebar is successfully delete. Please <a href="">refresh page</a>.', 'the-chameleon'). '</p></div>';

				endif; ?>

			<div id="available-widgets" class="widgets-holder-wrap" >
				<div class="sidebar-name" style=" margin:0px 10px 0px 6px;" >	
					<div id="my_sidebar-name-arrow" class="sidebar-name-arrow" ><br/></div>
						<h3 id="my_sb"><?php _e( 'Custom Sidebars', 'the-chameleon' ) ?></h3>
							<div class="my-widget-holder" >
								<div style="padding:10px;">

									<form action="" method="POST" accept-charset="utf-8">									
											<div style="width:100%;">											
												<?php echo Form::label('create_sidebar', __( 'Unique Sidebar Name', 'the-chameleon' ) ); ?>
												<br/>
												<?php echo Form::input('create_sidebar', '', array( 'id' => 'create_sidebar', 'style' => 'min-width:230px;', 'maxlength'=>"30")); ?>									
												<?php echo Form::submit('add', __( 'Create ', 'the-chameleon' ), array('class'=>'button-primary')); ?>
											</div>

											<div style="width:100%;  margin-top:20px;">
												<?php

													$get_custom_sidebars = array_combine($get_custom_sidebars,	$get_custom_sidebars );
													$get_custom_sidebars = array_merge( $get_custom_sidebars, array( ''=>'Select Sidebar' ) ) ; ?>

												<?php echo Form::select('delete_sidebar', '', $get_custom_sidebars, array('style'=>'width:230px;') )?>												
												<?php echo Form::submit('delete', __( 'Delete ', 'the-chameleon' ), array('class'=>'button-primary')); ?>	
											</div>
									    </form>
							</div>
						</div>
				</div>
			</div>

		<?php

			}
		
	}
?>