<?php
/**
 * The template for displaying archive pages
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Bootstrap_Class
 */

 get_header(); ?>

 		<?php if ( have_posts() ) : ?>

 			<section class="feature-image feature-image-default-alt" data-type="background" data-speed="2">
 				<h1 class="page-title">
 					<?php
 						if ( is_category() ) :
 							single_cat_title();

 						elseif ( is_tag() ) :
 							single_tag_title();

 						elseif ( is_author() ) :
 							printf( __( 'Author: %s', 'b2w_theme' ), '<span class="vcard">' . get_the_author() . '</span>' );

 						elseif ( is_day() ) :
 							printf( __( 'Day: %s', 'b2w_theme' ), '<span>' . get_the_date() . '</span>' );

 						elseif ( is_month() ) :
 							printf( __( 'Month: %s', 'b2w_theme' ), '<span>' . get_the_date( _x( 'F Y', 'monthly archives date format', 'b2w_theme' ) ) . '</span>' );

 						elseif ( is_year() ) :
 							printf( __( 'Year: %s', 'b2w_theme' ), '<span>' . get_the_date( _x( 'Y', 'yearly archives date format', 'b2w_theme' ) ) . '</span>' );

 						elseif ( is_tax( 'post_format', 'post-format-aside' ) ) :
 							_e( 'Asides', 'b2w_theme' );

 						elseif ( is_tax( 'post_format', 'post-format-gallery' ) ) :
 							_e( 'Galleries', 'b2w_theme' );

 						elseif ( is_tax( 'post_format', 'post-format-image' ) ) :
 							_e( 'Images', 'b2w_theme' );

 						elseif ( is_tax( 'post_format', 'post-format-video' ) ) :
 							_e( 'Videos', 'b2w_theme' );

 						elseif ( is_tax( 'post_format', 'post-format-quote' ) ) :
 							_e( 'Quotes', 'b2w_theme' );

 						elseif ( is_tax( 'post_format', 'post-format-link' ) ) :
 							_e( 'Links', 'b2w_theme' );

 						elseif ( is_tax( 'post_format', 'post-format-status' ) ) :
 							_e( 'Statuses', 'b2w_theme' );

 						elseif ( is_tax( 'post_format', 'post-format-audio' ) ) :
 							_e( 'Audios', 'b2w_theme' );

 						elseif ( is_tax( 'post_format', 'post-format-chat' ) ) :
 							_e( 'Chats', 'b2w_theme' );

 						else :
 							_e( 'Archives', 'b2w_theme' );

 						endif;
 					?>

 					<?php
 					// Show an optional term description.
 					$term_description = term_description();
 					if ( ! empty( $term_description ) ) :
 						printf( '<small class="taxonomy-description">%s</small>', $term_description );
 					endif;
 				?>
 				</h1>
 			</section>

 			<div class="container">
 				<div id="primary" class="row">
 					<main id="content" class="col-sm-8">
 					<?php /* Start the Loop */ ?>
 					<?php while ( have_posts() ) : the_post(); ?>

 						<?php
 							/* Include the Post-Format-specific template for the content.
 							 * If you want to override this in a child theme, then include a file
 							 * called content-___.php (where ___ is the Post Format name) and that will be used instead.
 							 */
 							get_template_part( 'content', get_post_format() );
 						?>

 					<?php endwhile; ?>

 					<?php b2w_theme_paging_nav(); ?>

 				<?php else : ?>

 					<?php get_template_part( 'content', 'none' ); ?>

 				<?php endif; ?>

 				</main><!-- #content -->

 				<!-- SIDEBAR
 				================================================== -->
 				<aside class="col-sm-4">
 				<?php get_sidebar(); ?>
 				</aside>

 			</div><!-- #primary -->
 		</div><!-- .container -->

 <?php get_footer(); ?>
