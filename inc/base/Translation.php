<?php
/**
 * @package PusheWebpush
 */

namespace Inc\base;

class Translation
{
    public function register()
    {
        load_plugin_textdomain('pushe-webpush', false, "pushe-webpush/languages");
    }
}