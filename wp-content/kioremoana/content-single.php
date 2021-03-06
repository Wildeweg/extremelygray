<?php
/**
 * The template for displaying content in the single.php template
 *
 * @package Kiore Moana
 * @since Kiore Moana 1.0
 */
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

	<?php if ( has_post_thumbnail() && ! post_password_required() ) : ?>
		<div class="entry-thumbnail">
			<?php the_post_thumbnail(); ?>
		</div>
	<?php endif; ?>
	
	<header class="entry-header">
		<div class="pf-icon"><?php _e( 'Post Format', 'kioremoana' ); ?></div>
		<div class="entry-details">
			<div class="entry-date"><a href="<?php the_permalink(); ?>" class="entry-date"><?php echo get_the_date(); ?></a></div>
			<?php // // Include Share Buttons on single posts
			$options = get_option('kioremoana_theme_options');
			if($options['share-singleposts'] or $options['share-posts']) : ?>
			<?php get_template_part( 'share'); ?>
		<?php endif; ?>
		</div><!--end .entry-details -->
		<h1 class="entry-title"><?php the_title(); ?></h1>		
	</header><!--end .entry-header -->

	<div class="entry-content clearfix">
		<?php the_content(); ?>	
		<?php wp_link_pages( array( 'before' => '<div class="page-link">' . __( 'Pages:', 'kioremoana' ), 'after' => '</div>' ) ); ?>
	</div><!-- end .entry-content -->

	<?php if ( get_the_author_meta( 'description' ) && ! get_post_format() ) : // If a user filled out their author bio, show it on standard posts ?>
		<div class="author-wrap">
			<div class="author-info">
				<?php echo get_avatar( get_the_author_meta( 'user_email' ), apply_filters( 'kioremoana_author_bio_avatar_size', 115 ) ); ?>
				<h3><?php printf( __( 'Posted by %s', 'kioremoana' ), "<a href='" . get_author_posts_url( get_the_author_meta( 'ID' ) ) . "' title='" . esc_attr( get_the_author() ) . "' rel='author'>" . get_the_author() . "</a>" ); ?></h3>
				<p class="author-description"><?php the_author_meta( 'description' ); ?></p>	
			</div><!-- end .author-info -->
		</div><!-- end .author-wrap -->
	<?php endif; ?>

	<footer class="entry-meta clearfix">
	</footer><!-- end .entry-meta -->

</article><!-- end .post-<?php the_ID(); ?> -->
