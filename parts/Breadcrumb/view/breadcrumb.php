<?php global $data;
	  global $post;
	
	  $showOnHome 	= 1; // 1 - show breadcrumbs on the homepage, 0 - don't show
	  $delimiter 	= ! empty( $data['delimiter'] ) ? $data['delimiter'] : '&raquo;'; // delimiter between crumbs	
	  $home 		= 'Home'; // text for the 'Home' link
	  $showCurrent 	= 1; // 1 - show current post/page title in breadcrumbs, 0 - don't show
	  $before 		= '<span class="current">'; // tag before the current crumb
	  $after 		= '</span>'; // tag after the current crumb
	  $homeLink 	= home_url();

	  if ( is_home() || is_front_page() ) {

			if ( is_main_query() ) :
			
				$get_posts_page = get_option( 'page_for_posts' );
	
	    		if ( $showOnHome == 1 ) : echo '<section class="breadcrumb" itemprop="breadcrumb"><a href="' . $homeLink . '">' . $home . '</a> ' . $delimiter .'  '. get_the_title(	$get_posts_page ); endif;
				
				 if ( get_query_var('paged') ) :
				      if ( is_category() || is_day() || is_month() || is_year() || is_search() || is_tag() || is_author() ) echo ' (';
				      echo ' ('.__('Page', 'the-chameleon') . ' ' . get_query_var('paged').')';
				      if ( is_category() || is_day() || is_month() || is_year() || is_search() || is_tag() || is_author() ) echo ')';
				    endif;
			
				echo '</section>';
			else:
		
	    		if ( $showOnHome == 1 ) echo '<section class="breadcrumb" itemprop="breadcrumb"><a href="' . $homeLink . '">' . $home . '</a></section>';

			endif;
			
	  } else {

	    	echo '<section class="breadcrumb" itemprop="breadcrumb"><a href="' . $homeLink . '">' . $home . '</a> ' . $delimiter . ' ';

	    if ( is_category() ) { 
		
	      	$thisCat = get_category(get_query_var('cat'), false);
	      	if ( $thisCat->parent != 0 ) echo get_category_parents( $thisCat->parent, TRUE, ' ' . $delimiter . ' ');
	      	echo $before . ' ' . single_cat_title('', false) . '' . $after;

	    } elseif ( is_search() ) { 
		
	      	echo $before . __('Search results for', 'the-chameleon') .' "' . get_search_query() . '"' . $after;

	    } elseif ( is_day() ) {
		
	      	echo '<a href="' . get_year_link(get_the_time('Y')) . '">' . get_the_time('Y') . '</a> ' . $delimiter . ' ';
	      	echo '<a href="' . get_month_link(get_the_time('Y'),get_the_time('m')) . '">' . get_the_time('F') . '</a> ' . $delimiter . ' ';
	      	echo $before . get_the_time('d') . $after;

	    } elseif ( is_month() ) {
		
	      	echo '<a href="' . get_year_link(get_the_time('Y')) . '">' . get_the_time('Y') . '</a> ' . $delimiter . ' ';
	      	echo $before . get_the_time('F') . $after;

	    } elseif ( is_year() ) {
		
	      	echo $before . get_the_time('Y') . $after;

	    } elseif ( is_single() && !is_attachment() ) {
	
			 if ( get_post_type() != 'post' ) {					
				$taxonomy_names = get_object_taxonomies( get_post_type()  );
				$taxonomy = $taxonomy_names[0];		
				$args = array('orderby' => 'parent', 'order' => 'DESC', 'fields' => 'all');		
				$terms = wp_get_post_terms(get_the_ID(), $taxonomy, $args );		
			 	$tmpCrumbs = array();
			
		       foreach ($terms as $term) {
			
	            	$crumb = '<a href="' . get_term_link( $term, $taxonomy ) . '">' . $term->name . '</a> '. $delimiter .' ';
	            	array_push( $tmpCrumbs, $crumb );
	        	}
	
		  		echo $before . implode('', array_reverse($tmpCrumbs));
		
	        	if ($showCurrent == 1) echo  get_the_title() . $after;
	
	      	} else { 
		
	        	$cat  = get_the_category(); $cat = $cat[0];
	        	$cats = get_category_parents ($cat, TRUE, ' ' . $delimiter . ' ');
	
	        	if ( $showCurrent == 0 ) $cats = preg_replace("#^(.+)\s$delimiter\s$#", "$1", $cats );
	        		echo $cats;
	        	if ( $showCurrent == 1 ) echo $before . get_the_title() . $after;
	      	}

	    } elseif ( is_tax() ){
		
	        $term 	   = get_term_by("slug", get_query_var("term"), get_query_var("taxonomy") );
	        $tmpTerm   = $term;
	        $tmpCrumbs = array();
	
	        while ( $tmpTerm->parent > 0 ){
	            $tmpTerm = get_term( $tmpTerm->parent, get_query_var("taxonomy") );
	            $crumb = '<a href="' . get_term_link($tmpTerm, get_query_var('taxonomy') ) . '">' . $tmpTerm->name . '</a> '. $delimiter .' ';
	            array_push( $tmpCrumbs, $crumb );
	        }
	        echo $before .implode('', array_reverse($tmpCrumbs));
	        echo $term->name. $after;
		
		} elseif ( !is_single() && !is_page() && get_post_type() != 'post' && !is_404() && !is_author() ) {

	      	$post_type = get_post_type_object(get_post_type());
	      	echo $before . $post_type->labels->singular_name . $after;

	    } elseif ( is_attachment() ) {
		
	      	$parent = get_post( $post->post_parent );
	
	      	echo '<a href="' . get_permalink( $parent ) . '">' . $parent->post_title . '</a>';
	
	      	if ( $showCurrent == 1 ) echo ' ' . $delimiter . ' ' . $before . get_the_title() . $after;

	    } elseif ( is_page() && !$post->post_parent ) {
		
	      	 if ( $showCurrent == 1 ) echo $before . get_the_title() . $after;

	    } elseif ( is_page() && $post->post_parent ) {
		
	     	 $parent_id   = $post->post_parent;
		     $breadcrumbs = array();
		
		      while ( $parent_id ) {
			
		        $page = get_page( $parent_id );
		        $breadcrumbs[] = '<a href="' . get_permalink( $page->ID ) . '">' . get_the_title( $page->ID ) . '</a>';
		        $parent_id  = $page->post_parent;
		      }
		
		      $breadcrumbs = array_reverse( $breadcrumbs );
		
		      for ( $i = 0; $i < count( $breadcrumbs ); $i++ ) {
			
		        echo $breadcrumbs[ $i ];
		
		        if ( $i != count( $breadcrumbs ) - 1 ) echo ' ' . $delimiter . ' ';
		
		      }
		
		      if ( $showCurrent == 1 ) echo ' ' . $delimiter . ' ' . $before . get_the_title() . $after;

	    } elseif ( is_tag() ) {
	
	      	echo $before .  __('Posts tagged ', 'the-chameleon')  .' "' . single_tag_title('', false) . '"' . $after;

	    } elseif ( is_author() ) {
		
	       	global $author; 
	
	      	$userdata =get_userdata(get_query_var('author'));
	      	echo $before . 'Articles posted by ' . $userdata->display_name . $after;

	    } elseif ( is_404() ) {
		
	      	echo $before . 'Error 404' . $after;
	    }
	
	    if ( get_query_var('paged') ) {
		
	   	   	if ( is_category() || is_day() || is_month() || is_year() || is_search() || is_tag() || is_author() || is_tax()) echo ' (';
		    echo ' ' . __('Page', 'the-chameleon') . ' ' . get_query_var('paged');
		    if ( is_category() || is_day() || is_month() || is_year() || is_search() || is_tag() || is_author() || is_tax()) echo ' )';
	    }

	    echo '</section>';

	  } ?>