<?php
/**
 * Template Name: Archive Page Template
 * Description: An archive page template
 *
 * @package Kiore Moana 
 * @since Kiore Moana 1.0
 */

get_header(); ?>
	
	<?php get_template_part( 'masthead' ); ?>

	<div id="main" class="site-main">
		<div id="primary" class="site-content" role="main">

		<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

			<header class="entry-header">
				<h1 class="entry-title"><?php the_title(); ?></h1>
			</header><!-- end .entry-header -->

			<div class="entry-content clearfix">
				<h3><?php _e('Filter by Tags', 'kioremoana') ?></h3>
				<div class="archive-tags clearfix">
					<?php wp_tag_cloud('orderby=count&number=30'); ?> 
				</div><!-- end .archive-tags -->

				<h3><?php _e('The Latest 30 Posts', 'kioremoana') ?></h3>
				<ul class="latest-posts-list">
					<?php wp_get_archives('type=postbypost&limit=30'); ?>  
				</ul><!-- end .latest-posts-list -->

				<h3><?php _e('The Monthly Archive', 'kioremoana') ?></h3>
				<ul class="monthly-archive-list">
					<?php wp_get_archives('type=monthly'); ?>  
				</ul><!-- end .monthly-archive-list -->
			</div><!-- end .entry-content -->

		</article><!-- end post-<?php the_ID(); ?> -->

		</div><!-- end #primary -->
	</div><!-- end #main -->

<?php get_footer(); ?>
