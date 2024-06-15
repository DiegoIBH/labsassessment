<?php
/*
Plugin Name:  idle overlay clock
Description:  Up on user idle this plugin will show a clock overlay
Version:      1.0
Author:       Diego Barros
*/

function ioc_enqueue_scripts() {
    wp_enqueue_script('jquery');//We call the jquery library in to the plugin
    wp_enqueue_script('ioc-custom-script', plugin_dir_url(__FILE__) . 'idle-overlay-clock.js', array('jquery'), null, true);//We give name to our script, constructs URL dir that contains the js doc, array query loads the library first so its applied to our script, null is the where the version of the script should be and true is boolean value to apply it to the footer.
    
}

add_action('wp_enqueue_scripts', 'ioc_enqueue_scripts'); //Hook to the wp acction that calls our fucntion.

