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
    wp_enqueue_style('ioc-custom-style', plugin_dir_url(__FILE__) . 'idle-overlay-clock.css');
}

add_action('wp_enqueue_scripts', 'ioc_enqueue_scripts'); //Hook to the wp acction that calls our function.

function ioc_localize_script() {
    $current_user = wp_get_current_user();// Instantiate the current user through the wp_get_current_user wp method.
    wp_localize_script('ioc-custom-script', 'ioc_user_data', array( // Pass the current user data to the script as an object, with the values contained in the array.
        'is_logged_in' => is_user_logged_in(), // request user status with the is_user_logged_in() method
        'user_name' => $current_user->display_name, // request user name with the display_name property
        'user_email' => $current_user->user_email   // request user email with the user_email property
    ));
}

add_action('wp_enqueue_scripts', 'ioc_localize_script');//Hook