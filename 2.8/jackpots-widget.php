<?php
/*
 * Plugin Name: jackpots Widget
 * Version: 1.0b
 * Plugin URI:http://www.gamblingmodules.com/
 * Description: jackpots Widget is the only wordpress widget that give your site visitors live jackpots feeds
 * Author: Incomate
 * Author URI: http://www.incomate.com/
 */
class jackpotswidget extends WP_Widget
{
	/**
	* Declares the HelloWorldWidget class.
	*
	*/
	function jackpotswidget(){
		$widget_ops = array('classname' => 'jackpots_widget', 'description' => __( "Example widget demoing WordPress 2.8 widget API") );
		$control_ops = array('width' => 300, 'height' => 300);
		$this->WP_Widget('jackpotswidget', __('jackpots widget'), $widget_ops, $control_ops);
	}
	
	/**
	* Displays the Widget
	*
	*/
	function widget($args, $instance){
		# Widget internal parameters
		$feeds_url = 'http://feeds.incomate.com/?type=9036&asf=aptc:23x1;configID:Full&geo=true';
		$default_width = '270px';
		$default_height; // Set a value here if you wanna ensure a minimum height
		$bottom_html = '<p style="font-size: x-small">
        <b><a href="http://www.gamblingmodules.com" target="_blank" title="gambling widgets">jackpots widget</a></b></p>'; // Set HTML content here
		
		
		extract($args);
		$title = apply_filters('widget_title', empty($instance['title']) ? '&nbsp;' : $instance['title']);
		$width = empty($instance['width']) ? $default_width : $instance['width'];
		$height = empty($instance['height']) ? $default_height : $instance['height'];
		
		# Before the widget
		echo $before_widget;
		
		# The title
		if ( $title )
			echo $before_title . $title . $after_title;
		
		# Make the HTML of the widget
		
		echo '<iframe src="'.$feeds_url.'" width="'.$width;
		if ($height) echo '" height="'.$height;
		echo '" frameborder="0" marginheight="0px" marginwidth="0" scrolling="auto"><a href="'.$feeds_url.'">Hmm, you are using a very old browser. Click here to go directly to included content.</a>
			  </iframe>';
		echo $bottom_html;
		
		# After the widget
		echo $after_widget;
	}
	
	/**
	* Saves the widgets settings.
	*
	*/
	function update($new_instance, $old_instance){
		$instance = $old_instance;
		$instance['title'] = strip_tags(stripslashes($new_instance['title']));
		$instance['width'] = strip_tags(stripslashes($new_instance['width']));
		$instance['height'] = strip_tags(stripslashes($new_instance['height']));
		
		return $instance;
	}
	
	/**
	* Creates the edit form for the widget.
	*
	*/
	function form($instance){
		//Defaults
		$instance = wp_parse_args( (array) $instance, array('title'=>'jackpots widget', 'width'=>'170px', 'height'=>'150px') );
		
		$title = htmlspecialchars($instance['title']);
		$width = htmlspecialchars($instance['width']);
		$height = htmlspecialchars($instance['height']);
		
		# Output the options
		echo '<p style="text-align:right;"><label for="' . $this->get_field_name('title') . '">' . __('Title:') . ' <input style="width: 250px;" id="' . $this->get_field_id('title') . '" name="' . $this->get_field_name('title') . '" type="text" value="' . $title . '" /></label></p>';
		# Text line 1
		echo '<p style="text-align:right;"><label for="' . $this->get_field_name('width') . '">' . __('Width:') . ' <input style="width: 200px;" id="' . $this->get_field_id('width') . '" name="' . $this->get_field_name('width') . '" type="text" value="' . $width . '" /></label></p>';
		# Text line 2
		echo '<p style="text-align:right;"><label for="' . $this->get_field_name('height') . '">' . __('Height:') . ' <input style="width: 200px;" id="' . $this->get_field_id('height') . '" name="' . $this->get_field_name('height') . '" type="text" value="' . $height . '" /></label></p>';
	}

}// END class
	
	/**
	* Register Hello World widget.
	*
	* Calls 'widgets_init' action after the Hello World widget has been registered.
	*/
	function jackpotswidgetInit() {
		register_widget('jackpotswidget');
	}	
	add_action('widgets_init', 'jackpotswidgetInit');
?>
