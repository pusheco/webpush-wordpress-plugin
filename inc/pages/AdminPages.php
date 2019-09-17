<?php
/**
 * @package PusheWebpush
 */

namespace Inc\pages;

use \Inc\api\SettingsApi;
use \Inc\base\BaseController;
use Inc\api\callbacks\SettingsCallbacks;
use Inc\api\callbacks\ModalOptionsCallback;

class AdminPages extends BaseController
{
    public $settings;
    public $pages;
    public $subpages;

    public $settingsManager;
    public $settingsCallbacks;
    public $modalOptionsCallback;

    function __construct()
    {
        parent::__construct();

        $this->settings = new SettingsApi();

        $this->settingsCallbacks = new SettingsCallbacks();
        $this->modalOptionsCallback = new ModalOptionsCallback();

        $this->pages = array(
            array(
                'page_title' => 'Pushe Webpush Modal Options',
                'menu_title' => __('Pushe Webpush', 'pushe-webpush'),
                'capability' => 'manage_options',
                'menu_slug' => 'pushe_modal_options',
                'callback' => array($this->modalOptionsCallback, 'pusheModalOptionsPage'),
                'icon_url' => 'dashicons-portfolio',
                'position' => 70
            )
        );

        $this->subpages = array(
            array(
                'page_title' => 'Pushe Webpush Settings',
                'menu_title' => __('Settings', 'pushe-webpush'),
                'capability' => 'manage_options',
                'menu_slug' => 'pushe_settings',
                'callback' => array($this->settingsCallbacks, 'pusheSettingsPage'),
                'icon_url' => 'dashicons-portfolio',
                'position' => 70
            )
        );

        $this->settingsManager = SettingsFieldsBuilder::build();
    }

    function register()
    {
        $this->setSettings();
        $this->setSections();
        $this->setFields();

        $this->settings->addPage($this->pages)->withSubPage(__('Modal Options', 'pushe-webpush'))->addSubPages($this->subpages)->register();
    }

    function setSettings()
    {
        $args = array();

        foreach ($this->settingsManager as $key => $value) {
            array_push($args,
                array(
                    'option_group' => $value['option_group'],
                    'option_name' => $value['option_group'],
                    'callback' => $value['sanitizeCallback'],
                )
            );
        }

        $this->settings->setSettings($args);
    }

    function setSections()
    {
        $args = array(
            array(
                'id' => 'pushe_settings_section',
                'title' => __('Settings', 'pushe-webpush'),
                'callback' => array($this->settingsCallbacks, 'pusheSettingsSection'),
                'page' => 'pushe_settings'
            ),
            array(
                'id' => 'pushe_modal_options_section',
                'title' => __('Modal Options', 'pushe-webpush'),
                'callback' => array($this->modalOptionsCallback, 'pusheModalOptionsSection'),
                'page' => 'pushe_modal_options',
            ),
        );

        $this->settings->setSections($args);
    }

    function setFields()
    {
        $args = array();

        foreach ($this->settingsManager as $key => $value) {
            array_push($args, array(
                'id' => $key,
                'title' => $value['title'],
                'callback' => $value['inputCallback'],
                'page' => $value['page'],
                'section' => $value['section'],
                'args' => array(
                    'label_for' => $key,
                    'class' => 'pushe-field',
                    'type' => isset($value['inputType']) ? $value['inputType'] : 'text',
                    'title' => $value['title'],
                    'db_group' => $value['option_group'],
                    'options' => isset($value['options']) ? $value['options'] : null,
                    'placeholder' => isset($value['placeholder']) ? $value['placeholder'] : null,
                )
            ));
        }

        $this->settings->setFields($args);
    }
}