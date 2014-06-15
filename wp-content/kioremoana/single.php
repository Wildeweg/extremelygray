<?php
/**
 * The Template for displaying all single posts.
 *
 * @package Kiore Moana
 * @since Kiore Moana 1.0
 */

get_header(); ?>
	
	<?php get_template_part( 'masthead' ); ?>

	<div id="main" class="site-main">
		<div id="primary" class="site-content" role="main">

		<?php /* Start the Loop */ ?>
		<?php while ( have_posts() ) : the_post(); ?>

			<?php get_template_part( 'content', 'single' ); ?>

			<?php comments_template( '', true ); ?>

		<?php endwhile; // end of the loop. ?>
		
		<nav id="nav-single" class="clearfix">
			<div class="nav-previous"><?php next_post_link( '%link', __( '&larr; Previous Post', 'kioremoana' ) ); ?></div>
			<div class="nav-next"><?php previous_post_link( '%link', __( 'Next Post  &rarr;', 'kioremoana' ) ); ?></div>
		</nav><!-- #nav-below -->

		</div><!-- end #primary -->
	</div><!-- end #main -->

<?php get_footer(); ?>