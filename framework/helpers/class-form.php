<?php

	namespace TheChameleon;
	
	/**
	 * Form Helper 
	 * 
	 * 
	 * @author 		Goran Petrovic <goran.petrovic@godev.rs>
	 * @package    	WordPress
	 * @subpackage 	GoX
	 * @since 		GoX 1.0.0
	 *
	 * @version 1.0.1
	 *
	 */	
	class Form{
		
		/**
		 * 	Input field
		 *
		 * @author Goran Petrovic
		 * @since 1.0
		 *
		 * @var string $name -  filed name, format _ or -, filed_name
		 * @var string $value - default value
		 * @var array  $attr  - html attributes
		 *
		 * @return <input type="text" ...>
		 **/
		static function input( $name, $value = '', $attr = array() )
		{ 
			//filetr filed name 
			$id   = str_replace( "-","_", sanitize_title( $name ) ) ;	
			//colect atribute whic is remove in static function attr			
			$id   = !empty( $attr['id'] ) ? $attr['id'] : $id  ;
			$type = !empty( $attr['type'] ) ? $attr['type'] : 'text';
							
			return '<input id="' . esc_attr( $id ) . '" type="' . esc_attr( $type ) . '" name="' . esc_attr( $name ) . '" value="' . esc_attr( $value ) . '" ' . self::attr($attr) . ' >';
				
		}
		
		/**
		 * 	Input field
		 *
		 * @author Goran Petrovic
		 * @since 1.0
		 *
		 * @var string $name -  filed name, format _ or -, filed_name
		 * @var string $value - default value
		 * @var array  $attr  - html attributes
		 *
		 * @return <input type="text" ...>
		 **/
		static function textarea( $name, $value = '', $attr = array() )
		{ 
			//filetr filed name 
			$id   = str_replace( "-","_", sanitize_title( $name ) ) ;	
			//colect atribute whic is remove in static function attr			
			$id   = !empty( $attr['id'] ) ? $attr['id'] : $id  ;
			$type = !empty( $attr['type'] ) ? $attr['type'] : 'text';
							
			return '<textarea id="' . esc_attr( $id ) . '" name="' . esc_attr( $name ) . '" ' . self::attr($attr) . ' >'.esc_textarea( $value ).'</textarea>';
				
		}
		
		/**
		 * 	Select box
		 *
		 * @author Goran Petrovic
		 * @since 1.0
		 *
		 * @var string $name -  filed name, format _ or -, filed_name
		 * @var string $value - default value
		 * @var array $choices - options for sellect in array 'value' => 'name'
		 * @var array  $attr  - html attributes
		 *
		 * @return <select name=..>
		 **/
		static function select( $name, $value, $choices, $attr = array() )
		{				
			$id = str_replace( "-","_", sanitize_title( $name ) ) ;
			//colect atribute whic is remove in static function attr			
			$id   = !empty( $attr['id'] ) ? $attr['id'] : $id  ; ?>	
			<select id="<?php echo esc_attr( $id ); ?>" name="<?php echo esc_attr( $name ); ?>" <?php echo self::attr( $attr ) ?> >
				<?php foreach ( $choices as $key => $choice ) : ?>
					<option value="<?php echo esc_attr( $key ) ?>" <?php selected( esc_attr( $value ), $key, 1 );?> ><?php echo esc_attr( $choice ) ?></option>
				<?php endforeach; ?>
			</select>	
			<?php
						
		}
		
	
		/**
		 * 	Image upload 
		 *  http://www.lenslider.com/articles/wordpress-3-5-media-uploader-tips-on-using-it-within-plugins/
		 * @author Goran Petrovic
		 * @since 1.0
		 *
		 * @var string $name -  filed name, format _ or -, filed_name
		 * @var string $value - default value
		 * @var array $choices - options for sellect in array 'value' => 'name'
		 * @var array  $attr  - html attributes
		 *
		 * @return <select name=..>
		 **/
		static function wp_image( $name, $value = '', $attr = array() ){	
			
			//colect atribute whic is remove in static function attr			
			$the_id   = !empty( $attr['id'] ) ? $attr['id'] : str_replace( "-","_", sanitize_title( $name ) ) ; 	?>	

			<input type="hidden" name="<?php echo $name ?>" id="<?php echo $the_id ?>" value="<?php echo $value ?>">

			<a href="javascript:;" class="open_<?php echo $the_id ?>">Open Media Uploader</a>

				<script type="text/javascript" charset="utf-8">


					jQuery(document).ready(function() {
					   //uploading files variable
					   var custom_file_frame;
					   jQuery(document).on('click', '.open_<?php echo $the_id ?>', function(event) {
					      event.preventDefault();
					      //If the frame already exists, reopen it
					      if (typeof(custom_file_frame)!=="undefined") {
					         custom_file_frame.close();
					      }

					      //Create WP media frame.
					      custom_file_frame = wp.media.frames.customHeader = wp.media({
					         //Title of media manager frame
					         title: "Select Image",
					         library: {
					            type: 'image'
					         },
					         button: {
					            //Button text
					            text: "Insert Image"
					         },
					         //Do not allow multiple files, if you want multiple, set true
					         multiple: false
					      });

					      //callback for selected image
					      custom_file_frame.on('select', function() {
					         var attachment = custom_file_frame.state().get('selection').first().toJSON();
					         //do something with attachment variable, for example attachment.filename
					         //Object:
					         //attachment.alt - image alt
					         //attachment.author - author id
					         //attachment.caption
					         //attachment.dateFormatted - date of image uploaded
					         //attachment.description
					         //attachment.editLink - edit link of media
					         //attachment.filename
					         //attachment.height
					         //attachment.icon - don't know WTF?))
					         //attachment.id - id of attachment
					         //attachment.link - public link of attachment, for example ""http://site.com/?attachment_id=115""
					         //attachment.menuOrder
					         //attachment.mime - mime type, for example image/jpeg"
					         //attachment.name - name of attachment file, for example "my-image"
					         //attachment.status - usual is "inherit"
					         //attachment.subtype - "jpeg" if is "jpg"
					         //attachment.title
					         //attachment.type - "image"
					         //attachment.uploadedTo
					         //attachment.url - http url of image, for example "http://site.com/wp-content/uploads/2012/12/my-image.jpg"
					         //attachment.width
					
					
								jQuery('img#<?php echo $the_id ?>').attr('src', attachment.url);
								jQuery('input#<?php echo $the_id ?>').attr('value', attachment.url);

								
						
					      });

					      //Open modal
					      custom_file_frame.open();
					   });
					});
				</script>
				<?php


		       //call for new media manager
		       wp_enqueue_media();

		      //maybe..
		      wp_enqueue_style('media');

		

			
		
						
		}
		/**
		 * 	Color 
		 *	https://make.wordpress.org/core/2012/11/30/new-color-picker-in-wp-3-5/
		 *
		 * @author Goran Petrovic
		 * @since 1.0
		 *
		 * @var string $id 
		 * @var string $title 
		 *
		 * @retur	
		*/
		
		
		
		/**
		 * 	Submit 
		 *
		 * @author Goran Petrovic
		 * @since 1.0
		 *
		 * @var string $id 
		 * @var string $title 
		 *
		 * @return <label name=..>
		 **/			
		static function submit( $name, $title, $attr= array() ){				

			return '<input type="submit" name="' . $name . '" value="'. $title .'" ' . self::attr( $attr ) . '>';

		}
		
		
		/**
		 * 	Label 
		 *
		 * @author Goran Petrovic
		 * @since 1.0
		 *
		 * @var string $id 
		 * @var string $title 
		 *
		 * @return <label name=..>
		 **/			
		static function label( $id, $title ){				
			
			return '<label for="' . $id . '">' . $title . '</label>';

		}

		/**
		 * 	Input atributes return html attr from array
		 *   
		 *
		 * @author Goran Petrovic
		 * @since 1.0
		 *
		 * @var array $attrs atributes in array( 'name' => 'value')
		 * @var array $filter atributes for remove array( 'name', 'name1')
		 *
		 * @return html attributs 
		 **/	
		static function attr( $attrs, $filter = array() ){
			
				$filter = array('type', 'id');
				$result = '';

				foreach ( $attrs as $key => $value) :
					//if ont in filetr var 
					if (!in_array($key, $filter)) :			
						$result .= $key. '="' .$value.'" ';	
					endif;	
				endforeach;

			return $result; 


		}
		
		
	}
	


?>