<footer class="col100 post-content post-content-single post-footer post-footer-single">
	
	<?php
			$defaults = array(
				'before'           => '<p>' . __( 'Pages:', 'the-chameleon'),
				'after'            => '</p>',
				'link_before'      => '',
				'link_after'       => '',
				'next_or_number'   => 'number',
				'separator'        => ' ',
				'nextpagelink'     => __( 'Next page', 'the-chameleon' ),
				'previouspagelink' => __( 'Previous page', 'the-chameleon' ),
				'pagelink'         => '%',
				'echo'             => 1 
			 );

	        wp_link_pages( $defaults ); 	
	  ?>
	
	<div class="col100 col-2">
		<?php dynamic_sidebar( 'Post Footer' ); ?>
	</div>

</footer>



<?php comments_template( '/templates/comments.php', true );  ?>