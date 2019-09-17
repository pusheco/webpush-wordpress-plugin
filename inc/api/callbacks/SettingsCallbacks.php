<?php
/**
 * @package PusheWebpush
 */

namespace Inc\api\callbacks;

class SettingsCallbacks extends BaseCallbacks
{
    public function pusheSettingsPage()
    {
        return require_once($this->plugin_path . "templates/settings.php");
    }

    public function pusheSettingsSection()
    {
        $output = '<ul>';
        $output .= '<li><strong>'.esc_html__("* app id:", "pushe-webpush").'</strong> '.esc_html__("You should get your app_id from", "pushe-webpush").' <a href="https://console.pushe.co" target="_blank">'.esc_html__("Pushe.co's console", "pushe-webpush").'</a></li>';
        $output .= '<li>'.esc_html__("Only one of `Only show in these pages` or `Do not show in these pages` field would work.", "pushe-webpush").'</li>';
        $output .= '<li>'.esc_html__("To figure out how to find your page numbers, checkout ", "pushe-webpush").'<a href="https://pushe.co/docs/wordpress" target="_blank">'.esc_html__("our documentations", "pushe-webpush").'</a></li>';
        $output .= '</ul>';

        echo $output;
    }

    public function inputSanitize($input)
    {
        return $input;
    }

    public function handleSettingsInput($args)
    {
        parent::handleSettingsInput($args);
    }
}