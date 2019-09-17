<?php
/**
 * @package PusheWebpush
 */

namespace Inc\api;

use InvalidArgumentException;

class SettingsApi
{
    public $admin_pages = array();
    public $admin_subpages = array();
    public $settings = array();
    public $sections = array();
    public $fields = array();

    public function register()
    {
        if (!empty($this->admin_pages)) {
            add_action('admin_menu', array($this, 'addAdminMenu'));
        }

        if (!empty($this->settings)) {
            add_action('admin_init', array($this, 'registerCustomFields'));
        }
    }

    public function addPage($pages)
    {
        if (!is_array($pages)) {
            throw new InvalidArgumentException("Argument of SettingsApi.addPage expects to be an array but you specified a/an " . gettype($pages));
        }

        $this->admin_pages = $pages;

        return $this;
    }

    public function withSubPage($title = null)
    {
        if (empty($this->admin_pages)) {
            return $this;
        }

        $admin_page = $this->admin_pages[0];

        $subpage = array(
            array(
                'parent_slug' => $admin_page['menu_slug'],
                'page_title' => $admin_page['page_title'],
                'menu_title' => isset($title) ? $title : $admin_page['menu_title'],
                'capability' => $admin_page['capability'],
                'menu_slug' => $admin_page['menu_slug'],
                'callback' => '',
            )
        );

        $this->admin_subpages = $subpage;

        return $this;
    }

    public function addSubPages($pages)
    {
        if (!is_array($pages)) {
            throw new InvalidArgumentException("Argument of SettingsApi.addPage expects to be an array but you specified a/an " . gettype($pages));
        }

        $this->admin_subpages = array_merge($this->admin_subpages, $pages);

        return $this;
    }

    public function addAdminMenu()
    {
        foreach ($this->admin_pages as $page) {
            add_menu_page(
                $page['page_title'],
                $page['menu_title'],
                $page['capability'],
                $page['menu_slug'],
                $page['callback'],
                $page['icon_url'],
                $page['position']
            );
        }

        foreach ($this->admin_subpages as $page) {
            add_submenu_page(
                $this->admin_pages[0]['menu_slug'],
                $page['page_title'],
                $page['menu_title'],
                $page['capability'],
                $page['menu_slug'],
                $page['callback']
            );
        }
    }

    public function setSettings($settings)
    {
        $this->settings = $settings;

        return $this;
    }

    public function setSections($sections)
    {
        $this->sections = $sections;

        return $this;
    }

    public function setFields($fields)
    {
        $this->fields = $fields;

        return $this;
    }

    public function registerCustomFields()
    {
        // register setting
        foreach ($this->settings as $setting) {
            register_setting($setting['option_group'], $setting['option_name'], (isset($setting['callback']) ? $setting['callback'] : ''));
        }

        // add settings section
        foreach ($this->sections as $section) {
            add_settings_section($section['id'], $section['title'], (isset($section['callback']) ? $section['callback'] : ''), $section['page']);
        }

        // add settings field
        foreach ($this->fields as $field) {
            add_settings_field($field['id'], $field['title'], (isset($field['callback']) ? $field['callback'] : ''),
                $field['page'], $field['section'], (isset($field['args']) ? $field['args'] : ''));
        }
    }
}