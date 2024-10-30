<?php
/*
 * Plugin Name: jackpots widget
 * Version: 1.0b
 * Plugin URI: http://www.gamblingmodules.com/
 * Description: jackpots widget is the only wordpress widget that give your site visitors live jackpots feeds

 * Author: Incomate
 * Author URI: http://www.incomate.com/
 */

	function activate(){
		$data = array( 'title' => 'jackpots widget', 'width' => '270px', 'height' => '150px');
	    if ( ! get_option('jackpotswidget')){
	      add_option('jackpotswidget' , $data);
	    } else {
	      update_option('jackpotswidget' , $data);
	    }
	}
	  
	function deactivate(){
		delete_option('jackpotswidget');
	}

	
	function control(){

		$data = get_option('jackpotswidget');
						
		?>
<p>
    <label>
        Title <input name="jackpotswidget_title"
		type="text" value=""<?php echo $data['title']; ?>" />
    </label>
</p>
<p>
    <label>
        Width <input name="jackpotswidget_width"
		type="text" value=""<?php echo $data['width']; ?>" />
    </label>
</p>
<p>
    <label>
        Height <input name="jackpotswidget_height"
		type="text" value=""<?php echo $data['height']; ?>" />
    </label>
</p>
<?php
		if (isset($_POST['jackpotswidget_title'])){
			$data['title'] = attribute_escape($_POST['jackpotswidget_title']);
			$data['width'] = attribute_escape($_POST['jackpotswidget_width']);
			$data['height'] = attribute_escape($_POST['jackpotswidget_height']);
			update_option('jackpotswidget', $data);
		}
		
	}
	
	function widget($args) {
		
		extract($args);
	  
	  	# Widget internal parameters
		$feeds_url = 'http://feeds.incomate.com/?type=7499&asf=aptc:23x1;configID:Full&geo=true';
		$default_width = '270px';
		$default_height; // Set a value here if you wanna ensure a minimum height
		$bottom_html = '<p style="font-size: x-small">
        <b><a href="http://www.gamblingmodules.com" target="_blank" title="gambling widgets">jackpots widget</a></b></p>'; // Set HTML content here
		
		# Get stored configuration parameters
		$instance = get_option('jackpotswidget');
		$title = empty($instance['title']) ? '&nbsp;' : $instance['title'];
		$width = empty($instance['width']) ? $default_width : $instance['width'];
		$height = empty($instance['height']) ? $default_height : $instance['height'];
		
		echo $before_widget;
		echo $before_title;?>jackpots widget<?php echo $after_title;
		echo '<iframe src="'.$feeds_url.'" width="'.$width;
		if ($height) echo '" height="'.$height;
		echo '" frameborder="0" marginheight="0px" marginwidth="0" scrolling="auto"><a href="'.$feeds_url.'">Hmm, you are using a very old browser. Click here to go directly to included content.</a>
			  </iframe>';
		echo $bottom_html;
		echo $after_widget;
	}

	
	/**
	* Register jackpots widget.
	*
	* Calls 'widgets_init' action after the Hello World widget has been registered.
	*/
	function jackpotswidgetInit() {
		register_sidebar_widget('jackpots widget', 'widget');
		register_widget_control('jackpots widget', 'control');
	}	
	add_action('widgets_init', 'jackpotswidgetInit');
	register_activation_hook( __FILE__, 'activate');
	register_deactivation_hook( __FILE__, 'deactivate');
?>
