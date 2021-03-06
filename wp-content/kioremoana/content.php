<?php
/**
 * The default template for displaying content
 *
 * @package Kiore Moana
 * @since Kiore Moana 1.0
 */
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

	<?php if ( has_post_thumbnail() && ! post_password_required() ) : ?>
		<div class="entry-thumbnail">
		<a href="<?php the_permalink(); ?>" title="<?php printf( esc_attr__( 'Permalink to %s', 'kioremoana' ), the_title_attribute( 'echo=0' ) ); ?>"><?php the_post_thumbnail(); ?></a>
		</div>
	<?php endif; ?>

	<header class="entry-header">
		<div class="pf-icon"><?php _e( 'Post', 'kioremoana' ); ?></div>
		<div class="entry-details">
			<div class="entry-date"><a href="<?php the_permalink(); ?>" class="entry-date"><?php echo get_the_date(); ?></a></div>
			<?php // Include Share Btns
				$options = get_option('kioremoana_theme_options');
				if( $options['share-posts'] ) : ?>
				<?php get_template_part( 'share'); ?>
			<?php endif; ?>
		</div><!--end .entry-details -->
		<h2 class="entry-title"><a href="<?php the_permalink(); ?>" title="<?php printf( esc_attr__( 'Permalink to %s', 'kioremoana' ), the_title_attribute( 'echo=0' ) ); ?>" rel="bookmark"><?php the_title(); ?></a></h2>
	</header><!--end .entry-header -->

	<?php if ( is_search() && ! get_post_format() ) : // Only display excerpts for archives and search. ?>		
		<div class="entry-content">
			<?php the_excerpt(); ?>
		</div><!-- end .entry-content -->

	<?php else : ?>
			
	<div class="entry-content clearfix">
		<?php // Show Excerpt via Theme Options
			$options = get_option('kioremoana_theme_options');
			if( $options['show-excerpt'] && ! get_post_format() ) : ?>
				<?php the_excerpt(); ?>
		<?php else : ?>
				<?php the_content(); ?>
		<?php endif; ?>

		<?php wp_link_pages( array( 'before' => '<div class="page-link">' . __( 'Pages:', 'kioremoana' ), 'after' => '</div>' ) ); ?>
	</div><!-- end .entry-content -->

	<?php endif; ?>

</article><!-- end post -<?php the_ID(); ?> -->