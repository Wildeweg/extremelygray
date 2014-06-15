 <?php
/**
 * The template for displaying the footer.
 *
 * @package Kiore Moana
 * @since Kiore Moana 1.0
 */
?>

	<footer id="colophon" class="site-footer clearfix" role="contentinfo">

		<div id="site-info">

			<div class="credit-wrap">
			<?php if (has_nav_menu( 'optional' ) ) {
				wp_nav_menu( array('theme_location' => 'optional', 'container' => 'nav' , 'container_class' => 'footer-nav', 'depth' => 1 ));} 
			?>

			<?php
				$options = get_option('kioremoana_theme_options');
				if($options['custom_footertext'] != '' ){
					echo ('<p class="credittext">');
					echo stripslashes($options['custom_footertext']);
					echo ('</p>');
			} else { ?>
			<ul class="credit">
				<li class="copyright">&copy; <?php echo date('Y'); ?> <?php bloginfo(); ?></li>
				<li class="wp-credit"><?php _e('Proudly powered by', 'kioremoana') ?> <a href="<?php echo esc_url( __( 'http://wordpress.org/', 'kioremoana' ) ); ?>" ><?php _e('WordPress.', 'kioremoana') ?></a></li>
				<li><?php printf( __( 'Theme: %1$s by %2$s', 'kioremoana' ), 'Kiore Moana', '<a href="http://www.elmastudio.de/en/themes/" title="Elmastudio WordPress Themes">Elmastudio</a>' ); ?></li>
			</ul><!-- end .credit -->
			<?php } ?>
			</div><!-- end .credit-wrap -->
			
		</div><!-- end #site-info -->

	</footer><!-- end #colophon -->

<?php // Includes Twitter and Google+ button code if the share post option is active.
	$options = get_option('kioremoana_theme_options');
	if($options['share-singleposts'] or $options['share-posts']) : ?>
	<script type="text/javascript" src="http://platform.twitter.com/widgets.js"></script>
	<script type="text/javascript">
	(function() {
		var po = document.createElement('script'); po.type = 'text/javascript'; po.async = true;
		po.src = 'https://apis.google.com/js/plusone.js';
		var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(po, s);
	})();
	</script>

	<script type="text/javascript">
(function() {
    window.PinIt = window.PinIt || { loaded:false };
    if (window.PinIt.loaded) return;
    window.PinIt.loaded = true;
    function async_load(){
        var s = document.createElement("script");
        s.type = "text/javascript";
        s.async = true;
        s.src = "http://assets.pinterest.com/js/pinit.js";
        var x = document.getElementsByTagName("script")[0];
        x.parentNode.insertBefore(s, x);
    }
    if (window.attachEvent)
        window.attachEvent("onload", async_load);
    else
        window.addEventListener("load", async_load, false);
})();
</script>

<?php endif; ?>

<?php wp_footer(); ?>

</body>
</html>