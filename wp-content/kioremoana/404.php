<?php
/**
 * The template for displaying 404 error pages.
 *
 * @package Kiore Moana
 * @since Kiore Moana 1.0
 */

get_header(); ?>
	
	<?php get_template_part( 'masthead' ); ?>

	<div id="main" class="site-main">
		<div id="primary" class="site-content" role="main">

			<article id="post-0" class="page error404 no-results not-found">
				<header class="entry-header">
					<h1 class="entry-title"><?php _e( 'Nothing Found', 'kioremoana' ); ?></h1>
				</header><!--end .entry-header -->

				<div class="entry-content clearfix">
					<p><?php _e( 'Apologies, but the page you requested could not be found. Perhaps searching will help!', 'kioremoana' ); ?></p>
					<?php get_search_form(); ?>
				</div><!-- end .entry-content -->
			</article><!-- end #post-0 -->

		</div><!-- end #primary -->
	</div><!-- end #main -->

<?php get_footer(); ?>