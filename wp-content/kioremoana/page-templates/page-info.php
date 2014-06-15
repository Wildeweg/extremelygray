<?php
/**
 * Template Name: Info Page Template
 * Description: An Info page template
 *
 * @package Kiore_Moana 
 * @since Kiore Moana 1.0
 */

get_header(); ?>

	<header id="infohead" class="clearfix">
		<a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="home-btn" title="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>"><span class="back-home"><?php _e('Back Home', 'kioremoana') ?></span><span class="show-home"><?php _e('Home Button', 'kioremoana') ?></span></a>

	</header><!-- end #infohead -->

	<div id="main" class="site-main">
		<div id="primary" class="site-content" role="main">

		<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

			<div class="entry-content clearfix">
				
			<?php if ( is_active_sidebar( 'sidebar-1' ) ) : ?>
				<div id="widget-container" class="widget-area">
					<?php dynamic_sidebar( 'sidebar-1' ); ?>
				</div><!-- #widget-container .widget-area -->
			<?php endif; ?>

			</div><!-- end .entry-content -->

		</article><!-- end post-<?php the_ID(); ?> -->

		</div><!-- end #primary -->
	</div><!-- end #main -->

<?php get_footer(); ?>
