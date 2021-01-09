<?php
/*
Plugin Name: KSA_registerOnline
Description: A dedicated plugin for "MizbanPayamak" to register online
Author: koorosh safe ashrafi
Version: 1.0
*/

# installer
register_activation_hook(__file__, 'installer');
function installer(){
    include(dirname(__FILE__).'/class.queries.php');
    $queries = new Queries();
    $queries->installer();
}

# add items to primary menu
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

# add styles or scripts
add_action( 'init','assets');
function assets() {
    wp_register_style('ksa_register_online_style', plugins_url('style.css',__FILE__ ));
    wp_enqueue_style('ksa_register_online_style');

    // wp_enqueue_script('jquery');
    
    wp_register_script( 'sms_script', plugins_url('script.js',__FILE__ ));
    wp_enqueue_script('sms_script');
}

# setting menu 
add_action("admin_menu", "cspd_imdb_options_submenu");
function cspd_imdb_options_submenu() {
    add_submenu_page('options-general.php', 'KSA Register Online', 'Register Online', 'administrator', 'KSA-Register-Online', 'registerOnline' );
}

function registerOnline() {
    include(dirname(__FILE__).'/class.queries.php');
    $queries = new Queries();
    if (sizeof($_POST)>0) {        
        $KSA_registerOnline_Username = $_POST["KSA_registerOnline_Username"];
        $KSA_registerOnline_Password = $_POST["KSA_registerOnline_Password"];
        $KSA_registerOnline_PackageId = $_POST["KSA_registerOnline_PackageId"];
        $queries->update_setting($KSA_registerOnline_Username,$KSA_registerOnline_Password,$KSA_registerOnline_PackageId);
    }
    $setting = $queries->get_setting();
    require 'settingForm.php';
}

# define ajax api
function sginin() {
    if (isset($_POST['ksa-name']) && isset($_POST['ksa-family']) && isset($_POST['ksa-mobile'])) {
        if (!preg_match('/^09[0-9]{9}$/', $_POST['ksa-mobile'])) {
            echo '12';
            exit();
        }

        include(dirname(__FILE__).'/class.queries.php');
        $queries = new Queries();
        $setting = $queries->get_setting();
        
        $params = array();
        foreach ($setting as $s) {
            switch ($s->option_name) {
                case 'KSA_registerOnline_Username':
                    $params['username'] = $s->option_value;
                    break;
                case 'KSA_registerOnline_Password':
                    $params['password'] = $s->option_value;
                    break;
                case 'KSA_registerOnline_PackageId':
                    $params['packageId'] = $s->option_value;
                    break;
                default:
                    header('HTTP/1.0 403 Forbidden', true, 403);
                    die('Something Wrong!');
                    break;
            }
        }
        $params['name'] = $_POST['ksa-name'];
        $params['family'] = $_POST['ksa-family'];
        $params['mobileNumber'] = $_POST['ksa-mobile'];

        $curl = curl_init();
        curl_setopt_array($curl, array(
            CURLOPT_URL => 'http://my.mizbansms.ir/wssms.asmx/registerOnline',
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'POST',
            CURLOPT_POSTFIELDS => http_build_query($params),
            CURLOPT_HTTPHEADER => array(
                'Content-Type: application/x-www-form-urlencoded'
            ),
        ));
        $response = curl_exec($curl);
        curl_close($curl);

        $response = simplexml_load_string($response);
        $response = json_decode($response);
        
        echo $response;
        exit();
    } else {
        header('HTTP/1.0 403 Forbidden', true, 403);
        die('Forbidden');
    }
}
add_action( 'wp_ajax_nopriv_sginin', 'sginin');  
add_action( 'wp_ajax_sginin', 'sginin');