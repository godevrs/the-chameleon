<section id="page-title-<?php the_ID() ?>" class="page-title">		
	<?php

	  $showOnHome  = 1; // 1 - show breadcrumbs on the homepage, 0 - don't show
	  $delimiter   = ''; // delimiter between crumbs
	  $home 	   = 'Home'; // text for the 'Home' link
	  $showCurrent = 1; // 1 - show current post/page title in breadcrumbs, 0 - don't show
	  $before      = ''; // tag before the current crumb
	  $after       = ''; // tag after the current crumb

	  global $post;
	  $homeLink = home_url();

	  if ( is_home() || is_front_page() ) {

			if ( is_main_query() ) :
				
				$get_posts_page = get_option('page_for_posts');
				
				echo '<h1>' . get_the_title(	$get_posts_page ) . '</h1>';
	    
			else:
				if ( $showOnHome == 1 ) echo '<h1>' . get_the_title() . '</h1>';
			endif;

	  } else {

	    	echo '<h1>';

	    if ( is_category() ) {
	     
	      	echo $before . ' ' . single_cat_title('', false) . '' . $after;

	    } elseif ( is_search() ) {
		
	      	echo $before . __('Search results for', 'the-chameleon') . '"' . get_search_query() . '"' . $after;

	    } elseif ( is_day() ) {
	    
	      	echo $before . get_the_time('Y').' '.get_the_time('F').' '.get_the_time('d') . $after;

	    } elseif ( is_month() ) {
	     
	      	echo $before . get_the_time('F') .' '.get_the_time('Y'). $after;

	    } elseif ( is_year() ) {
		
	      	echo $before . get_the_time('Y') . $after;

	    } elseif ( is_single() && !is_attachment() ) {  
		
	     	 if ( get_post_type() != 'post' ) {
		
				if ( is_singular('portfolio') ) {

			
				$term = wp_get_post_terms(get_the_ID(), 'portfolios', array("fields" => "names", 'parent'=>0));
						
			
					if ( $term )
				  echo $before .$term[0] . $after;
					
					
				}else {		
		
		      	  $post_type = get_post_type_object(get_post_type());
			        $slug 	   = $post_type->rewrite;
		
			        if ( $showCurrent == 1 ) echo ' ' . $delimiter . ' ' . $before . get_the_title() . $after.'';
				}
		
		
		      } else {
	       
		         echo $before . get_the_title() . $after;
		
		      }
		
			//taxonomy
		    } elseif ( is_tax()) {
				
				$term_slug = get_query_var( 'term' );
				$taxonomy_name = get_query_var( 'taxonomy' );
				$current_term = get_term_by( 'slug', $term_slug, $taxonomy_name );

				echo  $before .  $current_term->name . $after;

 
			} elseif ( !is_single() && !is_page() && get_post_type() != 'post' && !is_404() ) {
	
		      	$post_type = get_post_type_object(get_post_type());
		      	echo $before . $post_type->labels->singular_name . $after;

		    } elseif ( is_attachment() ) {
			
		      	$parent = get_post( $post->post_parent );
		      	$cat 	= get_the_category( $parent->ID ); $cat = $cat[0];
		      	if ( $showCurrent == 1 ) echo ' ' . $delimiter . ' ' . $before . get_the_title() . $after;

		    } elseif ( is_page() && !$post->post_parent ) {
			
		      	if ( $showCurrent == 1 ) echo $before . get_the_title() . $after;

		    } elseif ( is_page() && $post->post_parent ) {
			
		      	$parent_id  = $post->post_parent;
		      	$breadcrumbs = array();
		
		      	while ( $parent_id ) {
			
		        	$page = get_page( $parent_id );
		        	$breadcrumbs[] =  get_the_title( $page->ID );
		        	$parent_id  = $page->post_parent;
		
		      	}
		
		      	$breadcrumbs = array_reverse( $breadcrumbs );
		
		      	for ($i = 0; $i < count( $breadcrumbs ); $i++) {
					if ($i != count( $breadcrumbs ) - 1 ) echo ' ' . $delimiter . ' ';
		      	}
		
		      	if ( $showCurrent == 1 ) echo ' ' . $delimiter . ' ' . $before . get_the_title() . $after;

	    } elseif ( is_tag() ) {
		
	      	echo $before . 'Posts tagged "' . single_tag_title('', false) . '"' . $after;

	    } elseif ( is_author() ) {
		
	        global $author;
		    $userdata = get_userdata( $author );
		
	      	echo $before . __('Articles posted by', 'the-chameleon')  . $userdata->display_name . $after;

	    } elseif ( is_404() ) {
		
	      	echo $before . __('Error 404', 'the-chameleon') . $after; 
	
	    }

	    if ( get_query_var('paged') ) {
		
	      	if ( is_category() || is_day() || is_month() || is_year() || is_search() || is_tag() || is_author() ) echo ' (';
	      	echo ' ' . __('Page', 'the-chameleon') . ' ' . get_query_var('paged');
	      	if ( is_category() || is_day() || is_month() || is_year() || is_search() || is_tag() || is_author() ) echo ')';
	    }

	    echo '</h1>';

	  }

	?>
</section>