<?php
/**
 * The template for displaying search results.
 *
 * @package Kiore Moana
 * @since Kiore Moana 1.0
 */

get_header(); ?>
	
	<?php get_template_part( 'masthead' ); ?>

	<div id="main" class="site-main">
		<div id="primary" class="site-content" role="main">

		<?php if ( have_posts() ) : ?>
		<header class="archive-header">
			<h2 class="archive-title"><?php echo $wp_query->found_posts; ?> <?php printf( __( 'Search Results for &lsquo;%s&rsquo;', 'kioremoana' ), '<span>' . get_search_query() . '</span>' ); ?></h2>
		</header><!--end .page-header -->

			<?php /* Start the Loop */ ?>
			<?php while ( have_posts() ) : the_post(); ?>

				<?php	get_template_part( 'content', get_post_format() ); ?>

			<?php endwhile; // end of the loop. ?>

			<?php /* Display navigation to next/previous pages when applicable, also check if WP pagenavi plugin is activated */ ?>
			<?php if(function_exists('wp_pagenavi')) : wp_pagenavi(); else: ?>
				<?php kioremoana_content_nav( 'nav-below' ); ?>	
			<?php endif; ?>

			<?php else : ?>

			<article id="post-0" class="page no-results not-found">		
				<header class="entry-header">
					<h1 class="entry-title"><?php _e( 'Nothing Found', 'kioremoana' ); ?></h1>
				</header><!--end .entry-header -->
				<div class="entry-content">
					<p><?php _e( 'Sorry, but nothing matched your search criteria. Please try again!', 'kioremoana' ); ?></p>
					<?php get_search_form(); ?>
				</div><!-- end .entry-content -->
			</article>

		<?php endif; ?>

		</div><!-- end #primary -->
	</div><!-- end #main -->

<?php get_footer(); ?>