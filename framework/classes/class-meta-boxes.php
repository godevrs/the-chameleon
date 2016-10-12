<?php

	namespace TheChameleon;
	
 /**
   * Meta Boxes 
   * 
   * @author     Goran Petrovic <goran.petrovic@godev.rs>
   * @package    WordPress
   * @subpackage GoX
   * @since 	 GoX 1.0.0
   *
   * @version 1.1.0
   * add text area, wp media
   */
	class Meta_Boxes{
		
		var $parts = array();
		var $meta_boxes;
		var $meta_boxes_fields;
		var $slug;
		
		function __construct( $parts ){
			


			$config = Config::getInstance();
			$this->slug = $config->slug;
			
			$this->parts = $parts;					
		
			//post Post Meta Boxes
			$this->set_meta_boxes_fileds();

			//add Post Meta Boxes
			add_action( 'add_meta_boxes', array( &$this, 'render_meta_boxes' ) );

			//save Post Meta Boxes
			add_action( 'save_post', array( &$this, 'meta_box_save' ) );

			//get post meta values
			add_action('init', array(&$this,'get_post_meta_values') );
			add_action('wp', array(&$this,'get_post_meta_values') );
			
			
		}
		
		
		/**
		 * 	Get meta values
		 *
		 * @author Goran Petrovic
		 * @since 1.0
		 *
		 * @return void
		 **/
		function get_post_meta_values(){

			global $TheChameleonMeta;
			
			if ( is_singular() or is_single() or is_page() ) :										
				$get_post_meta = get_post_meta( get_the_ID(), $this->slug.'meta', TRUE);						
					foreach ( $this->parts as $key => $part ) :
						if ( !empty( $this->meta_boxes_fields[ $key ] ) ) :	
							foreach ( $this->meta_boxes_fields[ $key ] as $value ) :
									foreach ( $value['fields'] as $field ) :									
										$name 	 				   = $field['name'];										
										$default 				   = !empty( $field['default'] ) ? $field['default'] : '';										
										$TheChameleonMeta[ $name ] = isset( $get_post_meta[ $name ] ) ? $get_post_meta[ $name ] : $default;
										$this->Meta[ $name ] 	   = !empty( $get_post_meta[ $name ] ) ? $get_post_meta[ $name ] : $default;
									endforeach;
							endforeach;
						endif;
					endforeach;		
			endif;


		}

		/**
		 * 	Set boxes from all parts 
		 *
		 * @author Goran Petrovic
		 * @since 1.0
		 *
		 * @return void
		 **/	
		function set_meta_boxes_fileds(){

			foreach ($this->parts as  $key => $part ) :			
				if( method_exists($part, 'meta_boxes') ) :														
					$this->meta_boxes[ $key ] = $part->meta_boxes();					
					if ( !empty( $this->meta_boxes[	$key ] ) ) :
						foreach ($this->meta_boxes[	$key ] as  $value) :							
							$this->meta_boxes_fields[ $key ][] = array('post_types' => $value['post_types'], 'fields'=>$value['fields']);
						endforeach;
					endif;
				endif;
			endforeach;

		}

		/**
		 * 	Make meta boxes
		 *
		 * @author Goran Petrovic
		 * @since 1.0
		 *
		 * @return void
		 **/
		 function render_meta_boxes( $post_type ){

			foreach ( $this->parts as $key => $part ) :														
				if ( !empty( $this->meta_boxes[	$key ] ) ) :
					foreach ($this->meta_boxes[ $key ] as $value) :						
						 $context  = !empty( $value['context'] )  ? $value['context']  : 'normal';
						 $priority = !empty( $value['priority'] ) ? $value['priority'] : 'default'; 		
						 self::add_meta_box( $post_type, $this, $value['post_types'], $value['id'], $value['title'], $context, $priority   );
					endforeach;
				endif;
			endforeach;		

		} 

		/**
		 * 	Render fields 
		 *
		 * @author Goran Petrovic
		 * @since 1.0
		 *
		 * @return void
		 **/
		 function render_meta_boxes_content( $post, $data ){

			foreach ( $this->parts as $key => $part ) :									
				if ( !empty( $this->meta_boxes[	$key ] ) ) :
					foreach ( $this->meta_boxes[ $key ] as $value ) :
						if ( $data['id'] == $value['id'] ) :
														
							 //description
							 $desc = !empty( $value['desc'] ) ? $value['desc'] : NULL;

							 self::add_meta_box_content( $post, $value['fields'], $desc);							
						endif;
					endforeach;
				endif;
			endforeach;

		}

		/**
		 * 	Save custom meta box values
		 *
		 * @author Goran Petrovic
		 * @since 1.0
		 *
		 * @return void
		 **/
		 function meta_box_save( $post_id ){


			// Check if our nonce is set.
			if ( ! isset( $_POST['the-chameleon_custom_box_nonce'] ) )
				return $post_id;

			$nonce = $_POST['the-chameleon_custom_box_nonce'];

			// Verify that the nonce is valid.
			if ( ! wp_verify_nonce( $nonce, 'the-chameleon_custom_box' ) )
				return $post_id;

			// If this is an autosave, our form has not been submitted,
	                //     so we don't want to do anything.
			if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) 
				return $post_id;

			// Check the user's permissions.
			if ( 'page' == $_POST['post_type'] ) {

				if ( ! current_user_can( 'edit_page', $post_id ) )
					return $post_id;

			} else {

				if ( ! current_user_can( 'edit_post', $post_id ) )
					return $post_id;
			}

			/* OK, its safe for us to save the data now. */
			if ( !empty( $_POST['meta'] ) ) :

				
 				$meta_values = $_POST['meta'];

				update_post_meta( $post_id,	$this->slug.'meta', $meta_values );

				//insert all meta
				foreach ($_POST['meta'] as $key => $value) :				
					update_post_meta( $post_id, $key, $value );	
				endforeach;
				

			endif;


		}
		

		/**
		 * 	Create Meta box 
		 *
		 * @author Goran Petrovic
		 * @since 1.0
		 *
		 * @return html
		 **/
		static function add_meta_box( $post_type, $this, $post_types = null , $id = 'meta_box_content', $title = 'Setup', $context ='normal', $priority = 'default' ){

			//https://codex.wordpress.org/Function_Reference/add_meta_box

			/*$post_types = array('page'); */    //limit meta box to certain post types
            if ( in_array( $post_type, $post_types )) {
				add_meta_box(
					$id
					, $title
					, array( &$this, 'render_meta_boxes_content' )
					, $post_type
					, $context  //'normal', 'advanced', or 'side'
					, $priority //'high', 'core', 'default' or 'low') 
				);
            }



		}
		
		/**
		 * 	Meta box Content
		 *
		 * @author Goran Petrovic
		 * @since 1.0
		 *
		 * @return html
		 **/		
	 	static function add_meta_box_content( $post, $fields = array(), $desc = '' ){

			// Add an nonce field so we can check for it later.
			wp_nonce_field( 'the-chameleon_custom_box', 'the-chameleon_custom_box_nonce' );


				echo '<style>.the_chameleon_metabox input, 
				.the_chameleon_metabox textarea{width:100%; padding:5px;}, 
				.the_chameleon_metabox select{padding:5px !important;}
				.the_chameleon_metabox input[type=checkbox]{width:20px !important;}
				table#page_builder tr td{width:100%; border-top:1px solid #eeeeee !important; padding:5px 0px;}
				table#page_builder tr:first-child td{width:100%; border-top:0px solid #eeeeee !important; padding:5px 0px;}
				</style>';

				$table_id = ($fields[0]['type'] =='page_builder') ? 'page_builder' : NULL;

			 	echo '<table id="'.$fields[0]['type'].'" class="the_chameleon_metabox" style="width:100%;">
						<tbody>';
						
					//description
					echo !empty($desc) ? '<tr><td>' . self::desc($desc) . '</td></tr>' : NULL ;
				
				
						foreach ($fields as $key => $field) :
		
							$type 			  = isset($field['type']) ? $field['type'] : 'text';
							$field['title']   = isset($field['title']) ? $field['title']: '';
							$field['attr'] 	  = isset($field['attr']) ? $field['attr']: '';
							$field['default'] = isset($field['default']) ? $field['default']: '';
							$desc			   = (!empty( $field['desc'] )) ? $field['desc'] : '';
					
							if($type == 'select' or $type == 'page_builder') : 
								$other = (!empty( $field['choices'] )) ? $field['choices'] : array();
							elseif($type == 'date'):
								$other = (!empty( $field['format'] )) ? $field['format'] : '';
							else:	
								$other = '';
							endif;
							
							self::{$type}($post, $field['name'], $field['title'], $field['default'], $desc, $field['attr'], $other);
				
						endforeach;
		
			   echo "</tbody></table>";
			
			

		}
		static function none( $post, $id, $label, $value, $desc = '' , $attr = array() ){}	
		/**
		 * 	Text filed
		 *
		 * @author Goran Petrovic
		 * @since 1.0
		 *
		 * @return html
		 **/		
	 	static function text( $post, $id, $label, $value, $desc = '' , $attr = array() )
		{ 
		
			$id 		= str_replace( "-","_", sanitize_title( $id ) ) ;			
		 	$post_meta 	= self::get_post_meta($post->ID); 
			$value 		= !empty( $post_meta[$id] ) ? $post_meta[$id] : $value ; ?>
			<tr>
				<td id="td-<?php echo $id ?>" class="left" style="vertical-align: middle;">
					<?php echo !empty($label) ? "<p><strong>{$label}</strong></p>": ''; ?>
					<?php echo Form::input("meta[$id]", $value, $attr); ?>
					<?php echo self::desc($desc); ?>
				</td>
			</tr>

		<?php }

		/**
		 * 	Textarea filed
		 *
		 * @author Goran Petrovic
		 * @since 1.0
		 *
		 * @return html
		 **/		
	 	static function textarea( $post, $id, $label, $value, $desc = '' , $attr = array() )
		{ 

			$id 		= str_replace( "-","_", sanitize_title( $id ) ) ;			
		 	$post_meta 	= self::get_post_meta( $post->ID ); 
			$value 		= !empty( $post_meta[$id] ) ? $post_meta[$id] : $value ; ?>
			<tr>
				<td id="td-<?php echo $id ?>"  class="left" style="vertical-align: middle; width:100%;">
					<?php echo !empty($label) ? "<p><strong>{$label}</strong></p>": ''; ?>
					<?php echo Form::textarea("meta[$id]", $value, $attr); ?>
					<?php echo self::desc($desc); ?>
				</td>
			</tr>

		<?php }
		/**
		 * 	Select filed
		 *   
		 *
		 * @author Goran Petrovic
		 * @since 1.0
		 *
		 * @return html
		 **/
		static function select( $post, $id, $label, $value, $desc = '' , $attr = array(), $choices = array() )
		{ 

			$name  		= str_replace( "-","_", sanitize_title( $id ) );
			$post_meta 	= self::get_post_meta($post->ID); 
			$value 		= !empty( $post_meta[$id] ) ? $post_meta[$id] : $value ; ?>

			<tr>
				<td id="td-<?php echo $id ?>" class="left" >
					<?php echo !empty($label) ? "<p><strong>{$label}</strong></p>": ''; ?>
			
					<?php echo Form::select("meta[$name]", $value, $choices, $attr); ?><br />	
					<?php echo self::desc($desc); ?>
				</td>
			</tr>

		<?php
		
	
		}

		
		/**
		 * 	checkbox filed
		 *   
		 *
		 * @author Goran Petrovic
		 * @since 1.0
		 *
		 * @return html
		 **/
		static function checkbox( $post, $id, $label, $value, $desc = '' , $attr = array(), $choices = array() ){ 
			
			$name  		= str_replace( "-","_", sanitize_title( $id ) );
			$post_meta 	= self::get_post_meta( $post->ID ); 
			$value 		= isset( $post_meta[ $name ] ) ? $post_meta[ $name ] : $value ;  ?>

			<tr>
				<td id="newmetaleft" class="left">
					<label><input type="checkbox" name="meta[<?php echo $name ?>]" value="1" <?php checked(	$value , 1 ); ?>  ><?php echo !empty( $label ) ? "<strong> $label </strong>": ''; ?> </label>	
					<br />	
					<?php echo self::desc($desc); ?>
				</td>
			</tr>

		<?php
		
	
		}
		
		/**
		 * 	checkbox filed
		 *   
		 *
		 * @author Goran Petrovic
		 * @since 1.0
		 *
		 * @return html
		 **/
		static function wp_media( $post, $id, $label, $value, $desc = '' , $attr = array() ){ 
		
		
			$name  		= str_replace( "-","_", sanitize_title( $id ) );
			$post_meta 	= self::get_post_meta( $post->ID ); 
			$value 		= isset( $post_meta[ $name ] ) ? $post_meta[ $name ] : $value ;  ?>
	
			<tr>
				<td id="newmetaleft" class="left">
					<?php echo !empty($label) ? "<p><strong>{$label}</strong></p>": ''; ?>

					<img src="<?php echo $value ?>" alt="-" id="meta<?php echo $id ?>" style="width:250px;"/>
					<br />

					<?php echo Form::wp_image("meta[$name]", $value, $attr); ?><br />	
					<?php echo self::desc($desc); ?>
				</td>
			</tr>

		<?php
			
			}
			
			
		
		/**
		 * 	checkbox filed
		 *   
		 *
		 * @author Goran Petrovic
		 * @since 1.0
		 *
		 * @return html
		 **/
		static function page_builder( $post, $id ){  ?>
			<style type="text/css" media="screen">
				.left{
					float:left;
				}	
				.number_of_sections{
					margin-top:4px;
				}
				.the_chameleon_option_wrap{float:left; margin-right:5px; margin-bottom:5px;}
			</style>
			<?php

			$name  		= str_replace( "-","_", sanitize_title( $id ) );
			$post_meta 	= self::get_post_meta( $post->ID ); 

			global $config; 	?>

			<tr>
				<td id="newmetaleft" class="left">
						
					<div class="left" style="width:100%;">
						<!-- CREATE SIDEABR OF SECTIONS 	-->
						<label for="active_page_builder"><input id="active_page_builder" type="checkbox" name="meta[active_page_builder]" value="1" <?php checked(	isset( $post_meta['active_page_builder'] ) ? $post_meta['active_page_builder'] : '' , 1 ); ?>  ><strong> <?php _e('Active Page Builder', 'the-chameleon' ); ?> </strong></label>
						<br /><br />
					</div>
		
					<script type="text/javascript" charset="utf-8">
						jQuery(document).ready(function() {	
							jQuery( "#create_sidebar_button" ).click(function() {		
								var value = jQuery('#create_sidebar').val();
								jQuery('#create_sidebars_messages').html('');
									
								if(value!=''){
									jQuery.post( '<?php echo get_template_directory_uri() ?>/parts/Widgets/ajax/add_sidebar.php', { create_sidebar: value })
									  .done(function( data ) {
										
											if(data=='success'){

												jQuery('.the_chameleon_sidebars').append('<option value="'+value+'"  >'+value+'</option>');
												jQuery('#create_sidebars_messages').html('<p style="color:green;"><?php _e("Successfully create new sidebar.", "the-chameleon" ); ?></p>');
											
												jQuery('#create_sidebar').attr('value', '');
													
											}else if(data=='exist'){

												jQuery('#create_sidebars_messages').html('<p style="color:red;"><?php _e("Sidebar with that name already exist.", "the-chameleon" ); ?>.</p>');
											
											}
								
									  });
									
								}else{
									
									alert('Field Sidebar Name can\'t be empty!');
								}
								return false;
							});	
						});
					</script>	
						
					<div class="left" style="width:100%;">
						<!-- CREATE SIDEABR FOR SECTIONS 	-->
						<?php echo '<p class="create_sidebars""><strong>' . __("Create Sidebar", "the-chameleon" ) .'</strong></p>'; ?>
						<div id="create_sidebars_messages" class=""> </div>
						<?php echo Form::input("create_sidebar", '', array('style'=>'display:inline; float:left; width:200px;', 'placeholder'=>'Unique Sidebar Name')); ?>
						
						<a id="create_sidebar_button" class="button" href="#" onclick="" style="float:left; margin:3px 0px 5px 5px;"><?php _e("Add sidebar", "the-chameleon" ); ?></a>
					</div>

				</td>
			</tr>


			<!-- HEADER -->
			<tr>
				<td id="newmetaleft" class="left">
					
					<?php echo '<p><strong>'. __("Header", "the-chameleon" ) .'</strong></p>'; ?>
					
					<div class="left the_chameleon_option_wrap" style="">
						<?php echo Form::select("meta[header_wrap]", isset( $post_meta['header_wrap'] ) ? $post_meta['header_wrap'] : '' , $config->wraps); ?>
					</div>
					
					<div class="left the_chameleon_option_wrap" style="">
						<?php echo Form::select("meta[header_sidebar]", isset( $post_meta['header_sidebar'] ) ? $post_meta['header_sidebar'] : ''  , $config->sidebars, array('class'=>'the_chameleon_sidebars')); ?>
					</div>
					
					<div class="left the_chameleon_option_wrap" style="">
						<?php echo Form::select("meta[header_col]", isset( $post_meta['header_col'] ) ? $post_meta['header_col'] : ''  , array_merge(array(''=>__('Columns','the-chameleon')), $config->columns) ); ?>
					</div>
				
					<div class="left the_chameleon_option_wrap" style="">
						<?php echo Form::select("meta[header_animate]", isset( $post_meta['header_animate'] ) ? $post_meta['header_animate'] : ''  , $config->animates); ?>
					</div>
					
					<div class="left the_chameleon_option_wrap" style="">
						<?php echo Form::select("meta[header_duration]",  isset( $post_meta['header_duration'] ) ? $post_meta['header_duration'] : ''  , $config->animate_durations); ?>
					</div>
					
					<div class="left the_chameleon_option_wrap" style="">
						<?php echo Form::select("meta[header_delay]",  isset( $post_meta['header_delay'] ) ? $post_meta['header_delay'] : ''  , $config->animate_delays); ?>
					</div>
					<div class="left the_chameleon_option_wrap" style="width:100%">
						<?php echo '<p class="howto">'.__("Choice options for Header", "the-chameleon" ).'</p>' ?>
					</div>
				</td>
			</tr>


			<!-- TOP -->
			<tr>
				<td id="newmetaleft" class="left">

					<?php 	echo '<p ><strong>' . __("Top", "the-chameleon" ).'</strong></p>'; ?>


					<div class="left the_chameleon_option_wrap" style="">
						<?php echo Form::select("meta[top_wrap]", isset( $post_meta['top_wrap'] ) ? $post_meta['top_wrap'] : '' , $config->wraps); ?>
					</div>

					<div class="left the_chameleon_option_wrap" style="">
						<?php echo Form::select("meta[top_sidebar]", isset( $post_meta['top_sidebar'] ) ? $post_meta['top_sidebar'] : '' , $config->sidebars, array('class'=>'the_chameleon_sidebars')); ?>
					</div>

					<div class="left the_chameleon_option_wrap" style="">
						<?php echo Form::select("meta[top_col]", isset( $post_meta['top_col'] ) ? $post_meta['top_col'] : '' , array_merge(array(''=>__('Columns','the-chameleon')), $config->columns) ); ?>
					</div>

					<div class="left the_chameleon_option_wrap" style="">
						<?php echo Form::select("meta[top_animate]", isset( $post_meta['top_animate'] ) ? $post_meta['top_animate'] : '' , $config->animates); ?>
					</div>

					<div class="left the_chameleon_option_wrap" style="">
						<?php echo Form::select("meta[top_duration]", isset( $post_meta['top_duration'] ) ? $post_meta['top_duration'] : '' , $config->animate_durations); ?>
					</div>

					<div class="left the_chameleon_option_wrap" style="">
						<?php echo Form::select("meta[top_delay]", isset( $post_meta['top_delay'] ) ? $post_meta['top_delay'] : '' , $config->animate_delays); ?>
					</div>
					
					<div class="left the_chameleon_option_wrap" style="width:100%">
						<?php echo '<p class="howto">'.__("Choice options for Top", "the-chameleon" ).'</p>' ?>
					</div>
				</td>
			</tr>


			<!-- MAIN -->
			<tr>
				<td id="newmetaleft" class="left">

					<?php 	echo '<p><strong>'.__("Main Content", "the-chameleon" ).'</strong></p>'; ?>

					<div class="" style="">
						<?php echo Form::select("meta[main_wrap]",  isset( $post_meta['main_wrap'] ) ? $post_meta['main_wrap'] : ''  , $config->wraps); ?>
					</div>

					<div class="left the_chameleon_option_wrap" style="width:100%">
						<?php echo '<p class="howto">'.__(" Choice options for Main content", "the-chameleon" ).'</p>' ?>
					</div>
				</td>
			</tr>
			
			
			<!-- NUMBER OF SECTIONS -->
			<tr>
				<td>						
					<?php for ($i=1; $i <= 20 ; $i++) :
							$choices_number_of_sections[$i] = $i ; 
						  endfor;
					echo '<p class="number_of_sections"><strong>'.__("Number of Sections", "the-chameleon" ).'</strong>';
					echo Form::select("meta[number_of_sections]",  isset( $post_meta['number_of_sections'] ) ? $post_meta['number_of_sections'] : '5' , $choices_number_of_sections); 

					echo '</p>';
					?>
					<div class="left the_chameleon_option_wrap" style="width:100%">
						<?php echo '<p class="howto">'.__("Choice number of section in Main content", "the-chameleon" ).'</p>' ?>
					</div>
				</td>	
			</tr>
			
			<!-- SECTIONS -->
			<?php for ($i=1; $i <= 20; $i++) : ?>

			<tr id="meta_section_<?php echo $i; ?>_wrap">
				<td id="newmetaleft" class="left">
	
					<?php printf('<p class="number_of_sections"><strong>'.__("Section %s", "the-chameleon" ).'</strong></p>',$i) ?>

					<div class="left the_chameleon_option_wrap" style="">
						<?php echo Form::select("meta[section_{$i}_wrap]",  isset( $post_meta["section_{$i}_wrap"] ) ? $post_meta["section_{$i}_wrap"] : ''  , $config->wraps); ?>
					</div>

					<div class="left the_chameleon_option_wrap" style="">
						<?php echo Form::select("meta[section_{$i}_sidebar]",  isset( $post_meta["section_{$i}_sidebar"] ) ? $post_meta["section_{$i}_sidebar"] : ''  , $config->sidebars, array('class'=>'the_chameleon_sidebars')); ?>
					</div>

					<div class="left the_chameleon_option_wrap" style="">
						<?php echo Form::select("meta[section_{$i}_col]",  isset( $post_meta["section_{$i}_col"] ) ? $post_meta["section_{$i}_col"] : ''  , array_merge(array(''=>__('Columns','the-chameleon')), $config->columns) ); ?>
					</div>

					<div class="left the_chameleon_option_wrap" style="">
						<?php echo Form::select("meta[section_{$i}_class]",  isset( $post_meta["section_{$i}_class"] ) ? $post_meta["section_{$i}_class"] : ''  , $config->page_builder_classes ); ?>
					</div>

					<div class="left the_chameleon_option_wrap" style="">
						<?php echo Form::input("meta[section_{$i}_custom_class]",  isset( $post_meta["section_{$i}_custom_class"] ) ? $post_meta["section_{$i}_custom_class"] : ''  , array('placeholder'=>'Custom class', 'style'=>'width:120px') ); ?>
					</div>

					<div class="left the_chameleon_option_wrap" style="">
						<?php echo Form::select("meta[section_{$i}_animate]",  isset( $post_meta["section_{$i}_animate"] ) ? $post_meta["section_{$i}_animate"] : ''  , $config->animates); ?>
					</div>

					<div class="left the_chameleon_option_wrap" style="">
						<?php echo Form::select("meta[section_{$i}_duration]",  isset( $post_meta["section_{$i}_duration"] ) ? $post_meta["section_{$i}_duration"] : ''  , $config->animate_durations); ?>
					</div>

					<div class="left the_chameleon_option_wrap" style="">
						<?php echo Form::select("meta[section_{$i}_delay]",  isset( $post_meta["section_{$i}_delay"] ) ? $post_meta["section_{$i}_delay"] : ''  , $config->animate_delays); ?>
					</div>
					<div class="left the_chameleon_option_wrap" style="width:100%">
						<?php printf('<p class="howto">'.__("Choice options for Section %s", "the-chameleon" ).'</p>',$i) ?>

					</div>
				</td>
			</tr>
	
			<?php endfor; ?>
			
			<!-- Bottom -->
			<tr>
				<td id="newmetaleft" class="left">

					<?php 	echo '<p class="number_of_sections"><strong>'.__("Bottom", "the-chameleon" ).'</strong>'; ?>

					<div class="left the_chameleon_option_wrap" style="">
						<?php echo Form::select("meta[bottom_wrap]",  isset( $post_meta['bottom_wrap'] ) ? $post_meta['bottom_wrap'] : '' , $config->wraps); ?>
					</div>

					<div class="left the_chameleon_option_wrap" style="">
						<?php echo Form::select("meta[bottom_sidebar]", isset( $post_meta['bottom_sidebar'] ) ? $post_meta['bottom_sidebar'] : '' , $config->sidebars, array('class'=>'the_chameleon_sidebars')); ?>
					</div>

					<div class="left the_chameleon_option_wrap" style="">
						<?php echo Form::select("meta[bottom_col]", isset( $post_meta['bottom_col'] ) ? $post_meta['bottom_col'] : '' , array_merge(array(''=>__('Columns','the-chameleon')), $config->columns) ); ?>
					</div>

					<div class="left the_chameleon_option_wrap" style="">
						<?php echo Form::select("meta[bottom_animate]", isset( $post_meta['bottom_animate'] ) ? $post_meta['bottom_animate'] : '' , $config->animates); ?>
					</div>

					<div class="left the_chameleon_option_wrap" style="">
						<?php echo Form::select("meta[bottom_duration]", isset( $post_meta['bottom_duration'] ) ? $post_meta['bottom_duration'] : '' , $config->animate_durations); ?>
					</div>

					<div class="left the_chameleon_option_wrap" style="">
						<?php echo Form::select("meta[bottom_delay]", isset( $post_meta['bottom_delay'] ) ? $post_meta['bottom_delay'] : '' , $config->animate_delays); ?>
					</div>
					<div class="left the_chameleon_option_wrap" style="width:100%">
						<?php echo '<p class="howto">'.__("Choice options for bottom", "the-chameleon" ).'</p>' ?>
					</div>
				</td>
			</tr>
		<?php

		}


		/**
		 * 	Sanitize filed name   
		 *   
		 *
		 * @author Goran Petrovic
		 * @since 1.0
		 *
		 * @return string
		 **/
		function sanitize_name( $name ){

			return str_replace('-', '_', sanitize_title(  (string)$name ) );
					
		}
		
		/**
		 * 	 Get values  
		 *   
		 *
		 * @author Goran Petrovic
		 * @since 1.0
		 *
		 * @return void
		 **/		
	    static function get_post_meta( $post_id ){
		
			global $config;
			$slug = $config->slug;
			
			return get_post_meta($post_id, $slug.'meta', TRUE);
	
		}
		
		
		/**
		 * 	 Description  
		 *   
		 *
		 * @author Goran Petrovic
		 * @since 1.0
		 *
		 * @return html
		 **/		
		static function desc( $desc ){
			
 			 return ($desc!='') ? '<p class="howto">'.$desc.'</p>' : NULL;
			
		}
		
		
		/**
		 * 	Filed atributes 
		 *   
		 *
		 * @author Goran Petrovic
		 * @since 1.0
		 *
		 * @return html input atributes name = "value"
		 **/	
		static function attr( $attrs )
		{
			
			$result = '';
			foreach ( $attrs as $key => $value) :
				$result .= $key. '="' .$value.'" ';
			endforeach;
			
		  return $result; 
			
			
		}
		
		
	}



	
?>