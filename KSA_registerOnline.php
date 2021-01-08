<?php
/*
Plugin Name: KSA_registerOnline
Description: A dedicated plugin for "MizbanPayamak" to register online
Author: koorosh safe ashrafi
Version: 1.0
*/

add_filter( 'wp_nav_menu_items', 'add_loginout_link', 10, 2 );
function add_loginout_link( $items, $args ) {
    $is_user_logged_in = false;
    if ($is_user_logged_in && $args->theme_location == 'primary') {
        $items .= '<li class="ksa-sign-btn"><span>خروج</span></li>';
    }
    elseif (!$is_user_logged_in && $args->theme_location == 'primary') {
        $items .= '<li class="ksa-sign-btn"><span onclick="return ksa_popup(\'login\', \''.admin_url('admin-ajax.php').'?action=login\');">ورود</span></li>';
        $items .= '<li class="ksa-sign-btn"><span onclick="return ksa_popup(\'sginin\', \''.admin_url('admin-ajax.php').'?action=sginin\');">ثبت نام</span></li>';
    }
    return $items;
}

/*
* add styles or scripts
*/
function assets() {
	wp_register_style('ksa_register_online_style', plugins_url('style.css',__FILE__ ));
	wp_enqueue_style('ksa_register_online_style');

	// wp_enqueue_script('jquery');
	
	wp_register_script( 'sms_script', plugins_url('script.js',__FILE__ ));
	wp_enqueue_script('sms_script');
}
add_action( 'init','assets');



add_action("admin_menu", "cspd_imdb_options_submenu");
function cspd_imdb_options_submenu() {
    add_submenu_page('options-general.php', 'KSA Register Online', 'Register Online', 'administrator', 'KSA-Register-Online', 'registerOnline' );
}

function registerOnline() {
    if (sizeof($_POST)>0) {
        var_dump($_POST);
    }
    require 'settingForm.php';
}