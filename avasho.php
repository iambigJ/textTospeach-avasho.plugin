<?php
/*
 * Plugin Name: avashoo
 * Plugin URI: https://hooshio.com
 * Description: avasho for partdp
 * Version: 1.0.0
 * Author : alij
 * Domain Patch: /languages
 */


define('avasho_dir',plugin_dir_path(__FILE__));
define('avasho_url',plugin_dir_url(__FILE__));
define('avasho_api_key',(get_option('avasho_setting')['api_key']));



require avasho_dir . 'includes/add-metabox.php';
require avasho_dir . 'includes/add_setting_field.php';
require avasho_dir . 'includes/save-in-datebase.php';
require avasho_dir . 'includes/actions.php';
require avasho_dir . 'includes/add-mp3-to-post.php';
require avasho_dir . 'asests/test-async.php';



add_action( 'admin_enqueue_scripts', 'my_enqueue_scripts' ,-1 );
function my_enqueue_scripts() {
    // Enqueue your JavaScript file
    wp_enqueue_script( 'my-script', avasho_url . 'asests/alert.js', array( 'jquery' ), '1.0.0', true );
    // Localize the script with the AJAX URL and action
    wp_localize_script( 'my-script', 'my_ajax_object', array(
        'ajax_url' => admin_url( 'admin-ajax.php' ),
        'action'   => 'error_handeling'
    ) );

}
