<?php
/*
Plugin Name: OneSignal Push Notifications for Android and iOS
Plugin URI: http://docs.appalliance.co.za
Description: Simple plugin to send one time push notifications from the wordpress dashboard via the OneSignal REST API. Configure with OneSignal API key and APP ID.
Version: 0.0.1
Author: AppAlliance
Author URI: http://www.appalliance.co.za/
License: GPLv2 or later
License URI: https://www.gnu.org/licenses/gpl-2.0.html
*/


function oswpa_initial_install() {

    add_option( 'oswpa_onesignal_api', 'Your API key here' );
    add_option( 'oswpa_onesignal_id', 'Your app ID here' );
}

register_activation_hook( __FILE__, 'rwp_initial_install' );



add_action('admin_menu', 'oswpa_add_pages');

    function oswpa_add_pages() {



add_menu_page(
        'OneSignal Push',
        'OneSignal Push',
        'manage_options',
        'appalliance-wp-kit',
        'oswpa_dashboard_page',
        'dashicons-smartphone', 20
    );
add_submenu_page(
        'appalliance-wp-kit',
        'Dashboard',
        'Dashboard',
        'manage_options',
        'appalliance-wp-kit'
    );

add_submenu_page(
        'appalliance-wp-kit',
        'One time notification',
        'One time notification',
        'manage_options',
        'appalliance-onetime-page',
        'oswpa_onetime_page'
    );


add_submenu_page(
        'appalliance-wp-kit',
        'Config',
        'Config',
        'manage_options',
        'appalliance-config',
        'oswpa_config_page'
    );




    add_action( 'admin_init', 'onesignal_config_settings' );
}

function onesignal_config_settings() {

        register_setting( 'oswpa-config-fields', 'oswpa_onesignal_api' );
        register_setting( 'oswpa-config-fields', 'oswpa_onesignal_id' );

    }

function oswpa_add_media_admin_styles() {
    wp_enqueue_style('thickbox');
    wp_enqueue_style( 'oswpa_styles', plugins_url('oswpa_styles.css', __FILE__) );
    }

add_action('admin_print_styles', 'oswpa_add_media_admin_styles');

add_action( 'admin_head', 'welcome_screen_remove_menus', 9999 );

function welcome_screen_remove_menus() {
    remove_submenu_page( 'appalliance-wp-kit', 'appalliance-onetime-page' );
}


include('oswpa_config.php');
include('oswpa_dashboard.php');
include('oswpa_onetime.php');

?>
