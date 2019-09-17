<?php
/**
 * @package PusheWebpush
 */

namespace Inc\base;

use Inc\base\BaseController;

class Enqueue extends BaseController
{
    function register()
    {
        add_action('admin_enqueue_scripts', array($this, 'enqueue'));
    }

    function enqueue()
    {
        wp_enqueue_style('pusheWebpushStyles', $this->plugin_url . 'assets/pushe-webpush.css');
        wp_enqueue_script('pusheWebpushScripts', $this->plugin_url . 'assets/pushe-webpush.js');
    }
}