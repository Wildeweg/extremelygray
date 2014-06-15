<?php
/**
 * Available Kiore Moana Custom Widgets
 *
 * Learn more: http://codex.wordpress.org/Widgets_API#Developing_Widgets
 *
 * @package Kiore Moana
 * @since Kiore Moana 1.0
 */
 
/*-----------------------------------------------------------------------------------*/
/* Include Kiore Moana Flickr Widget
/*-----------------------------------------------------------------------------------*/

class kioremoana_flickr extends WP_Widget {

	function kioremoana_flickr() {
		$widget_ops = array('description' => __( 'A number of Flickr preview images' , 'kioremoana') );

		parent::WP_Widget(false, __('Flickr (Kiore Moana)', 'kioremoana'),$widget_ops);
	}

	function widget($args, $instance) {  
		extract( $args );
		$title = $instance['title'];
		$id = $instance['id'];
		$number = $instance['number'];
		$type = $instance['type'];
		$sorting = $instance['sorting'];

		echo $before_widget; ?>
		<?php if($title != '')
			echo '<h3 class="widget-title"><span>'.$title.'</span></h3>'; ?>
            
        <div class="flickr_badge_wrapper"><script type="text/javascript" src="http://www.flickr.com/badge_code_v2.gne?count=<?php echo $number; ?>&amp;display=<?php echo $sorting; ?>&amp;&amp;source=<?php echo $type; ?>&amp;<?php echo $type; ?>=<?php echo $id; ?>&amp;size=s"></script>
		  <div class="clear"></div>
		</div><!-- end .flickr_badge_wrapper -->
	
	   <?php			
	   echo $after_widget;
	   
	   // Reset the post globals as this query will have stomped on it
	   wp_reset_postdata();

   }

   function update($new_instance, $old_instance) {                
       return $new_instance;
   }

   function form($instance) {
		$title = esc_attr($instance['title']);
		$id = esc_attr($instance['id']);
		$number = esc_attr($instance['number']);
		$type = esc_attr($instance['type']);
		$sorting = esc_attr($instance['sorting']);
		?>
		
		 <p>
            <label for="<?php echo $this->get_field_id('title'); ?>"><?php _e('Title:','kioremoana'); ?></label>
            <input type="text" name="<?php echo $this->get_field_name('title'); ?>" value="<?php echo $title; ?>" class="widefat" id="<?php echo $this->get_field_id('title'); ?>" />
        </p>

        <p>
            <label for="<?php echo $this->get_field_id('id'); ?>"><?php _e('Flickr ID (<a href="http://www.idgettr.com" target="_blank">idGettr</a>):','kioremoana'); ?></label>
            <input type="text" name="<?php echo $this->get_field_name('id'); ?>" value="<?php echo $id; ?>" class="widefat" id="<?php echo $this->get_field_id('id'); ?>" />
        </p>

       	<p>
            <label for="<?php echo $this->get_field_id('number'); ?>"><?php _e('Number of photos:','kioremoana'); ?></label>
            <select name="<?php echo $this->get_field_name('number'); ?>" class="widefat" id="<?php echo $this->get_field_id('number'); ?>">
                <?php for ( $i = 1; $i <= 10; $i += 1) { ?>
                <option value="<?php echo $i; ?>" <?php if($number == $i){ echo "selected='selected'";} ?>><?php echo $i; ?></option>
                <?php } ?>
            </select>
        </p>

        <p>
            <label for="<?php echo $this->get_field_id('type'); ?>"><?php _e('Choose user or group:','kioremoana'); ?></label>
            <select name="<?php echo $this->get_field_name('type'); ?>" class="widefat" id="<?php echo $this->get_field_id('type'); ?>">
                <option value="user" <?php if($type == "user"){ echo "selected='selected'";} ?>><?php _e('User', 'kioremoana'); ?></option>
                <option value="group" <?php if($type == "group"){ echo "selected='selected'";} ?>><?php _e('Group', 'kioremoana'); ?></option>            
            </select>
        </p>
        <p>
            <label for="<?php echo $this->get_field_id('sorting'); ?>"><?php _e('Show latest or random pictures:','kioremoana'); ?></label>
            <select name="<?php echo $this->get_field_name('sorting'); ?>" class="widefat" id="<?php echo $this->get_field_id('sorting'); ?>">
                <option value="latest" <?php if($sorting == "latest"){ echo "selected='selected'";} ?>><?php _e('Latest', 'kioremoana'); ?></option>
                <option value="random" <?php if($sorting == "random"){ echo "selected='selected'";} ?>><?php _e('Random', 'kioremoana'); ?></option>            
            </select>
        </p>
		<?php
	}
} 

register_widget('kioremoana_flickr');

/*-----------------------------------------------------------------------------------*/
/* Include Kiore Moana Video Widget
/*-----------------------------------------------------------------------------------*/

class kioremoana_video extends WP_Widget {

	function kioremoana_video() {
		$widget_ops = array('description' => __( 'Show a featured video' , 'kioremoana') );

		parent::WP_Widget(false, __('Kiore Moana Featured Video', 'kioremoana'),$widget_ops);
	}

	function widget($args, $instance) {  
		extract( $args );
		$title = $instance['title'];
		$embedcode = $instance['embedcode'];
		
		echo $before_widget; ?>
		<?php if($title != '')
			echo '<h3 class="widget-title"><span>'.$title.'</span></h3>'; ?>

        <div class="video_widget">
		  <div class="featured-video"><?php echo $embedcode; ?></div>
		  </div><!-- end .video_widget -->

	   <?php			
	   echo $after_widget;
	   
	   // Reset the post globals as this query will have stomped on it
	   wp_reset_postdata();

   }

   function update($new_instance, $old_instance) {                
       return $new_instance;
   }

   function form($instance) {
		$title = esc_attr($instance['title']);
		$embedcode = esc_attr($instance['embedcode']);
		?>

		 <p>
            <label for="<?php echo $this->get_field_id('title'); ?>"><?php _e('Title:','kioremoana'); ?></label>
            <input type="text" name="<?php echo $this->get_field_name('title'); ?>" value="<?php echo $title; ?>" class="widefat" id="<?php echo $this->get_field_id('title'); ?>" />
        </p>

        <p>
            <label for="<?php echo $this->get_field_id('id'); ?>"><?php _e('Video embed code:','kioremoana'); ?></label>
				<textarea name="<?php echo $this->get_field_name('embedcode'); ?>" class="widefat" rows="6" id="<?php echo $this->get_field_id('embedcode'); ?>"><?php echo( $embedcode ); ?></textarea>
        </p>

		<?php
	}
} 

register_widget('kioremoana_video');


/*-----------------------------------------------------------------------------------*/
/* Kiore Moana Social Links Widget
/*-----------------------------------------------------------------------------------*/

 class kioremoana_sociallinks extends WP_Widget {

	function kioremoana_sociallinks() {
		$widget_ops = array('description' => __( 'Show icons with links to your social profiles' , 'kioremoana') );

		parent::WP_Widget(false, __('Social Links (Kiore Moana)', 'kioremoana'),$widget_ops);
	}

	function widget($args, $instance) {  
		extract( $args );
		$title = $instance['title'];
		$twitter = $instance['twitter'];
		$facebook = $instance['facebook'];
		$googleplus = $instance['googleplus'];
		$appnet = $instance['appnet'];
		$flickr = $instance['flickr'];
		$instagram = $instance['instagram'];
		$picasa = $instance['picasa'];
		$fivehundredpx = $instance['fivehundredpx'];
		$youtube = $instance['youtube'];
		$vimeo = $instance['vimeo'];
		$dribbble = $instance['dribbble'];
		$ffffound = $instance['ffffound'];
		$pinterest = $instance['pinterest'];
		$behance = $instance['behance'];
		$deviantart = $instance['deviantart'];
		$squidoo = $instance['squidoo'];
		$slideshare = $instance['slideshare'];
		$lastfm = $instance['lastfm'];
		$grooveshark = $instance['grooveshark'];
		$soundcloud = $instance['soundcloud'];
		$foursquare = $instance['foursquare'];
		$github = $instance['github'];
		$linkedin = $instance['linkedin'];
		$xing = $instance['xing'];
		$wordpress = $instance['wordpress'];
		$tumblr = $instance['tumblr'];
		$rss = $instance['rss'];
		$rsscomments = $instance['rsscomments'];
		
		echo $before_widget; ?>
		<?php if($title != '')
			echo '<h3 class="widget-title"><span>'.$title.'</span></h3>'; ?>

        <ul class="sociallinks">
			<?php 
			if($twitter != ''){
				echo '<li><a href="'.$twitter.'" class="twitter" title="Twitter">Twitter</a></li>';
			}
			?>

			<?php 
			if($facebook != '') {
				echo '<li><a href="'.$facebook.'" class="facebook" title="Facebook">Facebook</a></li>';
			}
			?>

			<?php 
			if($googleplus != '') {
				echo '<li><a href="'.$googleplus.'" class="googleplus" title="Google+">Google+</a></li>';
			}
			?>
			
			<?php 
			if($appnet != '') {
				echo '<li><a href="'.$appnet.'" class="appnet" title="App.net">App.net</a></li>';
			}
			?>

			<?php if($flickr != '') {
				echo '<li><a href="'.$flickr.'" class="flickr" title="Flickr">Flickr</a></li>';
			}
			?>

			<?php if($instagram != '') {
				echo '<li><a href="'.$instagram.'" class="instagram" title="Instagram">Instagram</a></li>';
			}
			?>

			<?php if($picasa != '') {
				echo '<li><a href="'.$picasa.'" class="picasa" title="Picasa">Picasa</a></li>';
			}
			?>

			<?php if($fivehundredpx != '') {
				echo '<li><a href="'.$fivehundredpx.'" class="fivehundredpx" title="500px">500px</a></li>';
			}
			?>	

			<?php if($youtube != '') {
				echo '<li><a href="'.$youtube.'" class="youtube" title="YouTube">YouTube</a></li>';
			}
			?>

			<?php if($vimeo != '') {
				echo '<li><a href="'.$vimeo.'" class="vimeo" title="Vimeo">Vimeo</a></li>';
			}
			?>

			<?php if($dribbble != '') {
				echo '<li><a href="'.$dribbble.'" class="dribbble" title="Dribbble">Dribbble</a></li>';
			}
			?>

			<?php if($ffffound != '') {
				echo '<li><a href="'.$ffffound.'" class="ffffound" title="Ffffound">Ffffound</a></li>';
			}
			?>

			<?php if($pinterest != '') {
				echo '<li><a href="'.$pinterest.'" class="pinterest" title="Pinterest">Pinterest</a></li>';
			}
			?>

			<?php if($behance != '') {
				echo '<li><a href="'.$behance.'" class="behance" title="Behance Network">Behance Network</a></li>';
			}
			?>

			<?php if($deviantart != '') {
				echo '<li><a href="'.$deviantart.'" class="deviantart" title="deviantART">deviantART</a></li>';
			}
			?>

			<?php if($squidoo != '') {
				echo '<li><a href="'.$squidoo.'" class="squidoo" title="Squidoo">Squidoo</a></li>';
			}
			?>

			<?php if($slideshare != '') {
				echo '<li><a href="'.$slideshare.'" class="slideshare" title="Slideshare">Slideshare</a></li>';
			}
			?>

			<?php if($lastfm != '') {
				echo '<li><a href="'.$lastfm.'" class="lastfm" title="Lastfm">Lastfm</a></li>';
			}
			?>

			<?php if($grooveshark != '') {
				echo '<li><a href="'.$grooveshark.'" class="grooveshark" title="Grooveshark">Grooveshark</a></li>';
			}
			?>

			<?php if($soundcloud != '') {
				echo '<li><a href="'.$soundcloud.'" class="soundcloud" title="Soundcloud">Soundcloud</a></li>';
			}
			?>

			<?php if($foursquare != '') {
				echo '<li><a href="'.$foursquare.'" class="foursquare" title="Foursquare">Foursquare</a></li>';
			}
			?>

			<?php if($github != '') {
				echo '<li><a href="'.$github.'" class="github" title="GitHub">GitHub</a></li>';
			}
			?>

			<?php if($linkedin != '') {
				echo '<li><a href="'.$linkedin.'" class="linkedin" title="LinkedIn">LinkedIn</a></li>';
			}
			?>

			<?php if($xing != '') {
				echo '<li><a href="'.$xing.'" class="xing" title="Xing">Xing</a></li>';
			}
			?>

			<?php if($wordpress != '') {
				echo '<li><a href="'.$wordpress.'" class="wordpress" title="WordPress">WordPress</a></li>';
			}
			?>

			<?php if($tumblr != '') {
				echo '<li><a href="'.$tumblr.'" class="tumblr" title="Tumblr">Tumblr</a></li>';
			}
			?>

			<?php if($rss != '') {
				echo '<li><a href="'.$rss.'" class="rss" title="RSS Feed">RSS Feed</a></li>';
			}
			?>

			<?php if($rsscomments != '') {
				echo '<li><a href="'.$rsscomments.'" class="rsscomments" title="RSS Comments">RSS Comments</a></li>';
			}
			?>
		</ul><!-- end .sociallinks -->

	   <?php			
	   echo $after_widget;
	   
	   // Reset the post globals as this query will have stomped on it
	   wp_reset_postdata();

   }

   function update($new_instance, $old_instance) {                
       return $new_instance;
   }

   function form($instance) { 
		$title = esc_attr($instance['title']);
		$twitter = esc_attr($instance['twitter']);
		$facebook = esc_attr($instance['facebook']);
		$googleplus = esc_attr($instance['googleplus']);
		$appnet = esc_attr($instance['appnet']);
		$flickr = esc_attr($instance['flickr']);
		$instagram = esc_attr($instance['instagram']);
		$picasa = esc_attr($instance['picasa']);
		$fivehundredpx = esc_attr($instance['fivehundredpx']);
		$youtube = esc_attr($instance['youtube']);
		$vimeo = esc_attr($instance['vimeo']);
		$dribbble = esc_attr($instance['dribbble']);
		$ffffound = esc_attr($instance['ffffound']);
		$pinterest = esc_attr($instance['pinterest']);
		$behance = esc_attr($instance['behance']);
		$deviantart = esc_attr($instance['deviantart']);
		$squidoo = esc_attr($instance['squidoo']);
		$slideshare = esc_attr($instance['slideshare']);
		$lastfm = esc_attr($instance['lastfm']);
		$grooveshark = esc_attr($instance['grooveshark']);
		$soundcloud = esc_attr($instance['soundcloud']);
		$foursquare = esc_attr($instance['foursquare']);
		$github = esc_attr($instance['github']);
		$linkedin = esc_attr($instance['linkedin']);
		$xing = esc_attr($instance['xing']);
		$wordpress = esc_attr($instance['wordpress']);
		$tumblr = esc_attr($instance['tumblr']);
		$rss = esc_attr($instance['rss']);
		$rsscomments = esc_attr($instance['rsscomments']);
		
		?>

		 <p>
            <label for="<?php echo $this->get_field_id('title'); ?>"><?php _e('Title:','kioremoana'); ?></label>
            <input type="text" name="<?php echo $this->get_field_name('title'); ?>" value="<?php echo $title; ?>" class="widefat" id="<?php echo $this->get_field_id('title'); ?>" />
        </p>

		<p>
            <label for="<?php echo $this->get_field_id('twitter'); ?>"><?php _e('Twitter URL:','kioremoana'); ?></label>
            <input type="text" name="<?php echo $this->get_field_name('twitter'); ?>" value="<?php echo $twitter; ?>" class="widefat" id="<?php echo $this->get_field_id('twitter'); ?>" />
        </p>

		<p>
            <label for="<?php echo $this->get_field_id('facebook'); ?>"><?php _e('Facebook URL:','kioremoana'); ?></label>
            <input type="text" name="<?php echo $this->get_field_name('facebook'); ?>" value="<?php echo $facebook; ?>" class="widefat" id="<?php echo $this->get_field_id('facebook'); ?>" />
        </p>
		
		<p>
            <label for="<?php echo $this->get_field_id('googleplus'); ?>"><?php _e('Google+ URL:','kioremoana'); ?></label>
            <input type="text" name="<?php echo $this->get_field_name('googleplus'); ?>" value="<?php echo $googleplus; ?>" class="widefat" id="<?php echo $this->get_field_id('googleplus'); ?>" />
        </p>
		  
		  <p>
            <label for="<?php echo $this->get_field_id('appnet'); ?>"><?php _e('App.net URL:','kioremoana'); ?></label>
            <input type="text" name="<?php echo $this->get_field_name('appnet'); ?>" value="<?php echo $appnet; ?>" class="widefat" id="<?php echo $this->get_field_id('appnet'); ?>" />
        </p>
		
		<p>
            <label for="<?php echo $this->get_field_id('flickr'); ?>"><?php _e('Flickr URL:','kioremoana'); ?></label>
            <input type="text" name="<?php echo $this->get_field_name('flickr'); ?>" value="<?php echo $flickr; ?>" class="widefat" id="<?php echo $this->get_field_id('flickr'); ?>" />
        </p>
		  
		 <p>
            <label for="<?php echo $this->get_field_id('instagram'); ?>"><?php _e('Instagram URL:','kioremoana'); ?></label>
            <input type="text" name="<?php echo $this->get_field_name('instagram'); ?>" value="<?php echo $instagram; ?>" class="widefat" id="<?php echo $this->get_field_id('instagram'); ?>" />
        </p>

		<p>
            <label for="<?php echo $this->get_field_id('picasa'); ?>"><?php _e('Picasa URL:','kioremoana'); ?></label>
            <input type="text" name="<?php echo $this->get_field_name('picasa'); ?>" value="<?php echo $picasa; ?>" class="widefat" id="<?php echo $this->get_field_id('picasa'); ?>" />
        </p>

		<p>
            <label for="<?php echo $this->get_field_id('fivehundredpx'); ?>"><?php _e('500px URL:','kioremoana'); ?></label>
            <input type="text" name="<?php echo $this->get_field_name('fivehundredpx'); ?>" value="<?php echo $fivehundredpx; ?>" class="widefat" id="<?php echo $this->get_field_id('fivehundredpx'); ?>" />
        </p>

		<p>
            <label for="<?php echo $this->get_field_id('youtube'); ?>"><?php _e('YouTube URL:','kioremoana'); ?></label>
            <input type="text" name="<?php echo $this->get_field_name('youtube'); ?>" value="<?php echo $youtube; ?>" class="widefat" id="<?php echo $this->get_field_id('youtube'); ?>" />
        </p>
		
		<p>
            <label for="<?php echo $this->get_field_id('vimeo'); ?>"><?php _e('Vimeo URL:','kioremoana'); ?></label>
            <input type="text" name="<?php echo $this->get_field_name('vimeo'); ?>" value="<?php echo $vimeo; ?>" class="widefat" id="<?php echo $this->get_field_id('vimeo'); ?>" />
        </p>
		
		<p>
            <label for="<?php echo $this->get_field_id('dribbble'); ?>"><?php _e('Dribbble URL:','kioremoana'); ?></label>
            <input type="text" name="<?php echo $this->get_field_name('dribbble'); ?>" value="<?php echo $dribbble; ?>" class="widefat" id="<?php echo $this->get_field_id('dribbble'); ?>" />
        </p>
		
		<p>
            <label for="<?php echo $this->get_field_id('ffffound'); ?>"><?php _e('Ffffound URL:','kioremoana'); ?></label>
            <input type="text" name="<?php echo $this->get_field_name('ffffound'); ?>" value="<?php echo $ffffound; ?>" class="widefat" id="<?php echo $this->get_field_id('ffffound'); ?>" />
        </p>
		
		<p>
            <label for="<?php echo $this->get_field_id('pinterest'); ?>"><?php _e('Pinterest URL:','kioremoana'); ?></label>
            <input type="text" name="<?php echo $this->get_field_name('pinterest'); ?>" value="<?php echo $pinterest; ?>" class="widefat" id="<?php echo $this->get_field_id('pinterest'); ?>" />
        </p>
		
		<p>
            <label for="<?php echo $this->get_field_id('behance'); ?>"><?php _e('Behance Network URL:','kioremoana'); ?></label>
            <input type="text" name="<?php echo $this->get_field_name('behance'); ?>" value="<?php echo $behance; ?>" class="widefat" id="<?php echo $this->get_field_id('behance'); ?>" />
        </p>
		  
		 <p>
            <label for="<?php echo $this->get_field_id('deviantart'); ?>"><?php _e('deviantART URL:','kioremoana'); ?></label>
            <input type="text" name="<?php echo $this->get_field_name('deviantart'); ?>" value="<?php echo $deviantart; ?>" class="widefat" id="<?php echo $this->get_field_id('deviantart'); ?>" />
        </p>
		
		<p>
            <label for="<?php echo $this->get_field_id('squidoo'); ?>"><?php _e('Squidoo URL:','kioremoana'); ?></label>
            <input type="text" name="<?php echo $this->get_field_name('squidoo'); ?>" value="<?php echo $squidoo; ?>" class="widefat" id="<?php echo $this->get_field_id('squidoo'); ?>" />
        </p>
		
		<p>
            <label for="<?php echo $this->get_field_id('slideshare'); ?>"><?php _e('Slideshare URL:','kioremoana'); ?></label>
            <input type="text" name="<?php echo $this->get_field_name('slideshare'); ?>" value="<?php echo $slideshare; ?>" class="widefat" id="<?php echo $this->get_field_id('slideshare'); ?>" />
        </p>
		
		<p>
            <label for="<?php echo $this->get_field_id('lastfm'); ?>"><?php _e('Last.fm URL:','kioremoana'); ?></label>
            <input type="text" name="<?php echo $this->get_field_name('lastfm'); ?>" value="<?php echo $lastfm; ?>" class="widefat" id="<?php echo $this->get_field_id('lastfm'); ?>" />
        </p>
		
		<p>
            <label for="<?php echo $this->get_field_id('grooveshark'); ?>"><?php _e('Grooveshark URL:','kioremoana'); ?></label>
            <input type="text" name="<?php echo $this->get_field_name('grooveshark'); ?>" value="<?php echo $grooveshark; ?>" class="widefat" id="<?php echo $this->get_field_id('grooveshark'); ?>" />
        </p>

		<p>
            <label for="<?php echo $this->get_field_id('soundcloud'); ?>"><?php _e('Soundcloud URL:','kioremoana'); ?></label>
            <input type="text" name="<?php echo $this->get_field_name('soundcloud'); ?>" value="<?php echo $soundcloud; ?>" class="widefat" id="<?php echo $this->get_field_id('soundcloud'); ?>" />
        </p>

		<p>
            <label for="<?php echo $this->get_field_id('foursquare'); ?>"><?php _e('Foursquare URL:','kioremoana'); ?></label>
            <input type="text" name="<?php echo $this->get_field_name('foursquare'); ?>" value="<?php echo $foursquare; ?>" class="widefat" id="<?php echo $this->get_field_id('foursquare'); ?>" />
        </p>

		<p>
            <label for="<?php echo $this->get_field_id('github'); ?>"><?php _e('GitHub URL:','kioremoana'); ?></label>
            <input type="text" name="<?php echo $this->get_field_name('github'); ?>" value="<?php echo $github; ?>" class="widefat" id="<?php echo $this->get_field_id('github'); ?>" />
        </p>

		<p>
            <label for="<?php echo $this->get_field_id('linkedin'); ?>"><?php _e('Linkedin URL:','kioremoana'); ?></label>
            <input type="text" name="<?php echo $this->get_field_name('linkedin'); ?>" value="<?php echo $linkedin; ?>" class="widefat" id="<?php echo $this->get_field_id('linkedin'); ?>" />
        </p>

		<p>
            <label for="<?php echo $this->get_field_id('xing'); ?>"><?php _e('Xing URL:','kioremoana'); ?></label>
            <input type="text" name="<?php echo $this->get_field_name('xing'); ?>" value="<?php echo $xing; ?>" class="widefat" id="<?php echo $this->get_field_id('xing'); ?>" />
        </p>
		
		<p>
            <label for="<?php echo $this->get_field_id('wordpress'); ?>"><?php _e('WordPress URL:','kioremoana'); ?></label>
            <input type="text" name="<?php echo $this->get_field_name('wordpress'); ?>" value="<?php echo $wordpress; ?>" class="widefat" id="<?php echo $this->get_field_id('wordpress'); ?>" />
        </p>
		
		<p>
            <label for="<?php echo $this->get_field_id('tumblr'); ?>"><?php _e('Tumblr URL:','kioremoana'); ?></label>
            <input type="text" name="<?php echo $this->get_field_name('tumblr'); ?>" value="<?php echo $tumblr; ?>" class="widefat" id="<?php echo $this->get_field_id('tumblr'); ?>" />
        </p>
		
		<p>
            <label for="<?php echo $this->get_field_id('rss'); ?>"><?php _e('RSS-Feed URL:','kioremoana'); ?></label>
            <input type="text" name="<?php echo $this->get_field_name('rss'); ?>" value="<?php echo $rss; ?>" class="widefat" id="<?php echo $this->get_field_id('rss'); ?>" />
        </p>
		
		<p>
            <label for="<?php echo $this->get_field_id('rsscomments'); ?>"><?php _e('RSS for Comments URL:','kioremoana'); ?></label>
            <input type="text" name="<?php echo $this->get_field_name('rsscomments'); ?>" value="<?php echo $rsscomments; ?>" class="widefat" id="<?php echo $this->get_field_id('rsscomments'); ?>" />
        </p>
       
		<?php
	}
} 

register_widget('kioremoana_sociallinks');


/*-----------------------------------------------------------------------------------*/
/* Kiore Moana Recent Posts Widget
/*-----------------------------------------------------------------------------------*/

class kioremoana_recentposts extends WP_Widget {

	function kioremoana_recentposts() {
		$widget_ops = array('description' => __( 'A number of Recent Posts for your widget page', 'kioremoana') );

		parent::WP_Widget(false, __('Recent Posts (Kiore Moana)', 'kioremoana'),$widget_ops);
	}

	function widget($args, $instance) {
		extract( $args );
		$title = $instance['title'];
		$postnumber = $instance['postnumber'];
		$cat = apply_filters('widget_title', $instance['cat']);
		
		echo $before_widget; ?>
		<?php if($title != '')
			echo '<h3 class="widget-title"><span>'.$title.'</span></h3>'; ?>

			<ul class="kioremoana-rp">
				<?php
				global $post;
				$kioremoana_post = $post;
								
				// get the category IDs and the number of posts and place them in an array
				if($cat) {
					$args = array(
						'posts_per_page' => $postnumber,
						'cat' => $cat,
					);
				} else {
					$args = array(
						'posts_per_page' => $postnumber,
					);
				}
				
				$myposts = get_posts( $args );
				foreach( $myposts as $post ) : setup_postdata($post); ?>

					<li class="rp-box">
						<a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
						<div class="rp-meta">
							<span class="rp-date"><a href="<?php the_permalink(); ?>" class="entry-date"><?php echo get_the_date(); ?></a></span>
							<?php if ( comments_open() ) : ?>
							<span class="rp-comments">
							<?php comments_popup_link( '<span class="leave-reply">' . __( '0 comments', 'kioremoana' ) . '</span>', __( '1 comment', 'kioremoana' ), __( '% comments', 'kioremoana' ) ); ?>
							</span><!-- end .rp-comments -->
							<?php endif; // comments_open() ?>
						</div><!-- end .rp-meta -->
					</li>
					<?php endforeach; ?>
					<?php $post = $kioremoana_post; ?>
			</ul><!-- end .kioremoana-rp -->
	   <?php			
	   echo $after_widget;
	   
	   // Reset the post globals as this query will have stomped on it
	   wp_reset_postdata();

   }

   function update($new_instance, $old_instance) {                
       return $new_instance;
   }

   function form($instance) {
   		$title = esc_attr($instance['title']);
   		$postnumber = esc_attr($instance['postnumber']);
		$cat = esc_attr($instance['cat']);
		?>
		
		 <p>
            <label for="<?php echo $this->get_field_id('title'); ?>"><?php _e('Title:','kioremoana'); ?></label>
            <input type="text" name="<?php echo $this->get_field_name('title'); ?>" value="<?php echo $title; ?>" class="widefat" id="<?php echo $this->get_field_id('title'); ?>" />
        </p>
		
		 <p>
            <label for="<?php echo $this->get_field_id('postnumber'); ?>"><?php _e('Number of posts to display:','kioremoana'); ?></label>
            <input type="text" name="<?php echo $this->get_field_name('postnumber'); ?>" value="<?php echo $postnumber; ?>" class="widefat" id="<?php echo $this->get_field_id('postnumber'); ?>" />
        </p>

        <p>
            <label for="<?php echo $this->get_field_id('cat'); ?>"><?php _e('Category ID numbers (to choose which categories to include):','kioremoana'); ?></label>
            <input type="text" name="<?php echo $this->get_field_name('cat'); ?>" value="<?php echo $cat; ?>" class="widefat" id="<?php echo $this->get_field_id('cat'); ?>" />
        </p>
       
		<?php
	}
} 

register_widget('kioremoana_recentposts');


/*-----------------------------------------------------------------------------------*/
/* Include Kiora Moana About Widget
/*-----------------------------------------------------------------------------------*/

class kioremoana_about extends WP_Widget {

	function kioremoana_about() {
		$widget_ops = array('description' => 'About widget with picture and intro text' , 'kioremoana');

		parent::WP_Widget(false, __('About (Kiore Moana)', 'kioremoana'),$widget_ops);
	}

	function widget($args, $instance) {  
		extract( $args );
		$title = $instance['title'];
		$imageurl = $instance['imageurl'];
		$imagewidth = $instance['imagewidth'];
		$imageheight = $instance['imageheight'];
		$aboutsubtitle = $instance['aboutsubtitle'];
		$abouttext = $instance['abouttext'];

		echo $before_widget; ?>
		<?php if($title != '')
			echo '<h3 class="widget-title"><span>'.$title.'</span></h3>'; ?>

			 <div class="about-wrap">
				<img src="<?php echo $imageurl; ?>" width="<?php echo $imagewidth; ?>" height="<?php echo $imageheight; ?>" class="about-img">
				<h4 class="about-subtitle"><?php echo $aboutsubtitle; ?></h4>
				<p class="about-text"><?php echo $abouttext; ?></p>
			</div><!-- end .about-wrap -->
	   <?php
	   echo $after_widget;
   }

   function update($new_instance, $old_instance) {                
       return $new_instance;
   }

   function form($instance) {
		$title = esc_attr($instance['title']);
		$imageurl = esc_attr($instance['imageurl']);
		$imagewidth = esc_attr($instance['imagewidth']);
		$imageheight = esc_attr($instance['imageheight']);
		$aboutsubtitle = esc_attr($instance['aboutsubtitle']);
		$abouttext = esc_attr($instance['abouttext']);
		?>
		
		 <p>
			 <label for="<?php echo $this->get_field_id('title'); ?>"><?php _e('Title:','kioremoana'); ?></label>
			 <input type="text" name="<?php echo $this->get_field_name('title'); ?>" value="<?php echo $title; ?>" class="widefat" id="<?php echo $this->get_field_id('title'); ?>" />
        </p>

		 <p>
			 <label for="<?php echo $this->get_field_id('imageurl'); ?>"><?php _e('Image URL:','kioremoana'); ?></label>
			 <input type="text" name="<?php echo $this->get_field_name('imageurl'); ?>" value="<?php echo $imageurl; ?>" class="widefat" id="<?php echo $this->get_field_id('imageurl'); ?>" />
        </p>
		  
		 <p>
			 <label for="<?php echo $this->get_field_id('imagewidth'); ?>"><?php _e('Image Width (e.g. 320):','kioremoana'); ?></label>
			 <input type="text" name="<?php echo $this->get_field_name('imagewidth'); ?>" value="<?php echo $imagewidth; ?>" class="widefat" id="<?php echo $this->get_field_id('imagewidth'); ?>" />
        </p>
		  
		 <p>
			 <label for="<?php echo $this->get_field_id('imageheight'); ?>"><?php _e('Image Height (e.g. 320):','kioremoana'); ?></label>
			 <input type="text" name="<?php echo $this->get_field_name('imageheight'); ?>" value="<?php echo $imageheight; ?>" class="widefat" id="<?php echo $this->get_field_id('imageheight'); ?>" />
        </p>
        
         <p>
			 <label for="<?php echo $this->get_field_id('aboutsubtitle'); ?>"><?php _e('About Subtitle:','kioremoana'); ?></label>
			 <input type="text" name="<?php echo $this->get_field_name('aboutsubtitle'); ?>" value="<?php echo $aboutsubtitle; ?>" class="widefat" id="<?php echo $this->get_field_id('aboutsubtitle'); ?>" />
        </p>

		<p>
			<label for="<?php echo $this->get_field_id('abouttext'); ?>"><?php _e('About Text:','kioremoana'); ?></label>
			<textarea name="<?php echo $this->get_field_name('abouttext'); ?>" class="widefat" rows="12" cols="20" id="<?php echo $this->get_field_id('abouttext'); ?>"><?php echo( $abouttext ); ?></textarea>
        </p>

		<?php
	}
} 

register_widget('kioremoana_about');

/*-----------------------------------------------------------------------------------*/
/* Include Kiora Moana Header Slogan Widget
/*-----------------------------------------------------------------------------------*/

class kioremoana_headerslogan extends WP_Widget {

	function kioremoana_headerslogan() {
		$widget_ops = array('description' => 'Header slogan widget with headline and slogan text for your header area.' , 'kioremoana');

		parent::WP_Widget(false, __('Header Slogan (Kiore Moana)', 'kioremoana'),$widget_ops);
	}

	function widget($args, $instance) {  
		extract( $args );
		$slogantitle = $instance['slogantitle'];
		$slogantext = $instance['slogantext'];

		echo $before_widget; ?>

		<div class="slogan">
			<h3 class="slogan-headline"><?php echo $slogantitle; ?></h3>
			<p class="slogan-text"><?php echo $slogantext; ?></p>
		</div><!-- end .slogan -->

	   <?php
	   echo $after_widget;

	   // Reset the post globals as this query will have stomped on it
	   wp_reset_postdata();
	   }

   function update($new_instance, $old_instance) {                
       return $new_instance;
   }

   function form($instance) {
		$slogantitle = esc_attr($instance['slogantitle']);
		$slogantext = esc_attr($instance['slogantext']);
		?>

         <p>
			 <label for="<?php echo $this->get_field_id('slogantitle'); ?>"><?php _e('Header Slogan Title:','kioremoana'); ?></label>
			 <input type="text" name="<?php echo $this->get_field_name('slogantitle'); ?>" value="<?php echo $slogantitle; ?>" class="widefat" id="<?php echo $this->get_field_id('slogantitle'); ?>" />
        </p>

		<p>
			<label for="<?php echo $this->get_field_id('slogantext'); ?>"><?php _e('Header Slogan Text:','kioremoana'); ?></label>
			<textarea name="<?php echo $this->get_field_name('slogantext'); ?>" class="widefat" rows="8" cols="12" id="<?php echo $this->get_field_id('slogantext'); ?>"><?php echo( $slogantext ); ?></textarea>
        </p>

		<?php
	}
} 

register_widget('kioremoana_headerslogan');

