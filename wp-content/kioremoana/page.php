<?php
/**
 * The template for displaying standard pages with sidebar.
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

			<?php get_template_part( 'content', 'page' ); ?>

			<?php comments_template( '', true ); ?>

		<?php endwhile; // end of the loop. ?>

		</div><!-- end #primary -->
	</div><!-- end #main -->

<?php get_footer(); ?>