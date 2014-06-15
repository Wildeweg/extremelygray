<?php
/**
 * Kiore Moana functions and definitions
 *
 * @package Kiore Moana
 * @since Kiore Moana 1.0
 */
 
/*-----------------------------------------------------------------------------------*/
/* Sets up the content width value based on the theme's design.
/*-----------------------------------------------------------------------------------*/

if ( ! isset( $content_width ) )
	$content_width = 1160;

/*-----------------------------------------------------------------------------------*/
/* Sets up theme defaults and registers support for various WordPress features.
/*-----------------------------------------------------------------------------------*/

function kioremoana_setup() {

	// Make Kiore Moana available for translation. Translations can be added to the /languages/ directory.
	load_theme_textdomain( 'kioremoana', get_template_directory() . '/languages' );

	// This theme styles the visual editor with editor-style.css to match the theme style.
	add_editor_style();

	// Add default posts and comments RSS feed links to head
	add_theme_support( 'automatic-feed-links' );

	// Load up the Kiore Moana theme options page and related code.
	require( get_template_directory() . '/inc/theme-options.php' );
	
	// Grab the Kiore Moana Custom widgets.
	require( get_template_directory() . '/inc/widgets.php' );

	// This theme supports all available post formats by default.
	add_theme_support( 'post-formats', array (
		'aside', 'audio', 'gallery', 'image', 'link', 'quote', 'status', 'video', 'chat'
	) );

	// This theme uses wp_nav_menu().
	register_nav_menus( array (
		'optional' => __( 'Footer Navigation (no sub menus supported)', 'kioremoana' )
	) );

	// This theme uses post thumbnails
	add_theme_support( 'post-thumbnails' );
	
	// Add support for Jetpack Infinite Scroll
	add_theme_support( 'infinite-scroll', array (
	'container'  => 'primary',
	'footer'  => 'main',
	) );

}
add_action( 'after_setup_theme', 'kioremoana_setup' );
 
/*-----------------------------------------------------------------------------------*/
/*  Returns the Google font stylesheet URL if available.
/*-----------------------------------------------------------------------------------*/

function kioremoana_fonts_url() {
	$fonts_url = '';

	/* Translators: If there are characters in your language that are not
	 * supported by PT Sans or Raleway translate this to 'off'. Do not translate
	 * into your own language.
	 */
	$pt_sans = _x( 'on', 'PT Sans font: on or off', 'kioremoana' );

	$raleway = _x( 'on', 'Raleway font: on or off', 'kioremoana' );

	if ( 'off' !== $pt_sans || 'off' !== $raleway ) {
		$font_families = array();

		if ( 'off' !== $pt_sans )
			$font_families[] = 'PT Sans:400,700';

		if ( 'off' !== $raleway )
			$font_families[] = 'Raleway:400,800,900';

		$query_args = array(
			'family' => urlencode( implode( '|', $font_families ) ),
			'subset' => urlencode( 'latin,latin-ext' ),
		);
		$fonts_url = add_query_arg( $query_args, "//fonts.googleapis.com/css" );
	}

	return $fonts_url;
}


/*-----------------------------------------------------------------------------------*/
/*  Enqueue scripts and styles
/*-----------------------------------------------------------------------------------*/

function kioremoana_scripts() {
	global $wp_styles;

	// Adds JavaScript to pages with the comment form to support sites with threaded comments (when in use)
	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) )
	wp_enqueue_script( 'comment-reply' );

	// Loads JavaScript for scalable videos
	wp_enqueue_script( 'fitvids', get_template_directory_uri() . '/js/jquery.fitvids.js', array( 'jquery' ), '1.0' );

	// Loads Custom Kiore Moana JavaScript functionality
	wp_enqueue_script( 'kioremoana-script', get_template_directory_uri() . '/js/functions.js', array( 'jquery' ), '2013-08-04' );

	// Add Google Webfonts
	wp_enqueue_style( 'kioremoana-fonts', kioremoana_fonts_url(), array(), null );

	// Loads main stylesheet.
	wp_enqueue_style( 'kioremoana-style', get_stylesheet_uri(), array(), '2013-10-02' );

}
add_action( 'wp_enqueue_scripts', 'kioremoana_scripts' );


/*-----------------------------------------------------------------------------------*/
/* Creates a nicely formatted and more specific title element text
/* for output in head of document, based on current view.
/*-----------------------------------------------------------------------------------*/

function kioremoana_wp_title( $title, $sep ) {
	global $paged, $page;

	if ( is_feed() )
		return $title;

	// Add the site name.
	$title .= get_bloginfo( 'name' );

	// Add the site description for the home/front page.
	$site_description = get_bloginfo( 'description', 'display' );
	if ( $site_description && ( is_home() || is_front_page() ) )
		$title = "$title $sep $site_description";

	// Add a page number if necessary.
	if ( $paged >= 2 || $page >= 2 )
		$title = "$title $sep " . sprintf( __( 'Page %s', 'kioremoana' ), max( $paged, $page ) );

	return $title;
}
add_filter( 'wp_title', 'kioremoana_wp_title', 10, 2 );

/*-----------------------------------------------------------------------------------*/
/* Get our wp_nav_menu() fallback, wp_page_menu(), to show a home link.
/*-----------------------------------------------------------------------------------*/

function kioremoana_page_menu_args( $args ) {
	$args['show_home'] = true;
	return $args;
}
add_filter( 'wp_page_menu_args', 'kioremoana_page_menu_args' );


/*-----------------------------------------------------------------------------------*/
/* Get our wp_nav_menu() fallback, wp_page_menu(), to show a home link.
/*-----------------------------------------------------------------------------------*/
add_filter( 'wp_nav_menu_objects', 'add_menu_parent_class' );
function add_menu_parent_class( $items ) {
	
	$parents = array();
	foreach ( $items as $item ) {
		if ( $item->menu_item_parent && $item->menu_item_parent > 0 ) {
			$parents[] = $item->menu_item_parent;
		}
	}
	
	foreach ( $items as $item ) {
		if ( in_array( $item->ID, $parents ) ) {
			$item->classes[] = 'menu-parent-item'; 
		}
	}
	
	return $items;    
}

/*-----------------------------------------------------------------------------------*/
/* Sets the post excerpt length to 55 characters.
/*-----------------------------------------------------------------------------------*/

function kioremoana_excerpt_length( $length ) {
	return 55;
}
add_filter( 'excerpt_length', 'kioremoana_excerpt_length' );

/*-----------------------------------------------------------------------------------*/
/* Returns a "Continue Reading" link for excerpts
/*-----------------------------------------------------------------------------------*/

function kioremoana_more_link($more_link, $more_link_text) {
	return ' <div class="more-link-wrap"><a href="'. get_permalink() . '" class="more-link"><span>' . __( 'Read more', 'kioremoana' ) . '</span></a></div>';
}
add_filter('the_content_more_link', 'kioremoana_more_link', 10, 2);


function kioremoana_continue_reading_link() {
	return ' <div class="more-link-wrap"><a href="'. get_permalink() . '" class="more-link"><span>' . __( 'Read more', 'kioremoana' ) . '</span></a></div>';
}

/*-----------------------------------------------------------------------------------*/
/* Replaces "[...]" (appended to automatically generated excerpts) with an ellipsis and kioremoana_continue_reading_link().
/*
/* To override this in a child theme, remove the filter and add your own
/* function tied to the excerpt_more filter hook.
/*-----------------------------------------------------------------------------------*/

function kioremoana_auto_excerpt_more( $more ) {
	return ' &hellip;' . kioremoana_continue_reading_link();
}
add_filter( 'excerpt_more', 'kioremoana_auto_excerpt_more' );

/*-----------------------------------------------------------------------------------*/
/* Adds a pretty "Continue Reading" link to custom post excerpts.
/*
/* To override this link in a child theme, remove the filter and add your own
/* function tied to the get_the_excerpt filter hook.
/*-----------------------------------------------------------------------------------*/

function kioremoana_custom_excerpt_more( $output ) {
	if ( has_excerpt() && ! is_attachment() ) {
		$output .= kioremoana_continue_reading_link();
	}
	return $output;
}
add_filter( 'get_the_excerpt', 'kioremoana_custom_excerpt_more' );

/*-----------------------------------------------------------------------------------*/
/* Remove inline styles printed when the gallery shortcode is used.
/*-----------------------------------------------------------------------------------*/

function kioremoana_remove_gallery_css( $css ) {
	return preg_replace( "#<style type='text/css'>(.*?)</style>#s", '', $css );
}
add_filter( 'gallery_style', 'kioremoana_remove_gallery_css' );


if ( ! function_exists( 'kioremoana_comment' ) ) :
/*-----------------------------------------------------------------------------------*/
/* Comments template kioremoana_comment
/*-----------------------------------------------------------------------------------*/
function kioremoana_comment( $comment, $args, $depth ) {
	$GLOBALS['comment'] = $comment;
	switch ( $comment->comment_type ) :
		case '' :
	?>

	<li <?php comment_class(); ?> id="li-comment-<?php comment_ID(); ?>">
		<article id="comment-<?php comment_ID(); ?>" class="comment">

			<div class="comment-avatar">
				<?php echo get_avatar( $comment, 115 ); ?>
			</div>

<div class="comment-content">
				<ul class="comment-meta">
					<?php
						if (function_exists('gtcn_comment_numbering')) echo gtcn_comment_numbering($comment->comment_ID, $args);
					?>
					<li class="comment-author"><?php printf( __( ' %s ', 'kioremoana' ), sprintf( ' %s ', get_comment_author_link() ) ); ?></li>
					<li class="comment-time"><a href="<?php echo esc_url( get_comment_link( $comment->comment_ID ) ); ?>">
					<?php
						/* translators: 1: date */
						printf( __( '%1$s', 'kioremoana' ),
						get_comment_date('d. F Y'));
					?></a></li>
					<li class="comment-edit"><?php edit_comment_link( __( 'Edit', 'kioremoana' ));?></li>
				</ul>
				<div class="comment-text">
					<?php comment_text(); ?>
					<?php if ( $comment->comment_approved == '0' ) : ?>
						<p class="comment-awaiting-moderation"><?php _e( 'Your comment is awaiting moderation.', 'kioremoana' ); ?></p>
					<?php endif; ?>
					<p class="comment-reply"><?php comment_reply_link( array_merge( $args, array( 'reply_text' => __( 'Reply', 'kioremoana' ), 'depth' => $depth, 'max_depth' => $args['max_depth'] ) ) ); ?></p>
				</div><!-- end .comment-text -->
					
			</div><!-- end .comment-content -->
		
		</article><!-- end .comment -->

	<?php
			break;
		case 'pingback'  :
		case 'trackback' :
	?>
	<li class="pingback">
		<p><?php _e( '<span>Pingback:</span>', 'kioremoana' ); ?> <?php comment_author_link(); ?></p>
		<p class="pingback-edit"><?php edit_comment_link( __('Edit', 'kioremoana'), ' ' ); ?></p>
	<?php
			break;
	endswitch;
}
endif;


/*-----------------------------------------------------------------------------------*/
/* Register widgetized areas
/*-----------------------------------------------------------------------------------*/

function kioremoana_widgets_init() {

	register_sidebar( array (
		'name' => __( 'Main Widget Area', 'kioremoana' ),
		'id' => 'sidebar-1',
		'description' => __( 'Widgets will appear in the Kiore Moana Info Page Template.', 'kioremoana' ),
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget' => "</aside>",
		'before_title' => '<h3 class="widget-title"><span>',
		'after_title' => '</span></h3>',
	) );

	register_sidebar( array (
		'name' => __( 'Header Slogan Widget Area', 'kioremoana' ),
		'id' => 'sidebar-2',
		'description' => __( 'Widget area for the header slogan.', 'kioremoana' ),
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget' => "</aside>",
	) );

}
add_action( 'init', 'kioremoana_widgets_init' );


if ( ! function_exists( 'kioremoana_content_nav' ) ) :

/*-----------------------------------------------------------------------------------*/
/* Display navigation to next/previous pages when applicable
/*-----------------------------------------------------------------------------------*/

function kioremoana_content_nav( $nav_id ) {
	global $wp_query;

	if ( $wp_query->max_num_pages > 1 ) : ?>
		<nav id="<?php echo $nav_id; ?>" class="clearfix">
				<div class="nav-previous"><?php next_posts_link( __( '<span>&larr; Older</span>', 'kioremoana'  ) ); ?></div>
				<div class="nav-next"><?php previous_posts_link( __( '<span>Newer &rarr;</span>', 'kioremoana' ) ); ?></div>
			</nav><!-- end #nav-below -->
	<?php endif;
}

endif; // kioremoana_content_nav

/*-----------------------------------------------------------------------------------*/
/* Removes the default CSS style from the WP image gallery
/*-----------------------------------------------------------------------------------*/
add_filter('gallery_style', create_function('$a', 'return "
<div class=\'gallery\'>";'));

/*-----------------------------------------------------------------------------------*/
/* Extends the default WordPress body classes
/*-----------------------------------------------------------------------------------*/
function kioremoana_body_class( $classes ) {

	if ( is_page_template( 'page-templates/page-archive.php' ) ) 
		$classes[] = 'template-archive';

	if ( is_page_template( 'page-templates/page-info.php' ) ) 
		$classes[] = 'template-info'; 

	return $classes;
}
add_filter( 'body_class', 'kioremoana_body_class' );

/*-----------------------------------------------------------------------------------*/
/* Kiore Moana Shortcodes
/*-----------------------------------------------------------------------------------*/
// Enable shortcodes in widget areas
add_filter( 'widget_text', 'do_shortcode' );

// Replace WP autop formatting
if (!function_exists( "kioremoana_remove_wpautop")) {
	function kioremoana_remove_wpautop($content) { 
		$content = do_shortcode( shortcode_unautop( $content ) ); 
		$content = preg_replace( '#^<\/p>|^<br \/>|<p>$#', '', $content);
		return $content;
	}
}

/*-----------------------------------------------------------------------------------*/
/* Multi Columns Shortcodes
/* Don't forget to add "_last" behind the shortcode if it is the last column.
/*-----------------------------------------------------------------------------------*/

// Two Columns
function kioremoana_shortcode_two_columns_one( $atts, $content = null ) {
   return '<div class="two-columns-one">' . kioremoana_remove_wpautop($content) . '</div>';
}
add_shortcode( 'two_columns_one', 'kioremoana_shortcode_two_columns_one' );

function kioremoana_shortcode_two_columns_one_last( $atts, $content = null ) {
   return '<div class="two-columns-one last">' . kioremoana_remove_wpautop($content) . '</div>';
}
add_shortcode( 'two_columns_one_last', 'kioremoana_shortcode_two_columns_one_last' );

// Three Columns
function kioremoana_shortcode_three_columns_one($atts, $content = null) {
   return '<div class="three-columns-one">' . kioremoana_remove_wpautop($content) . '</div>';
}
add_shortcode( 'three_columns_one', 'kioremoana_shortcode_three_columns_one' );

function kioremoana_shortcode_three_columns_one_last($atts, $content = null) {
   return '<div class="three-columns-one last">' . kioremoana_remove_wpautop($content) . '</div>';
}
add_shortcode( 'three_columns_one_last', 'kioremoana_shortcode_three_columns_one_last' );

function kioremoana_shortcode_three_columns_two($atts, $content = null) {
   return '<div class="three-columns-two">' . kioremoana_remove_wpautop($content) . '</div>';
}
add_shortcode( 'three_columns_two', 'kioremoana_shortcode_three_columns_two' );

function kioremoana_shortcode_three_columns_two_last($atts, $content = null) {
   return '<div class="three-columns-two last">' . kioremoana_remove_wpautop($content) . '</div>';
}
add_shortcode( 'three_columns_two_last', 'kioremoana_shortcode_three_columns_two_last' );

// Four Columns
function kioremoana_shortcode_four_columns_one($atts, $content = null) {
   return '<div class="four-columns-one">' . kioremoana_remove_wpautop($content) . '</div>';
}
add_shortcode( 'four_columns_one', 'kioremoana_shortcode_four_columns_one' );

function kioremoana_shortcode_four_columns_one_last($atts, $content = null) {
   return '<div class="four-columns-one last">' . kioremoana_remove_wpautop($content) . '</div>';
}
add_shortcode( 'four_columns_one_last', 'kioremoana_shortcode_four_columns_one_last' );

function kioremoana_shortcode_four_columns_two($atts, $content = null) {
   return '<div class="four-columns-two">' . kioremoana_remove_wpautop($content) . '</div>';
}
add_shortcode( 'four_columns_two', 'kioremoana_shortcode_four_columns_two' );

function kioremoana_shortcode_four_columns_two_last($atts, $content = null) {
   return '<div class="four-columns-two last">' . kioremoana_remove_wpautop($content) . '</div>';
}
add_shortcode( 'four_columns_two_last', 'kioremoana_shortcode_four_columns_two_last' );

function kioremoana_shortcode_four_columns_three($atts, $content = null) {
   return '<div class="four-columns-three">' . kioremoana_remove_wpautop($content) . '</div>';
}
add_shortcode( 'four_columns_three', 'kioremoana_shortcode_four_columns_three' );

function kioremoana_shortcode_four_columns_three_last($atts, $content = null) {
   return '<div class="four-columns-three last">' . kioremoana_remove_wpautop($content) . '</div>';
}
add_shortcode( 'four_columns_three_last', 'kioremoana_shortcode_four_columns_three_last' );


// Divide Text Shortcode
function kioremoana_shortcode_divider($atts, $content = null) {
   return '<div class="divider"></div>';
}
add_shortcode( 'divider', 'kioremoana_shortcode_divider' );

/*-----------------------------------------------------------------------------------*/
/* Text Highlight and Info Boxes Shortcodes
/*-----------------------------------------------------------------------------------*/

function kioremoana_shortcode_white_box($atts, $content = null) {
   return '<div class="white-box">' . do_shortcode( kioremoana_remove_wpautop($content) ) . '</div>';
}
add_shortcode( 'white_box', 'kioremoana_shortcode_white_box' );

function kioremoana_shortcode_yellow_box($atts, $content = null) {
   return '<div class="yellow-box">' . do_shortcode( kioremoana_remove_wpautop($content) ) . '</div>';
}
add_shortcode( 'yellow_box', 'kioremoana_shortcode_yellow_box' );

function kioremoana_shortcode_red_box($atts, $content = null) {
   return '<div class="red-box">' . do_shortcode( kioremoana_remove_wpautop($content) ) . '</div>';
}
add_shortcode( 'red_box', 'kioremoana_shortcode_red_box' );

function kioremoana_shortcode_blue_box($atts, $content = null) {
   return '<div class="blue-box">' . do_shortcode( kioremoana_remove_wpautop($content) ) . '</div>';
}
add_shortcode( 'blue_box', 'kioremoana_shortcode_blue_box' );

function kioremoana_shortcode_green_box($atts, $content = null) {
   return '<div class="green-box">' . do_shortcode( kioremoana_remove_wpautop($content) ) . '</div>';
}
add_shortcode( 'green_box', 'kioremoana_shortcode_green_box' );

function kioremoana_shortcode_lightgrey_box($atts, $content = null) {
   return '<div class="lightgrey-box">' . do_shortcode( kioremoana_remove_wpautop($content) ) . '</div>';
}
add_shortcode( 'lightgrey_box', 'kioremoana_shortcode_lightgrey_box' );

function kioremoana_shortcode_grey_box($atts, $content = null) {
   return '<div class="grey-box">' . do_shortcode( kioremoana_remove_wpautop($content) ) . '</div>';
}
add_shortcode( 'grey_box', 'kioremoana_shortcode_grey_box' );

function kioremoana_shortcode_dark_box($atts, $content = null) {
   return '<div class="dark-box">' . do_shortcode( kioremoana_remove_wpautop($content) ) . '</div>';
}
add_shortcode( 'dark_box', 'kioremoana_shortcode_dark_box' );

/*-----------------------------------------------------------------------------------*/
/* Buttons Shortcodes
/*-----------------------------------------------------------------------------------*/
function kioremoana_button( $atts, $content = null ) {
    extract(shortcode_atts(array(
    'link'	=> '#',
    'target' => '',
    'color'	=> '',
    'size'	=> '',
	 'form'	=> '',
	 'font'	=> '',
    ), $atts));

	$color = ($color) ? ' '.$color. '-btn' : '';
	$size = ($size) ? ' '.$size. '-btn' : '';
	$form = ($form) ? ' '.$form. '-btn' : '';
	$font = ($font) ? ' '.$font. '-btn' : '';
	$target = ($target == 'blank') ? ' target="_blank"' : '';

	$out = '<a' .$target. ' class="standard-btn' .$color.$size.$form.$font. '" href="' .$link. '"><span>' .do_shortcode($content). '</span></a>';

    return $out;
}
add_shortcode('button', 'kioremoana_button');

/*-----------------------------------------------------------------------------------*/
/* Special Font + Layout Shortcodes
/*-----------------------------------------------------------------------------------*/
function kioremoana_shortcode_fullwidth_content($atts, $content = null) {
   return '<div class="fullwidth-content">' . do_shortcode( kioremoana_remove_wpautop($content) ) . '</div>';
}
add_shortcode( 'fullwidth_content', 'kioremoana_shortcode_fullwidth_content' );

function kioremoana_shortcode_intro_text($atts, $content = null) {
   return '<p class="slogan">' . do_shortcode( kioremoana_remove_wpautop($content) ) . '</p>';
}
add_shortcode( 'intro_text', 'kioremoana_shortcode_intro_text' );


function kioremoana_shortcode_headline_border($atts, $content = null) {
   return '<h2 class="centered"><span>' . do_shortcode( kioremoana_remove_wpautop($content) ) . '</span></h2>';
}
add_shortcode( 'headline_border', 'kioremoana_shortcode_headline_border' );

function kioremoana_shortcode_contact_form($atts, $content = null) {
   return '<div class="contact-form">' . do_shortcode( kioremoana_remove_wpautop($content) ) . '</div>';
}
add_shortcode( 'contact_form', 'kioremoana_shortcode_contact_form' );

function kioremoana_shortcode_contact_info($atts, $content = null) {
   return '<div class="contact-info">' . do_shortcode( kioremoana_remove_wpautop($content) ) . '</div>';
}
add_shortcode( 'contact_info', 'kioremoana_shortcode_contact_info' );
