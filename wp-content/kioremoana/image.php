<?php
/**
 * The template for displaying image attachments.
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
				<div class="pf-icon"><?php _e( 'Post Format', 'kioremoana' ); ?></div>
				<h1 class="entry-title"><?php the_title(); ?></h1>
					<div class="entry-details">
						<div class="entry-date"><a href="<?php the_permalink(); ?>" class="entry-date"><?php echo get_the_date(); ?></a></div>
						<?php if ( comments_open() ) : ?>
						<div class="entry-comments">
							<?php comments_popup_link( '<span class="leave-reply">' . __( '0 comments', 'kioremoana' ) . '</span>', __( '1 comment', 'kioremoana' ), __( '% comments', 'kioremoana' ) ); ?>
						</div><!-- .comments-link -->
						<?php endif; // comments_open() ?>
						<?php edit_post_link( __( 'Edit', 'kioremoana' ), '<div class="entry-edit">', '</div>' ); ?>
						<?php // Include Share Btns
							$options = get_option('kioremoana_theme_options');
							if( $options['share-posts'] ) : ?>
							<?php get_template_part( 'share'); ?>
						<?php endif; ?>
					</div><!--end .entry-details -->
			</header><!--end .entry-header -->

			<div class="entry-content clearfix">

				<div class="attachment">
<?php
	/**
	 * Grab the IDs of all the image attachments in a gallery so we can get the URL of the next adjacent image in a gallery,
	 * or the first image (if we're looking at the last image in a gallery), or, in a gallery of one, just the link to that image file
	 */
	$attachments = array_values( get_children( array( 'post_parent' => $post->post_parent, 'post_status' => 'inherit', 'post_type' => 'attachment', 'post_mime_type' => 'image', 'order' => 'ASC', 'orderby' => 'menu_order ID' ) ) );
	foreach ( $attachments as $k => $attachment ) {
		if ( $attachment->ID == $post->ID )
			break;
	}
	$k++;
	// If there is more than 1 attachment in a gallery
	if ( count( $attachments ) > 1 ) {
		if ( isset( $attachments[ $k ] ) )
			// get the URL of the next image attachment
			$next_attachment_url = get_attachment_link( $attachments[ $k ]->ID );
		else
			// or get the URL of the first image attachment
			$next_attachment_url = get_attachment_link( $attachments[ 0 ]->ID );
	} else {
		// or, if there's only 1 image, get the URL of the image
		$next_attachment_url = wp_get_attachment_url();
	}
?>
						<a href="<?php echo $next_attachment_url; ?>" title="<?php echo esc_attr( get_the_title() ); ?>"><?php
							$attachment_size = apply_filters( 'theme_attachment_size', 1180 );
							echo wp_get_attachment_image( $post->ID, array( $attachment_size, 1180 ) ); // filterable image width with 1200px limit for image height.
						?></a>

						<?php if ( ! empty( $post->post_excerpt ) ) : ?>
							<div class="entry-caption">
								<?php the_excerpt(); ?>
							</div>
						<?php endif; ?>
					</div><!-- .attachment -->
				</div><!-- .entry-content -->

		</article><!-- #post-<?php the_ID(); ?> -->

		<?php comments_template(); ?>

		<nav id="nav-image" class="clearfix">
			<div class="nav-previous"><?php previous_image_link( '%link', __( '<span>&larr; Previous</span>', 'kioremoana' )); ?></div>
			<div class="nav-next"><?php next_image_link(  '%link', __( '<span>Next &rarr;</span>', 'kioremoana' ) ); ?></div>
		</nav><!-- #image-nav -->

		</div><!-- end #primary -->
	</div><!-- end #main -->

<?php get_footer(); ?>