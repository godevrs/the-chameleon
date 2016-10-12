<?php

	global $TheChameleon;
	global $data;


if ( have_posts() ) :  
	while ( have_posts() ) : the_post(); 

	
	$post_type = get_post_type( get_the_ID() );
	
	$format = get_post_format();
	if ( false === $format )
		$format = 'standard'; ?>
			
<article id="post-<?php the_ID(); ?>" <?php post_class('post-single'); ?> itemscope itemtype="http://schema.org/Article">
			
	<?php //filter post view
	
		$filter_name = 'the_chameleon_single_' . $post_type . '_' . $format . '_view';
		$view = apply_filters( 	$filter_name , 'parts/Post/view/formats/post-'. $format);
		get_template_part( $view ); 
		
		$filter_footer_name = 'the_chameleon_single_' . $post_type . '_' . $format . '_footer_view';	
		$viewFooter = apply_filters( $filter_footer_name, 'parts/Post/view/formats/footer');
		get_template_part(	$viewFooter );
		
		?>


</article>

<?php endwhile; 
	endif; 
wp_reset_query(); ?>