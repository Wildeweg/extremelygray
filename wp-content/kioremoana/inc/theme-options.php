<?php
/**
 * Kiore Moana Theme Options
 *
 * @subpackage Kiore Moana
 * @since Kiore Moana 1.0
 */

/*-----------------------------------------------------------------------------------*/
/* Properly enqueue styles and scripts for our theme options page.
/*
/* This function is attached to the admin_enqueue_scripts action hook.
/*
/* @param string $hook_suffix The action passes the current page to the function.
/* We don't do anything if we're not on our theme options page.
/*-----------------------------------------------------------------------------------*/

function kioremoana_admin_enqueue_scripts( $hook_suffix ) {
	if ( $hook_suffix != 'appearance_page_theme_options' )
		return;

	wp_enqueue_style( 'kioremoana-theme-options', get_template_directory_uri() . '/inc/theme-options.css', false, '2013-07-28' );
	wp_enqueue_script( 'kioremoana-theme-options', get_template_directory_uri() . '/inc/theme-options.js', array( 'farbtastic' ), '2013-07-28' );
	wp_enqueue_style( 'farbtastic' );
}
add_action( 'admin_enqueue_scripts', 'kioremoana_admin_enqueue_scripts' );

/*-----------------------------------------------------------------------------------*/
/* Register the form setting for our kioremoana_options array.
/*
/* This function is attached to the admin_init action hook.
/*
/* This call to register_setting() registers a validation callback, kioremoana_theme_options_validate(),
/* which is used when the option is saved, to ensure that our option values are complete, properly
/* formatted, and safe.
/*
/* We also use this function to add our theme option if it doesn't already exist.
/*-----------------------------------------------------------------------------------*/

function kioremoana_theme_options_init() {

	// If we have no options in the database, let's add them now.
	if ( false === kioremoana_get_theme_options() )
		add_option( 'kioremoana_theme_options', kioremoana_get_default_theme_options() );

	register_setting(
		'kioremoana_options',       // Options group, see settings_fields() call in theme_options_render_page()
		'kioremoana_theme_options', // Database option, see kioremoana_get_theme_options()
		'kioremoana_theme_options_validate' // The sanitization callback, see kioremoana_theme_options_validate()
	);
}
add_action( 'admin_init', 'kioremoana_theme_options_init' );


/*-----------------------------------------------------------------------------------*/
/* Add our theme options page to the admin menu.
/* 
/* This function is attached to the admin_menu action hook.
/*-----------------------------------------------------------------------------------*/

function kioremoana_theme_options_add_page() {
	add_theme_page(
		__( 'Theme Options', 'kioremoana' ), // Name of page
		__( 'Theme Options', 'kioremoana' ), // Label in menu
		'edit_theme_options',                  // Capability required
		'theme_options',                       // Menu slug, used to uniquely identify the page
		'theme_options_render_page'            // Function that renders the options page
	);
}
add_action( 'admin_menu', 'kioremoana_theme_options_add_page' );


/*-----------------------------------------------------------------------------------*/
/* Returns the default options for Kiore Moana
/*-----------------------------------------------------------------------------------*/

function kioremoana_get_default_theme_options() {
	$default_theme_options = array(
		'info_page'   => '',
		'link_color'   => '#33a6b8',
		'linkhover_color'   => '#0089a7',
		'infobg_color'   => '#eb7a77',
		'infobghover_color'   => '#cb4042',
		'custom_logo' => '',
		'custom_footertext' => '',
		'hide-title' => '',
		'show-excerpt' => '',
		'share-posts' => '',
		'share-singleposts' => '',
		'custom-css' => '',
	);

	return apply_filters( 'kioremoana_default_theme_options', $default_theme_options );
}

/*-----------------------------------------------------------------------------------*/
/* Returns the options array for Kiore Moana
/*-----------------------------------------------------------------------------------*/

function kioremoana_get_theme_options() {
	return get_option( 'kioremoana_theme_options' );
}

/*-----------------------------------------------------------------------------------*/
/* Returns the options array for Kiore Moana
/*-----------------------------------------------------------------------------------*/

function theme_options_render_page() {
	?>
	<div class="wrap">
		<?php screen_icon(); ?>
		<h2><?php printf( __( '%s Theme Options', 'kioremoana' ), wp_get_theme() ); ?></h2>
		<?php settings_errors(); ?>

		<form method="post" action="options.php">
			<?php
				settings_fields( 'kioremoana_options' );
				$options = kioremoana_get_theme_options();
				$default_options = kioremoana_get_default_theme_options();
			?>
			
			<table class="form-table">
				<h3 style="margin-top:30px;"><?php _e( 'Info Page Settings', 'kioremoana' ); ?></h3>
				<tr valign="top"><th scope="row"><?php _e( 'Info Page URL', 'kioremoana' ); ?></th>
					<td>
						<fieldset><legend class="screen-reader-text"><span><?php _e( 'Info Page URL', 'kioremoana' ); ?></span></legend>
							<input class="regular-text" type="text" name="kioremoana_theme_options[info_page]" value="<?php echo esc_attr( $options['info_page'] ); ?>" />
						<br/><label class="description" for="kioremoana_theme_options[info_page]"><?php _e('First create a new page to be your info page (you can name the page as you like).<br/> Set the Page Attribute / Template / <strong>Info Page Template</strong> for this page, deactivate comments (see Discussion / Allow Comments) and publish the page.<br/> Now include the page URL of your new info page here.', 'kioremoana'); ?></label>
						</fieldset>
					</td>
				</tr>
			</table>

			<table class="form-table">
			<h3 style="margin-top:40px;"><?php _e( 'Custom Colors', 'kioremoana' ); ?></h3>

				<tr valign="top"><th scope="row"><?php _e( 'Link Color', 'kioremoana' ); ?></th>
					<td>
						<fieldset><legend class="screen-reader-text"><span><?php _e( 'Link Color', 'kioremoana' ); ?></span></legend>
							 <input type="text" name="kioremoana_theme_options[link_color]" value="<?php echo esc_attr( $options['link_color'] ); ?>" id="link-color" />
							<div style="z-index: 100; background:#eee; border:1px solid #ccc; position:absolute; display:none;" id="colorpicker1"></div>
							<br />
							<small class="description"><?php printf( __( 'Choose your link color, the default link color is: <strong>%s</strong>.', 'kioremoana' ), $default_options['link_color'] ); ?></small>
						</fieldset>
					</td>
				</tr>

				<tr valign="top"><th scope="row"><?php _e( 'Text Link Hover Color', 'kioremoana' ); ?></th>
					<td>
						<fieldset><legend class="screen-reader-text"><span><?php _e( 'Text Link Hover Color', 'kioremoana' ); ?></span></legend>
							 <input type="text" name="kioremoana_theme_options[linkhover_color]" value="<?php echo esc_attr( $options['linkhover_color'] ); ?>" id="linkhover-color" />
							<div style="z-index: 100; background:#eee; border:1px solid #ccc; position:absolute; display:none;" id="colorpicker3"></div>
							<br />
							<small class="description"><?php printf( __( 'Choose your text link hover color, the default link hover color is: <strong>%s</strong>.', 'kioremoana' ), $default_options['linkhover_color'] ); ?></small>
						</fieldset>
					</td>
				</tr>

				<tr valign="top"><th scope="row"><?php _e( 'Info Page Background Color', 'kioremoana' ); ?></th>
					<td>
						<fieldset><legend class="screen-reader-text"><span><?php _e( 'Info Page Background Color', 'kioremoana' ); ?></span></legend>
							 <input type="text" name="kioremoana_theme_options[infobg_color]" value="<?php echo esc_attr( $options['infobg_color'] ); ?>" id="infobg-color" />
							<div style="z-index: 100; background:#eee; border:1px solid #ccc; position:absolute; display:none;" id="colorpicker2"></div>
							<br />
							<small class="description"><?php printf( __( 'Choose your Info Page background color, the default color is: <strong>%s</strong>.', 'kioremoana' ), $default_options['infobg_color'] ); ?></small>
						</fieldset>
					</td>
				</tr>

				<tr valign="top"><th scope="row"><?php _e( 'Info Page Button Hover Color', 'kioremoana' ); ?></th>
					<td>
						<fieldset><legend class="screen-reader-text"><span><?php _e( 'Info Page Button Hover Color', 'kioremoana' ); ?></span></legend>
							 <input type="text" name="kioremoana_theme_options[infobghover_color]" value="<?php echo esc_attr( $options['infobghover_color'] ); ?>" id="infobghover-color" />
							<div style="z-index: 100; background:#eee; border:1px solid #ccc; position:absolute; display:none;" id="colorpicker4"></div>
							<br />
							<small class="description"><?php printf( __( 'Choose your Info Page button hover color, the default color is: <strong>%s</strong>.', 'kioremoana' ), $default_options['infobghover_color'] ); ?></small>
						</fieldset>
					</td>
				</tr>
				</table>

				<table class="form-table">
				<h3 style="margin-top:40px;"><?php _e( 'Custom Logo, Post Excerpts and Footer Text', 'kioremoana' ); ?></h3>
				
				<tr valign="top"><th scope="row"><?php _e( 'Logo Image', 'kioremoana' ); ?></th>
					<td>
						<fieldset><legend class="screen-reader-text"><span><?php _e( 'Logo Image', 'kioremoana' ); ?></span></legend>
							<input class="regular-text" type="text" name="kioremoana_theme_options[custom_logo]" value="<?php echo esc_attr( $options['custom_logo'] ); ?>" />
						<br/><label class="description" for="kioremoana_theme_options[custom_logo]"><?php _e('Upload your own logo image (flexible width and height, e.g. 115x115px) using the ', 'kioremoana'); ?><a href="<?php echo home_url(); ?>/wp-admin/media-new.php" target="_blank"><?php _e('WordPress Media Uploader', 'kioremoana'); ?></a><?php _e('. Then copy your logo image file URL and insert the URL here.', 'kioremoana'); ?></label>
						</fieldset>
					</td>
				</tr>
				
				<tr valign="top"><th scope="row"><?php _e( 'Hide Site Title', 'kioremoana' ); ?></th>
					<td>
						<fieldset><legend class="screen-reader-text"><span><?php _e( 'Hide Site Title', 'kioremoana' ); ?></span></legend>
							<input id="kioremoana_theme_options[hide-title]" name="kioremoana_theme_options[hide-title]" type="checkbox" value="1" <?php checked( '1', $options['hide-title'] ); ?> />
							<label class="description" for="kioremoana_theme_options[hide-title]"><?php _e( 'Check this box hide the site title and only include your custom logo image.', 'kioremoana' ); ?></label>
						</fieldset>
					</td>
				</tr>

				<tr valign="top"><th scope="row"><?php _e( 'Post Excerpts', 'kioremoana' ); ?></th>
					<td>
						<fieldset><legend class="screen-reader-text"><span><?php _e( 'Post Excerpts', 'kioremoana' ); ?></span></legend>
							<input id="kioremoana_theme_options[show-excerpt]" name="kioremoana_theme_options[show-excerpt]" type="checkbox" value="1" <?php checked( '1', $options['show-excerpt'] ); ?> />
							<label class="description" for="kioremoana_theme_options[show-excerpt]"><?php _e( 'Check this box to show automatic post excerpts for standard posts. With this option you will not need to add the more tag in posts.', 'kioremoana' ); ?></label>
						</fieldset>
					</td>
				</tr>

				<tr valign="top"><th scope="row"><?php _e( 'Footer Credit Text', 'kioremoana' ); ?></th>
					<td>
						<fieldset><legend class="screen-reader-text"><span><?php _e( 'Footer Credit Text', 'kioremoana' ); ?></span></legend>
							<textarea id="kioremoana_theme_options[custom_footertext]" class="small-text" cols="100" rows="2" name="kioremoana_theme_options[custom_footertext]"><?php echo esc_textarea( $options['custom_footertext'] ); ?></textarea>
						<br/><label class="description" for="kioremoana_theme_options[custom_footertext]"><?php _e( 'Customize the footer credit text. Standard HTML is allowed.', 'kioremoana' ); ?></label>
						</fieldset>
					</td>
				</tr>

				</table>

				<table class="form-table">

				<h3 style="margin-top:40px;"><?php _e( 'Share Buttons', 'kioremoana' ); ?></h3>

				<tr valign="top"><th scope="row"><?php _e( 'Share option for posts', 'kioremoana' ); ?></th>
					<td>
						<fieldset><legend class="screen-reader-text"><span><?php _e( 'Share option for posts', 'kioremoana' ); ?></span></legend>
							<input id="kioremoana_theme_options[share-posts]" name="kioremoana_theme_options[share-posts]" type="checkbox" value="1" <?php checked( '1', $options['share-posts'] ); ?> />
							<label class="description" for="kioremoana_theme_options[share-posts]"><?php _e( 'Check this box to include share buttons (for Twitter, Facebook, Google+) on your blogs front page and on single post pages.', 'kioremoana' ); ?></label>
						</fieldset>
					</td>
				</tr>

				<tr valign="top"><th scope="row"><?php _e( 'Share option on single posts only', 'kioremoana' ); ?></th>
					<td>
						<fieldset><legend class="screen-reader-text"><span><?php _e( 'Share option on single posts only', 'kioremoana' ); ?></span></legend>
							<input id="kioremoana_theme_options[share-singleposts]" name="kioremoana_theme_options[share-singleposts]" type="checkbox" value="1" <?php checked( '1', $options['share-singleposts'] ); ?> />
							<label class="description" for="kioremoana_theme_options[share-singleposts]"><?php _e( 'Check this box to include the share post buttons <strong>only</strong> on single posts (below the post content).', 'kioremoana' ); ?></label>
						</fieldset>
					</td>
				</tr>
				</table>
				
				<table class="form-table">
				<h3 style="margin-top:40px;"><?php _e( 'Custom CSS', 'kioremoana' ); ?></h3>
				
				<tr valign="top"><th scope="row"><?php _e( 'Include Custom CSS', 'kioremoana' ); ?></th>
					<td>
						<fieldset><legend class="screen-reader-text"><span><?php _e( 'Include Custom CSS', 'kioremoana' ); ?></span></legend>
							<textarea id="kioremoana_theme_options[custom-css]" class="small-text" cols="100" rows="10" name="kioremoana_theme_options[custom-css]"><?php echo esc_textarea( $options['custom-css'] ); ?></textarea>
						<br/><label class="description" for="kioremoana_theme_options[custom-css]"><?php _e( 'Include custom CSS styles, use !important to overwrite existing styles.', 'kioremoana' ); ?></label>
						</fieldset>
					</td>
				</tr>
				
				</table>

			<?php submit_button(); ?>
		</form>
	</div>
	<?php
}

/*-----------------------------------------------------------------------------------*/
/* Sanitize and validate form input. Accepts an array, return a sanitized array.
/*-----------------------------------------------------------------------------------*/

function kioremoana_theme_options_validate( $input ) {
	global $layout_options, $font_options;
	
	// custom color must be 3 or 6 hexadecimal characters
	if ( isset( $input['link_color'] ) && preg_match( '/^#?([a-f0-9]{3}){1,2}$/i', $input['link_color'] ) )
			$output['link_color'] = '#' . strtolower( ltrim( $input['link_color'], '#' ) );

	if ( isset( $input['linkhover_color'] ) && preg_match( '/^#?([a-f0-9]{3}){1,2}$/i', $input['linkhover_color'] ) )
			$output['linkhover_color'] = '#' . strtolower( ltrim( $input['linkhover_color'], '#' ) );

	if ( isset( $input['infobg_color'] ) && preg_match( '/^#?([a-f0-9]{3}){1,2}$/i', $input['infobg_color'] ) )
			$output['infobg_color'] = '#' . strtolower( ltrim( $input['infobg_color'], '#' ) );

	if ( isset( $input['infobghover_color'] ) && preg_match( '/^#?([a-f0-9]{3}){1,2}$/i', $input['infobghover_color'] ) )
			$output['infobghover_color'] = '#' . strtolower( ltrim( $input['infobghover_color'], '#' ) );

	// Text options must be safe text with no HTML tags
	$input['info_page'] = wp_filter_nohtml_kses( $input['info_page'] );
	$input['custom_logo'] = wp_filter_nohtml_kses( $input['custom_logo'] );

	// checkbox values are either 0 or 1
	if ( ! isset( $input['share-posts'] ) )
		$input['share-posts'] = null;
	$input['share-posts'] = ( $input['share-posts'] == 1 ? 1 : 0 );

	if ( ! isset( $input['share-singleposts'] ) )
		$input['share-singleposts'] = null;
	$input['share-singleposts'] = ( $input['share-singleposts'] == 1 ? 1 : 0 );
	
	if ( ! isset( $input['show-excerpt'] ) )
		$input['show-excerpt'] = null;
	$input['show-excerpt'] = ( $input['show-excerpt'] == 1 ? 1 : 0 );
	
	if ( ! isset( $input['hide-title'] ) )
		$input['hide-title'] = null;
	$input['hide-title'] = ( $input['hide-title'] == 1 ? 1 : 0 );

	return $input;
}

/*-----------------------------------------------------------------------------------*/
/*  Adds Kiore Moana theme classes to the array of body classes.
/*-----------------------------------------------------------------------------------*/
function kioremoana_theme_classes( $themeclasses ) {
	$options = kioremoana_get_theme_options();
	$info_page = $options['info_page'];
	
	$default_options = kioremoana_get_default_theme_options();

	if ( $default_options['info_page'] == $info_page )
		$themeclasses[] = 'no-info';

	return $themeclasses;
}
add_filter( 'body_class', 'kioremoana_theme_classes' );


/*-----------------------------------------------------------------------------------*/
/* Add a style block to the theme for the current link color.
/*-----------------------------------------------------------------------------------*/
function kioremoana_print_link_color_style() {
	$options = kioremoana_get_theme_options();
	$link_color = $options['link_color'];

	$default_options = kioremoana_get_default_theme_options();

	// Don't do anything if the current link color is the default.
	if ( $default_options['link_color'] == $link_color )
		return;
?>
<style type="text/css">
/* Custom Link Color */
a,
#colophon .footer-nav {
	color: <?php echo $link_color; ?>;
}
a.more-link span,
#comments .comment-text p.comment-reply a.comment-reply-link,
#respond a#cancel-comment-reply-link,
input#submit, 
input.wpcf7-submit {
	background: <?php echo $link_color; ?>;
}
#masthead .slogan p.slogan-text:before {
	border-top: 2px solid <?php echo $link_color; ?>;
}
</style>
<?php
}
add_action( 'wp_head', 'kioremoana_print_link_color_style' );


/*-----------------------------------------------------------------------------------*/
/* Add a style block to the theme for the current link hover color.
/*-----------------------------------------------------------------------------------*/
function kioremoana_print_linkhover_color_style() {
	$options = kioremoana_get_theme_options();
	$linkhover_color = $options['linkhover_color'];

	$default_options = kioremoana_get_default_theme_options();

	// Don't do anything if the current link hover color is the default.
	if ( $default_options['linkhover_color'] == $linkhover_color )
		return;
?>
<style type="text/css"> 
/* Custom Link Hover Color */
a:hover,
#comments li.comment-author a:hover {
	color: <?php echo $linkhover_color; ?>;
}
#comments .comment-text p.comment-reply a.comment-reply-link:hover,
#respond a#cancel-comment-reply-link:hover,
input#submit:hover, 
input.wpcf7-submit:hover,
a.more-link:hover span {
	background: <?php echo $linkhover_color; ?>;
}
a.more-link {
	background: <?php echo $linkhover_color; ?> url(<?php echo get_template_directory_uri(); ?>/images/more-icon.png) right 50% no-repeat;
}
@media (-moz-min-device-pixel-ratio: 1.5), (-o-min-device-pixel-ratio: 3/2), (-webkit-min-device-pixel-ratio: 1.5), (min-device-pixel-ratio: 1.5) {
a.more-link {background: <?php echo $linkhover_color; ?> url(<?php echo get_template_directory_uri(); ?>/images/x2/more-icon.png) right 50% no-repeat; background-size: 50px auto;}
}

</style>
<?php
}
add_action( 'wp_head', 'kioremoana_print_linkhover_color_style' );


/*-----------------------------------------------------------------------------------*/
/* Add a style block to the theme for the current Info Page background color.
/*-----------------------------------------------------------------------------------*/
function kioremoana_print_infobg_color_style() {
	$options = kioremoana_get_theme_options();
	$infobg_color = $options['infobg_color'];

	$default_options = kioremoana_get_default_theme_options();

	// Don't do anything if the current footer background color is the default.
	if ( $default_options['infobg_color'] == $infobg_color )
		return;
?>
<style type="text/css">
/* Custom  Info Page background Color */
#masthead a.info-btn span.show-info {
	background: <?php echo $infobg_color; ?> url(<?php echo get_template_directory_uri(); ?>/images/info-icon.png) right 0 no-repeat;
}
.entry-content h3 {
	color: <?php echo $infobg_color; ?>;
}
body.template-info {
	background: <?php echo $infobg_color; ?>;
}
.widget-area .widget h3.widget-title span {
	background: <?php echo $infobg_color; ?>;
}
@media screen and (min-width: 1360px) {
#masthead a.info-btn span.more-info {
background: <?php echo $infobg_color; ?>;
}
}
</style>
<?php
}
add_action( 'wp_head', 'kioremoana_print_infobg_color_style' );


/*-----------------------------------------------------------------------------------*/
/* Add a style block to the theme for the current Info Button hover color.
/*-----------------------------------------------------------------------------------*/
function kioremoana_print_infobghover_color_style() {
	$options = kioremoana_get_theme_options();
	$infobghover_color = $options['infobghover_color'];

	$default_options = kioremoana_get_default_theme_options();

	// Don't do anything if the current header widget background color is the default.
	if ( $default_options['infobghover_color'] == $infobghover_color )
		return;
?>
<style type="text/css">
#masthead a.info-btn:hover span.show-info {
	background: <?php echo $infobghover_color; ?> url(<?php echo get_template_directory_uri(); ?>/images/info-icon.png) 0 0 no-repeat;
}
</style>
<?php
}
add_action( 'wp_head', 'kioremoana_print_infobghover_color_style' );


/*-----------------------------------------------------------------------------------*/
/* Add a style block to the theme for custom css styles.
/* 
/* This function is attached to the wp_head action hook.
/*-----------------------------------------------------------------------------------*/

function kioremoana_print_customcss_style() {
	$options = kioremoana_get_theme_options();
	$customcss = $options['custom-css'];

	$default_options = kioremoana_get_default_theme_options();

	// Don't do anything if custom CSS is empty.
	if ( $default_options['custom-css'] == $customcss )
		return;
?>
<style type="text/css">
/* Custom CSS */
<?php echo $customcss; ?>
</style>
<?php
}
add_action( 'wp_head', 'kioremoana_print_customcss_style' );