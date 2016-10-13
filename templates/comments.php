<?php


	/**
	 * @package WordPress
	 * @subpackage TheChameleon
	 */

	// Do not delete these lines
		if (!empty($_SERVER['SCRIPT_FILENAME']) && 'comments.php' == basename($_SERVER['SCRIPT_FILENAME']))
			die ('Please do not load this page directly. Thanks!');

		if ( post_password_required() ) { ?>
			<section id="comments" class="col100 post-content-single comments">
				<p class="nocomments"><?php _e('This post is password protected. Enter the password to view comments.','the-chameleon') ?></p>
			</section>
		<?php
			return;
		}
	?>

	<!-- You can start editing here. -->

	<?php if ( have_comments() ) : ?>
	
		<section id="comments" class="col100 post-content-single comments">
			
			<h4><?php comments_number('No Comments', 'One Comment', '% Comments' );?></h4>

			<ul class="col100 comments-list">
				<?php wp_list_comments('type=comment&callback=TheChameleon_comments_list'); ?>
			</ul>

			<div class="col100 navigation">
				<div class="alignleft"><?php previous_comments_link() ?></div>
				<div class="alignright"><?php next_comments_link() ?></div>
			</div>
	
		</section>
	
	 <?php else : // this is displayed if there are no comments so far ?>

		<?php if ( comments_open() ) : ?>
			<!-- If comments are open, but there are no comments. -->

		 <?php else : // comments are closed ?>
			<!-- If comments are closed. -->
			<section id="comments" class="col100 post-content-single comments">
				<p class="nocomments"><?php _e('Comments are closed.', 'the-chameleon') ?></p>
			</section>
		<?php endif; ?>
		
	<?php endif; ?>


	<?php if ( comments_open() ) : ?>

	<section id="respond" class="col100 post-content-single comment-respond">


		<div class="col100 cancel-comment-reply">
			<p><?php cancel_comment_reply_link(); ?></p>
		</div>

		<?php if ( get_option('comment_registration') && !is_user_logged_in() ) : ?>
			<div class="col100 message-comment-reply">		
				<p>You must be <a href="<?php echo wp_login_url( get_permalink() ); ?>">logged in</a> to post a comment.</p>
			</div>
		<?php else : ?>
	
		<?php comment_form(); ?>


		<?php endif; // If registration required and not logged in ?>
	</section>

	<?php endif; // if you delete this the sky will fall on your head ?>

	<?php 
	

	/**
	 * Commnets list template
	 *
	 * @author Goran Petrovic
	 * @since 1.0
	 *
	 * @param array $comment 
	 * @param array $args 
	 * @param int $depth 
	 * @return  html 
	 **/
	function TheChameleon_comments_list( $comment, $args, $depth ) {
		$GLOBALS['comment'] = $comment;
		switch ( $comment->comment_type ) :
			case '' :
		?>
		<li <?php comment_class( empty( $args['has_children'] ) ? '' : 'parent'  ); ?> id="comment-<?php comment_ID(); ?> ">
			<section id="section-comment-<?php comment_ID(); ?>">
						
				<section class="comment-header col100">
					<div class="alignleft comment-avatar">
						<?php echo get_avatar( $comment, 32 ); ?>
					</div>
					<?php printf( __( '%s', 'the-chameleon' ),  sprintf( '<h5 class="comment-author-name left" style="display:inline-block;">%s</h5>', get_comment_author_link() ) ) ; ?> 
				
					<div class="comment-meta">
						<small><?php printf( __( '<span class="comment-date">%1$s at %2$s</span>', 'the-chameleon' ), get_comment_date(),  get_comment_time() ); ?> 	<?php edit_comment_link( __( '(Edit)', 'the-chameleon' ), ' ' );	?></small>
					</div>
				</section>
			
				<section class="comment-content col100">
					
					<?php comment_text(); ?>
			
					<section class="reply">
						<?php comment_reply_link( array_merge( $args, array('add_below' => 'section-comment', 'depth' => $depth, 'max_depth' => $args['max_depth'] ) ) ); ?>
					</section>

					<section class="comment-status col100">
						<?php if ( $comment->comment_approved == '0' ) : ?>
							<em class="comment-awaiting-moderation"><?php _e( 'Your comment is awaiting moderation.', 'the-chameleon' ); ?></em>
							<br />
						<?php endif; ?>
					</section>
				
				</section>
			</section>
		<?php
				break;
			case 'pingback'  :
			case 'trackback' :
		?>
		<li class="post pingback">
			<p><?php _e( 'Pingback:', 'the-chameleon'); ?> <?php comment_author_link(); ?><?php edit_comment_link( __( '(Edit)','the-chameleon' ), ' ' ); ?></p>
		</li>
		<?php
				break;
		endswitch;
	}