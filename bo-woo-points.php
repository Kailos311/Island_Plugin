<?php
/**
Plugin Name: Woocommerce Scan Points
Plugin URI: https://bosoftvn.com
Description: 
Version: 1.0
Author: Dung Johnny
Author URI: https://bosoftvn.com
License: GPLv2 or later
Text Domain: bowsp
*/
define('BOWSP_DIR', plugin_dir_path( __FILE__ ));
define('BOWSP_URI', plugin_dir_url(__FILE__));
define('POINTS_UPDATE_LEVEL', 100); 
 
require_once( BOWSP_DIR . '/inc/payment-gateway.php' );
require_once( BOWSP_DIR . '/inc/functions.php' );