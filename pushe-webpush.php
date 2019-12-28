<?php
/**
 * @package PusheWebpush
 */
/*
 * Plugin Name: Pushe Webpush
 * Description: Official Pushe.co's webpush plugin for wordpress.
 * version: 0.4.3
 * Author: pushe.co
 * Author URI: https://pushe.co
 * License: GPL-3.0
 * License URI: https://www.gnu.org/licenses/gpl-3.0.txt
 * Text Domain: pushe-webpush
 * Domain Path: /languages
*/

defined('ABSPATH') or die('You cannot access this file!');

// Require once the Composer autoload
if (file_exists(dirname(__FILE__) . '/vendor/autoload.php')) {
    require_once(dirname(__FILE__) . '/vendor/autoload.php');
}

/**
 * Codes run during activation of the plugin
 */
function activate_pushe_webpush_plugin()
{
    Inc\base\Activate::activate();
}

register_activation_hook(__FILE__, 'activate_pushe_webpush_plugin');


/**
 * Codes run during deactivation of the plugin
 */
function deactivate_pushe_webpush_plugin()
{
    Inc\base\Deactivate::deactivate();
}

register_deactivation_hook(__FILE__, 'deactivate_pushe_webpush_plugin');


/**
 * Initialize all the core classes of the plugin
 */
if (class_exists('Inc\\Init')) {
    Inc\Init::register_services();
}
