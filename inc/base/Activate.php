<?php
/**
 * @package PusheWebpush
 */

namespace Inc\base;

use Inc\pages\SettingsFieldsBuilder;

class Activate
{
    public static function activate()
    {
        add_option(SettingsFieldsBuilder::$modal_options_group, array(
            'showDialog' => true,
            'position' => 'top-center'
        ));
    }
}