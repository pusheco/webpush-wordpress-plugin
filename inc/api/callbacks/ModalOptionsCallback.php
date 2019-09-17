<?php
/**
 * @package PusheWebpush
 */

namespace Inc\api\callbacks;

use Inc\base\BaseController;

class ModalOptionsCallback extends BaseCallbacks
{

    public function pusheModalOptionsPage()
    {
        return require_once($this->plugin_path . "templates/modalOptions.php");
    }

    public function pusheModalOptionsSection()
    {
        $output1 = esc_html__('These options are, available parameters of Pushe\'s webpush subscribe modal and All fields are optional, and modal would show default value for them.', 'pushe-webpush');
        $output2 = esc_html__('For more information you can check out the documentation at ', 'pushe-webpush');

        $output = '<p>' . $output1 . '</p>';
        $output .= '<p>' . $output2 . '<a href="https://pushe.co/docs/webpush/#subscribe_modal_settings">https://pushe.co</a>' . '</p>';

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