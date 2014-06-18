<?php
/**
 * The template for the main header.
 *
 * @subpackage Kiore Moana
 * @since Kiore Moana 1.0
 */
?>

<header id="masthead" class="clearfix" role="banner">
	
	<?php $options = get_option('kioremoana_theme_options'); ?>
	<?php if( $options['info_page'] != '' ) : ?>
		<a href="<?php echo $options['info_page']; ?>" class="info-btn" title="<?php _e('Info', 'kioremoana') ?>"><span class="more-info"><?php _e('More Info', 'kioremoana') ?></span><span class="show-info"><?php _e('Info Button', 'kioremoana') ?></span></a>
	<?php endif; ?>
	
	<div class="hero-image">		
		<div id="site-title">
		<?php if( $options['custom_logo'] != '' ) : ?>
			<a href="<?php echo home_url( '/' ); ?>" class="logo"><img src="<?php echo $options['custom_logo']; ?>" alt="<?php bloginfo('name'); ?>" title="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>" /></a>
		<?php endif; ?>
		<?php if( $options['hide-title'] == 0 ) : ?>
			<h1><a href="<?php echo home_url( '/' ); ?>" title="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>"><?php bloginfo( 'name' ); ?></a></h1>
		<?php endif; ?>
		</div><!-- end #site-title -->
		
		
	</div>
	
	

	<?php if ( is_active_sidebar( 'sidebar-2' ) &&  is_front_page() ) : ?>
			<?php dynamic_sidebar( 'sidebar-2' ); ?>
	<?php endif; ?>

</header><!-- end #masthead -->