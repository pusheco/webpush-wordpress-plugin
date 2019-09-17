<?php

/**
 * Trigger this when uninstall plugin
 *
 * @package PusheWebpush
 */

if (!defined('WP_UNINSTALL_PLUGIN')) {
    die;
}

delete_option('pushe_webpush_settings');
delete_option('pushe_webpush_modal_options');