<?php
/*
Plugin Name: TWC Shortcode
Text Domain: twc-shortcode
Plugin URI: http://github.com/oceanic
Description: Add shortcod generator for links to buyflow process.
Author: Rob Bertholf
Author URI: http://rob.bertholf.com/
Version: 1.0

License: CF Commercial-to-GPL License
Copyright 2015 Rob Bertholf
This License is a legal agreement between You and the Developer for the use of the Software. 
By installing, copying, or otherwise using the Software, You agree to be bound by the terms of this License. 
If You do not agree to the terms of this License, do not install or use the Software.
See license.txt for full details.
*/

/*
 * Shortcode Generator
 */

	// Hooks your functions into the correct filters
	function twc_add_mce_button() {
		// check user permissions
		if ( !current_user_can( 'edit_posts' ) && !current_user_can( 'edit_pages' ) ) {
			return;
		}
		// check if WYSIWYG is enabled
		if ( 'true' == get_user_option( 'rich_editing' ) ) {
			add_filter( 'mce_external_plugins', 'twc_add_tinymce_plugin' );
			add_filter( 'mce_buttons', 'twc_register_mce_button' );
		}
	}
	add_action('admin_head', 'twc_add_mce_button');

	// Declare script for new button
	function twc_add_tinymce_plugin( $plugin_array ) {
		$plugin_array['twc_mce_button'] = plugin_dir_url( __FILE__ ) . 'js/mce-button.js';
		return $plugin_array;
	}

	// Register new button in the editor
	function twc_register_mce_button( $buttons ) {
		array_push( $buttons, 'twc_mce_button' );
		return $buttons;
	}


/*
 * Convert to Button
 */

	// Assign shortcodes
	add_shortcode( 'twc', 'twc_cta_shortcode' );
		function twc_cta_shortcode( $atts ) {
			$atts = shortcode_atts( array(
				'type' => '',
				'target' => '',
				'title' => '',
				'iid' => '',
				'button' => '',
			), $atts );

			$type = $atts['type'];
			$target = $atts['target'];
			$title = $atts['title'];
			$iid = $atts['iid'];
			$button = $atts['button'];

			if ($target == 'modal') {
				$href = "data-toggle=\"modal\" data-target=\"#start-shopping\"";
			} else {
				$href = "href='https://www.timewarnercable.com/residential/order?type={$type}&iid={$iid}:1:2:existing'";
			}

			if ($button == 'ordernow') {
				return "<a {$href} title='{$title}' onclick=\"ga('send', 'event', 'button', '{$type}', '{$iid}');\"><img src=\"http://www.oceanic.com/wp-content/uploads/2014/05/OrderNow.png\" alt=\"{$title}\" width=\"109\" height=\"30\"></a>";
			} else {
				return "<a {$href} title='{$title}'>{$title}</a>";
			}
		}

?>