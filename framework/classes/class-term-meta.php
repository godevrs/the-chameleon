<?php

	namespace TheChameleon;	
	
    /**
     * Term option builder 
     *
     * Create fileds in category setting, 
	 *
	 * @author 		Goran Petrovic <goran.petrovic@godev.rs>
	 * @package     WordPress 
	 * @subpackage  GoX
	 * @since 		GoX 1.0.0
	 *
	 * @version 	1.0.0
	 *
	 */	
    class Term_Meta{
    	
		var $parts;
		var $term_options;
		var $terms_list;
		var $slug;
		
		function __construct( $parts ){
			
			$config = Config::getInstance();
			$this->slug = $config->slug;
			
			$this->parts = $parts;
					
			//set terms options
			$this->set_terms_options();

			//add fileds in terms
			foreach ($this->parts as $key => $part) :
				if (!empty( $this->terms_list[ $key ] ) ) :
			  		foreach ($this->terms_list[ $key ] as $key => $term) :

			  	        add_action($term.'_edit_form_fields', array( &$this, 'register_terms_opitons') );
			  	        add_action('edited_'.$term, array( &$this,  'save_term_options' ), 10, 2);
          
			  	        add_action($term.'_add_form_fields',array( &$this,  'register_terms_opitons' ) );
			  	        add_action('created_'.$term, array( &$this, 'save_term_options'), 10, 2);
		  	        
		  	        
			  		endforeach;
				endif;
			endforeach;

			//get Terms Options
			add_action('init', array(&$this,'get_term_options_value') );
			add_action('wp', array(&$this,'get_term_options_value') );		
		
			
		}

		/**
		 * Hook, save  trem meta
		 *
		 * @author Goran Petrovic
		 * @since 1.0
		 *
		 * @return 
		 **/
		 function save_term_options( $term_id ) {

			// Check the user's permissions.
			if ( ! current_user_can( 'manage_categories', $term_id ) )
				return $term_id;

			if ( ! $term_id ) return;

			if ( ! empty( $_POST['tax'] ) ) :

				$_data = $_POST['tax'];
				update_term_meta( $term_id, $this->slug.'data', $_data);
				
				//add separate meta 
				foreach ($_data as $key => $value) :
					update_term_meta( $term_id, $key, $value);
				endforeach;


			endif;
			
		}

		/**
		 * Set terms data
		 *
		 * @author Goran Petrovic
		 * @since 1.0
		 *
		 * @return 
		 **/	
		 function set_terms_options(){

			foreach ($this->parts as $key => $part) :
				if( method_exists($part, 'term_meta') ) :
					
					$this->term_options[ $key ] = $part->term_meta();	
					//term list
					$this->terms_list[ $key ] = $this->term_options[ $key ]['term_type'];						
				endif;
			endforeach;
			
			return 	$this->terms_list;
		}


		/**
		 * Register terms setting - render_fields 
		 *
		 * @author Goran Petrovic
		 * @since 1.0
		 *
		 * @return 
		 **/
		 function register_terms_opitons(){

			foreach ($this->parts as $key => $part) :
				if( !empty($this->term_options[ $key ] ) ) :
					$this->render_fields($this->term_options[ $key ]['fileds'] );
					$this->term_options[ $key ] = $part->term_meta();
				endif;
			endforeach;

		}



		/**
		 * Register terms setting - render_fields 
		 *
		 * @author Goran Petrovic
		 * @since 1.0
		 *
		 * @return 
		 **/
		public function get_term_options_value($tax = '', $term = ''){

			global $TheChameleonTermOption;
			global $TheChameleonTerm;

			if ( is_category() or is_tax() or is_archive() or is_tag() or is_main_query() ) :

				//if not main query
				$get_term_options_value = array();
				if( is_object( get_queried_object() ) ) :

					//????
					if(!empty( get_queried_object()->term_id ) ) :

						$term_id = get_queried_object()->term_id;		
						$tax 	 = get_queried_object()->taxonomy;	

						/*$get_term_options_value = get_option( $this->slug.$tax.'_term_'.$term_id );*/
						$get_term_options_value = get_term_meta( $term_id, 	$this->slug.'data', true );

					endif;
				endif;

				foreach ($this->parts as $key => $part) :

					if( !empty($this->term_options[ $key ]) ) :

						foreach ($this->term_options[ $key ]['fileds'] as $key => $filed) :

							 $name = $filed['name'];

							//set default post per page
							 if ($filed['name'] == 'posts_per_page' ) :
								$filed['default']  = get_option('posts_per_page'); 									
							 endif;

							$TheChameleonTerm[$name] 	   = !empty( $get_term_options_value[$name] ) ? $get_term_options_value[$name] :  $filed['default']; 
							$TheChameleonTermOption[$name] = !empty( $get_term_options_value[$name] ) ? $get_term_options_value[$name] :  $filed['default']; 

						endforeach;

					endif;
				endforeach;

			endif;



		}



    	/**
    	 * 	Create Meta box fields
    	 *
    	 * @author Goran Petrovic
    	 * @since 1.0
    	 *
		 * @var array $filends, filed name, value, attributes 
         *
    	 * @return html
    	 **/	
     	function render_fields($fileds){
    
    			//get terms values 
    			if ( !empty($_GET['tag_ID'] ) ) :
    				
    				$term_id = $_GET['tag_ID'];		
    				$tax 	 = $_GET['taxonomy'];	
					$term_values = get_term_meta( $term_id, $this->slug.'data', true );

    			endif;

				/**
				* @var string $html
				* @var string $tax taxonomy name fomr GET
 				**/
    			$html = '';
 
    			$tax = ( $_GET['taxonomy'] ) ? $_GET['taxonomy'] : '';
    
    			foreach ($fileds as $key => $filed) :
    			
    					$type  = $filed['type'];
    					$name  = $filed['name'];
    					$value = !empty( $term_values[ $name ] ) ? $term_values[ $name ] : $filed['default'];
    					$title = $filed['title'];
    					$desc  = !empty( $filed['desc'] ) ? $filed['desc'] : '';
    					$attr  = !empty( $filed['attr'] ) ? $filed['attr'] : array();		
    
    					if ( $type == 'select' ) :
    						$html.= self::{$type}("tax[$name]", $value  , $filed['choices'], $filed['title'] , $desc  );
    					else:
    						$html.= self::{$type}("tax[$name]", $value  , $filed['title'] , $desc , $attr );
    					endif;
    			endforeach;
    			
    	
    		return $html;
    	}
    	
    	
 	  	/**
    	 * 	Input filed for meta view
    	 *
    	 * @author Goran Petrovic
    	 * @since 1.0
    	 *
		 * @var string $name input id and name
		 * @var string $value default value
		 * @var string $label title for label
		 * @var string $desc desription 
		 * @var array $attr field attributes in array(name => value)		
         *
    	 * @return html
    	 **/
    	static function text( $name = '', $value = '', $label = '', $desc = '', $attr = array() )
		{ 
    		
			//change html tags ..of action edit or add
    		$action = !empty($_GET['action']) ? $_GET['action'] : '';
    		$tag    = ($action=="edit") ? 'tr' : 'tr';
    		$tag1   = ($action=="edit") ? 'td' : 'td';
    		$tag2   = ($action=="edit") ? 'th' : 'th';
    		?>
    	
    
    		<<?php echo $tag ?> class="form-field term-<?php echo esc_attr( $name ) ?>-wrap">
    			<<?php echo $tag2 ?> scope="row"><label for="<?php echo $name ?>"><?php echo esc_attr( $label ); ?></label></<?php echo $tag2 ?>>					
    			<<?php echo $tag1 ?>><?php echo Form::input( $name, $value, $attr ) ?>
    	        	<?php echo self::desc($desc) ?>
    			</<?php echo $tag1 ?>>
    		</<?php echo $tag ?>>
    	
    	<?php	
    	}
    	
 
    	
	   	/**
    	 * 	Selectbox for meta view
    	 *
    	 * @author Goran Petrovic
    	 * @since 1.0
    	 *
		 * @var string $name input id and name
		 * @var string $value default value
		 * @var array $value select box options array( value =>  title )
		 * @var string $label title for label
		 * @var string $desc desription 
		 * @var array $attr field attributes in array(name => value)
         *
    	 * @return html
    	 **/
    	static function select( $name = '', $value = '', $choices = array(), $label = '', $desc = '', $attr= array())
		{
    			//change html tags ..of action edit or add
    			$action = !empty($_GET['action']) ? $_GET['action'] : '';
    			$tag    = ($action=="edit") ? 'tr' : 'tr';
    			$tag1   = ($action=="edit") ? 'td' : 'td';
    			$tag2   = ($action=="edit") ? 'th' : 'th';  ?>
    		
    	
    		<<?php echo $tag ?>  class="form-field term-<?php echo esc_attr ( $name ) ?>-wrap">
    			<<?php echo $tag2 ?> scope="row"><label for="<?php echo esc_attr( $name ) ?>"><?php echo esc_attr( $label ); ?></label></<?php echo $tag2 ?>>						
    			<<?php echo $tag1 ?>><?php echo Form::select($name, $value, $choices, $attr ) ?>
    	        	<?php echo self::desc($desc) ?>
    			</<?php echo $tag1 ?>>
    		</<?php echo $tag ?> >
    	
    	<?php	
    	}
    	
 	   
	   
	   	/**
    	 * 	Selectbox for meta view
    	 *
    	 * @author Goran Petrovic
    	 * @since 1.0
    	 *
		 * @var string $name input id and name
		 * @var string $value default value
		 * @var array $value select box options array( value =>  title )
		 * @var string $label title for label
		 * @var string $desc desription 
		 * @var array $attr field attributes in array(name => value)
         *
    	 * @return html
    	 **/
    	static function wp_image( $name = '', $value = '', $choices = array(), $label = '', $desc = '', $attr= array())
		{
    			//change html tags ..of action edit or add
    			$action = !empty($_GET['action']) ? $_GET['action'] : '';
    			$tag    = ($action=="edit") ? 'tr' : 'div';
    			$tag1   = ($action=="edit") ? 'td' : 'div';
    			$tag2   = ($action=="edit") ? 'th' : 'div';  ?>
    		
    	
    		<<?php echo $tag ?>  class="form-field term-<?php echo esc_attr ( $name ) ?>-wrap">
    			<<?php echo $tag2 ?> scope="row"><label for="<?php echo esc_attr( $name ) ?>"><?php echo esc_attr( $label ); ?></label></<?php echo $tag2 ?>>						
    			<<?php echo $tag1 ?>><?php echo Form::wp_image($name, $value, $choices, $attr ) ?>
    	        	<?php echo self::desc($desc) ?>
    			</<?php echo $tag1 ?>>
    		</<?php echo $tag ?> >
    	
    	<?php	
    	}
    	
		
       	/**
    	 * 	Desctiption for fileds 
    	 *
    	 * @author Goran Petrovic
    	 * @since 1.0
    	 *
		 * @var string $desc input description
         *
    	 * @return html
    	 **/
    	static function desc( $desc ) 
		{ 
    		return ( !empty( $desc ) ) ? "<p class='description'>{$desc}</p>" : NULL;
    	}
    	
    	
    }
 
	

?>