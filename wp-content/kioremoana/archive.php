<?php
/**
 * The template for displaying Archive pages.
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
				<h2 class="archive-title">
					<?php
							if ( is_category() ) {
								printf( __( 'All Posts Filed in &lsquo;%s&rsquo;', 'kioremoana' ), '<span>' . single_cat_title( '', false ) . '</span>' );

							} elseif ( is_tag() ) {
								printf( __( 'All Posts Tagged &lsquo;%s&rsquo;', 'kioremoana' ), '<span>' . single_tag_title( '', false ) . '</span>' );

							} elseif ( is_author() ) {
								the_post();
								printf( __( 'All Posts by &lsquo;%s&rsquo;', 'kioremoana' ), '<span>' . get_the_author() . '</span>' );
								rewind_posts();

							} elseif ( is_day() ) {
								printf( __( 'Daily Archives of: %s', 'kioremoana' ), '<span>' . get_the_date() . '</span>' );

							} elseif ( is_month() ) {
								printf( __( 'Monthly Archives of: %s', 'kioremoana' ), '<span>' . get_the_date( 'F Y' ) . '</span>' );

							} elseif ( is_year() ) {
								printf( __( 'Yearly Archives of: %s', 'kioremoana' ), '<span>' . get_the_date( 'Y' ) . '</span>' );

							} else {
								_e( 'Archives', 'kioremoana' );
							}
						?>
				</h2>
				<?php
						if ( is_category() ) {
							// show an optional category description
							$category_description = category_description();
							if ( ! empty( $category_description ) )
								echo apply_filters( 'category_archive_meta', '<div class="taxonomy-description">' . $category_description . '</div>' );

						} elseif ( is_tag() ) {
							// show an optional tag description
							$tag_description = tag_description();
							if ( ! empty( $tag_description ) )
								echo apply_filters( 'tag_archive_meta', '<div class="taxonomy-description">' . $tag_description . '</div>' );
						}
					?>
			</header><!-- end .archive-header -->

			<?php rewind_posts(); ?>

			<?php /* Start the Loop */ ?>
			<?php while ( have_posts() ) : the_post(); ?>

				<?php get_template_part( 'content', get_post_format() ); ?>

			<?php endwhile; // end of the loop. ?>

			<?php /* Display navigation to next/previous pages when applicable, also check if WP pagenavi plugin is activated */ ?>
			<?php if(function_exists('wp_pagenavi')) : wp_pagenavi(); else: ?>
				<?php kioremoana_content_nav( 'nav-below' ); ?>	
			<?php endif; ?>
			
			<?php else : ?>

				<article id="post-0" class="post no-results not-found">
					<header class="entry-header">
						<h1 class="entry-title"><?php _e( 'Nothing Found', 'kioremoana' ); ?></h1>
					</header><!-- .entry-header -->

					<div class="entry-content">
						<p><?php _e( 'It seems we can&rsquo;t find what you&rsquo;re looking for.', 'kioremoana' ); ?></p>
					</div><!-- .entry-content -->
				</article><!-- #post-0 -->

			<?php endif; ?>

		</div><!-- end #primary -->
	</div><!-- end #main -->

<?php get_footer(); ?>