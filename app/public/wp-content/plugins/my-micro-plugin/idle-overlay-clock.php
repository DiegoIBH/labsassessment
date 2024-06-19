<?php
/*
Plugin Name:  idle overlay clock
Description:  Up on user idle this plugin will show a clock overlay
Version:      1.0
Author:       Diego Barros
*/

add_action('wp_enqueue_scripts', 'ioc_enqueue_scripts'); //Hook to the wp acction that calls our function.

function ioc_enqueue_scripts() {
    wp_enqueue_script('jquery');//We call the jquery library in to the plugin
    wp_enqueue_script('ioc-custom-script', plugin_dir_url(__FILE__) . 'idle-overlay-clock.js', array('jquery'), null, true);//We give name to our script, constructs URL dir that contains the js doc, array query loads the library first so its applied to our script, null is the where the version of the script should be and true is boolean value to apply it to the footer.
    wp_enqueue_style('ioc-custom-style', plugin_dir_url(__FILE__) . 'idle-overlay-clock.css');
    
}


add_action('wp_enqueue_scripts', 'ioc_localize_script');//Hook

function ioc_localize_script() {
    $title_nonce = wp_create_nonce( 'title_nonce' );
    $current_user = wp_get_current_user();// Instantiate the current user through the wp_get_current_user method, which is obtained from user.php.
    wp_localize_script('ioc-custom-script', 'ioc_user_data', array( // Pass the current user data to the script as an object, with the values contained in the array.
        'is_logged_in' => is_user_logged_in(), // request user status with the is_user_logged_in() method
        'user_name' => $current_user->display_name, // request user name with the display_name property
        'user_email' => $current_user->user_email   // request user email with the user_email property
    ));
    wp_localize_script('ioc-custom-script', 'custom_ajax', array(
        'ajax_url' => admin_url('admin-ajax.php'),
    ));
};

register_activation_hook(__FILE__, 'create_user_activity_table');

function create_user_activity_table() {
    global $wpdb;
    $table_name = $wpdb->prefix . 'user_activity';
    
    $charset_collate = $wpdb->get_charset_collate();
    
    $sql = "CREATE TABLE $table_name (
        id mediumint(9) NOT NULL AUTO_INCREMENT,
        user_name varchar(255) NOT NULL,
        timestamp datetime DEFAULT CURRENT_TIMESTAMP NOT NULL,
        PRIMARY KEY  (id)
    ) $charset_collate;";
    
    require_once(ABSPATH . 'wp-admin/includes/upgrade.php');
    dbDelta($sql);
};

add_action('wp_ajax_store_user_activity', 'store_user_activity');

function store_user_activity() {
    if (!is_user_logged_in()) {
        wp_send_json_error('User not logged in');
        wp_die();
    }
    // $user = wp_get_current_user();
    $user_id = get_current_user_id();
    $timestamp = current_time('mysql');
    
    global $wpdb;
    $table_name = $wpdb->prefix . 'user_activity';
    
    $inserted = $wpdb->insert(
        $table_name,
        array(
            'user_id' => $user_id,
            'timestamp' => $timestamp,
        ),
        array(
            '%d',
            '%s',
        )
    );
    if ($inserted === false) {  // narrowing down debugging to find if the problem comes from the database data insertion.
        $wpdb_error = $wpdb->last_error;
        error_log("Insert failed: " . $wpdb_error);
        wp_send_json_error('Insert failed: ' . $wpdb_error);
    } else {
        wp_send_json_success('Activity recorded');
    };
    wp_die();
};   

