<?php
/**
 * @package PusheWebpush
 */

namespace Inc\base;

class BaseController
{
    public $plugin_path; // Has "/" at the end
    public $plugin_url; // Has "/" at the end
    public $plugin;

    function __construct()
    {
        $this->plugin_path = plugin_dir_path(dirname(dirname(__FILE__)));
        $this->plugin_url = plugin_dir_url(dirname(dirname(__FILE__)));
        $this->plugin =  plugin_basename(dirname(dirname(dirname(__FILE__))) . '/pushe-webpush.php');
    }
}