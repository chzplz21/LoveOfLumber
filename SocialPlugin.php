<?php 

/*
Plugin Name: NTT Social Networks
Plugin URI: 
Description: Displays links to RSS, Facebook, and Twitter
Version: 2.0
Author: David Rothkopf
*/

class ntt_link_to_social_networks extends WP_Widget
{
	function ntt_link_to_social_networks() {
		$widget_options = array(
			'classname' => 'ntt_link_to_social_networks',
			'description' => 'Displays Links to Facebook, Twitter,
			and RSS');
			
			parent::WP_Widget('ntt_link_to_social_networks', 'NTT Social
			Network Links', $widget_options);
			
		
	}
	
	function widget($args, $instance) {
		
		extract($args, EXTR_SKIP );
		
		
		$title = ($instance['title'] ) ;
		
		$facebook = ($instance['facebook'] );
		
		$twitter = ($instance['twitter'] );
		
		
		?>
		
		<?php echo $before_widget; ?>
		<?php echo $before_title . $title . $after_title; ?>
	
		<?php
		$ntt_feed_icon = plugins_url( 'Images/RSS.png', __FILE__);
		$ntt_facebook_icon = plugins_url( 'Images/facebookSmall.png', __FILE__);
		$ntt_twitter_icon = plugins_url( 'Images/twitterIcon.png', __FILE__);
		
		?>
		
		<div id = "IconsWidget">
			<a href ="http://www.twitter.com/" class = "Icons">  <?php echo $twitter; ?> 
				<img src = "<?php echo $ntt_twitter_icon; ?>" height = "50px" width = "50px"> 
			</a>
			
			<a href ="http://www.facebook.com/" class = "Icons"><?php echo $facebook; ?>  
				<img src = "<?php echo $ntt_facebook_icon; ?>" height = "50px" width = "50px">
			</a>
		</div>
		<?php echo $after_widget; ?>
		
		<?php
	
	}
	

	function update($new_instance, $old_instance) {
		$instance = $old_instance;
		
		$instance['title'] = strip_tags( $new_instance['title']);
		$instance['facebook'] = strip_tags( $new_instance['facebook']);
		$instance['twitter'] = strip_tags( $new_instance['twitter']);
		
		return $instance;
		
				
	}
	
	function form($instance) {
		$default = array('title' => 'Follow Me', 'facebook' => 'droth',
		'titter' => 'droth' );
		
		$instance = wp_parse_args( (array) $instance, $defaults );
		$title = $instance['title'];
		$facebook = $instance['facebook'];
		$twitter = $instance['twitter'];
		
		?>
		
		<p>Title: <input class = "nttsociallinks" name = "<?php echo $this->get_field_name( 'title' ); ?>"
		type = "text" value = "<?php echo esc_attr( $title); ?>" > </p>
		
		<p>Facebook ID: <input class = "nttsociallinks" name = "<?php echo $this->get_field_name( 'facebook' ); ?>"
		type = "text" value = "<?php echo esc_attr( $facebook); ?>" > </p>
		
		<p>Twitter ID: <input class = "nttsociallinks" name = "<?php echo $this->get_field_name( 'twitter' ); ?>"
		type = "text" value = "<?php echo esc_attr( $twitter); ?>" > </p>
		
		
<?php
		
	}
			
}

function ntt_link_to_social_networks_init() {
	register_widget('ntt_link_to_social_networks');
}

add_action('widgets_init', 'ntt_link_to_social_networks_init');