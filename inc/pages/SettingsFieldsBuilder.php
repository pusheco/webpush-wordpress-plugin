<?php
/**
 * @package PusheWebpush
 */

namespace Inc\pages;

use Inc\api\callbacks\SettingsCallbacks;
use Inc\api\callbacks\ModalOptionsCallback;

class SettingsFieldsBuilder
{
    public static $settings_group = 'pushe_webpush_settings';
    public static $modal_options_group = 'pushe_webpush_modal_options';

    public static function build()
    {
        $settingsCallbacks = new SettingsCallbacks();
        $modalOptionsCallback = new ModalOptionsCallback();
        
        $items = array(
            'app_id' => array(
                'title' => __('app id', 'pushe-webpush'),
                'placeholder' => 'app id',
                'option_group' => self::$settings_group,
                'sanitizeCallback' => array($settingsCallbacks, 'inputSanitize'),
                'inputCallback' => array($settingsCallbacks, 'handleSettingsInput'),
                'page' => 'pushe_settings',
                'section' => 'pushe_settings_section',
            ),
            'webpush_enabled' => array(
                'title' => __('enable webpush', 'pushe-webpush'),
                'placeholder' => 'enable webpush',
                'option_group' => self::$settings_group,
                'sanitizeCallback' => array($settingsCallbacks, 'inputSanitize'),
                'inputCallback' => array($settingsCallbacks, 'handleSettingsInput'),
                'page' => 'pushe_settings',
                'inputType' => 'checkbox',
                'section' => 'pushe_settings_section',
            ),
            'pages_not_to_show' => array(
                'title' => __('Do not show in these pages', 'pushe-webpush'),
                'placeholder' => '1,2,3,4',
                'option_group' => self::$settings_group,
                'sanitizeCallback' => array($settingsCallbacks, 'inputSanitize'),
                'inputCallback' => array($settingsCallbacks, 'handleSettingsInput'),
                'page' => 'pushe_settings',
                'section' => 'pushe_settings_section',
            ),
            'pages_to_show' => array(
                'title' => __('Only show in these pages', 'pushe-webpush'),
                'placeholder' => '1,2,3,4',
                'option_group' => self::$settings_group,
                'sanitizeCallback' => array($settingsCallbacks, 'inputSanitize'),
                'inputCallback' => array($settingsCallbacks, 'handleSettingsInput'),
                'page' => 'pushe_settings',
                'section' => 'pushe_settings_section',
            ),


            'showDialog' => array(
                'title' => __('show dialog', 'pushe-webpush'),
                'placeholder' => 'show dialog',
                'option_group' => self::$modal_options_group,
                'sanitizeCallback' => array($modalOptionsCallback, 'inputSanitize'),
                'inputCallback' => array($modalOptionsCallback, 'handleSettingsInput'),
                'page' => 'pushe_modal_options',
                'inputType' => 'checkbox',
                'section' => 'pushe_modal_options_section',
            ),
            'title' => array(
                'title' => __('title', 'pushe-webpush'),
                'placeholder' => 'title',
                'option_group' => self::$modal_options_group,
                'sanitizeCallback' => array($modalOptionsCallback, 'inputSanitize'),
                'inputCallback' => array($modalOptionsCallback, 'handleSettingsInput'),
                'page' => 'pushe_modal_options',
                'section' => 'pushe_modal_options_section',
            ),
            'content' => array(
                'title' => __('content', 'pushe-webpush'),
                'placeholder' => 'content',
                'option_group' => self::$modal_options_group,
                'sanitizeCallback' => array($modalOptionsCallback, 'inputSanitize'),
                'inputCallback' => array($modalOptionsCallback, 'handleSettingsInput'),
                'page' => 'pushe_modal_options',
                'section' => 'pushe_modal_options_section',
            ),
            'acceptText' => array(
                'title' => __('accept text', 'pushe-webpush'),
                'placeholder' => 'accept text',
                'option_group' => self::$modal_options_group,
                'sanitizeCallback' => array($modalOptionsCallback, 'inputSanitize'),
                'inputCallback' => array($modalOptionsCallback, 'handleSettingsInput'),
                'page' => 'pushe_modal_options',
                'section' => 'pushe_modal_options_section',
            ),
            'rejectText' => array(
                'title' => __('reject text', 'pushe-webpush'),
                'placeholder' => 'reject text',
                'option_group' => self::$modal_options_group,
                'sanitizeCallback' => array($modalOptionsCallback, 'inputSanitize'),
                'inputCallback' => array($modalOptionsCallback, 'handleSettingsInput'),
                'page' => 'pushe_modal_options',
                'section' => 'pushe_modal_options_section',
            ),
            'icon' => array(
                'title' => __('icon', 'pushe-webpush'),
                'placeholder' => 'icon',
                'option_group' => self::$modal_options_group,
                'sanitizeCallback' => array($modalOptionsCallback, 'inputSanitize'),
                'inputCallback' => array($modalOptionsCallback, 'handleSettingsInput'),
                'page' => 'pushe_modal_options',
                'section' => 'pushe_modal_options_section',
            ),
            'position' => array(
                'title' => __('dialog position', 'pushe-webpush'),
                'placeholder' => 'dialog position',
                'option_group' => self::$modal_options_group,
                'sanitizeCallback' => array($modalOptionsCallback, 'inputSanitize'),
                'inputCallback' => array($modalOptionsCallback, 'handleSettingsInput'),
                'page' => 'pushe_modal_options',
                'section' => 'pushe_modal_options_section',
                'inputType' => 'select',
                'options' => array(
                    'top-left', 'top-center', 'top-right', 'bottom-left', 'bottom-center', 'bottom-right',
                ),
            ),
            'mobilePosition' => array(
                'title' => __('dialog position in mobile', 'pushe-webpush'),
                'placeholder' => 'dialog position in mobile',
                'option_group' => self::$modal_options_group,
                'sanitizeCallback' => array($modalOptionsCallback, 'inputSanitize'),
                'inputCallback' => array($modalOptionsCallback, 'handleSettingsInput'),
                'page' => 'pushe_modal_options',
                'section' => 'pushe_modal_options_section',
                'inputType' => 'select',
                'options' => array(
                    'top', 'bottom',
                ),
            ),
            'dialogRetryRate' => array(
                'title' => __('dialog retry time', 'pushe-webpush'),
                'placeholder' => 'dialog retry time',
                'option_group' => self::$modal_options_group,
                'sanitizeCallback' => array($modalOptionsCallback, 'inputSanitize'),
                'inputCallback' => array($modalOptionsCallback, 'handleSettingsInput'),
                'page' => 'pushe_modal_options',
                'section' => 'pushe_modal_options_section',
            ),
        );
        
        return $items;
    }
    
}