<?php
/**
 * The template for displaying comments
 *
 * This is the template that displays the area of the page that contains both the current comments
 * and the comment form.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Bootstrap_Class
 */

 /*
  * If the current post is protected by a password and
  * the visitor has not yet entered the password we will
  * return early without loading the comments.
  */
 if ( post_password_required() ) {
 	return;
 }
 ?>

 <div id="comments" class="comments-area">

 	<div class="comments-wrap">

 	<?php if ( have_comments() ) : ?>
 		<h3 class="comments-title">
 			<?php
 				printf( _nx( 'One comment on &ldquo;%2$s&rdquo;', '%1$s thoughts on &ldquo;%2$s&rdquo;', get_comments_number(), 'comments title', 'b2w_theme' ),
 					number_format_i18n( get_comments_number() ), '<span>' . get_the_title() . '</span>' );
 			?>
 		</h3>

 		<?php if ( get_comment_pages_count() > 1 && get_option( 'page_comments' ) ) : // are there comments to navigate through ?>
 		<nav id="comment-nav-above" class="comment-navigation" role="navigation">
 			<h1 class="screen-reader-text"><?php _e( 'Comment navigation', 'b2w_theme' ); ?></h1>
 			<div class="nav-previous"><?php previous_comments_link( __( '&larr; Older Comments', 'b2w_theme' ) ); ?></div>
 			<div class="nav-next"><?php next_comments_link( __( 'Newer Comments &rarr;', 'b2w_theme' ) ); ?></div>
 		</nav><!-- #comment-nav-above -->
 		<?php endif; // check for comment navigation ?>

 		<ol class="comment-list">
 			<?php
 				wp_list_comments( array(
 					'style'      => 'ol',
 					'short_ping' => true,
 				) );
 			?>
 		</ol><!-- .comment-list -->

 		<?php if ( get_comment_pages_count() > 1 && get_option( 'page_comments' ) ) : // are there comments to navigate through ?>
 		<nav id="comment-nav-below" class="comment-navigation" role="navigation">
 			<h1 class="screen-reader-text"><?php _e( 'Comment navigation', 'b2w_theme' ); ?></h1>
 			<div class="nav-previous"><?php previous_comments_link( __( '&larr; Older Comments', 'b2w_theme' ) ); ?></div>
 			<div class="nav-next"><?php next_comments_link( __( 'Newer Comments &rarr;', 'b2w_theme' ) ); ?></div>
 		</nav><!-- #comment-nav-below -->
 		<?php endif; // check for comment navigation ?>

 	<?php endif; // have_comments() ?>

 	<?php
 		// If comments are closed and there are comments, let's leave a little note, shall we?
 		if ( ! comments_open() && '0' != get_comments_number() && post_type_supports( get_post_type(), 'comments' ) ) :
 	?>
 		<p class="no-comments"><?php _e( 'Comments are closed.', 'b2w_theme' ); ?></p>
 	<?php endif; ?>

 	<?php comment_form(); ?>

 	</div><!-- .comments-wrap -->

 </div><!-- #comments -->
