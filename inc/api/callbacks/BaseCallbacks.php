<?php
/**
 * @package PusheWebpush
 */

namespace Inc\api\callbacks;

use Inc\base\BaseController;

class BaseCallbacks extends BaseController
{
    public function handleSettingsInput($args)
    {
        $name = $args['label_for'];
        $classes = $args['class'];
        $type = $args['type'];
        $placeholder = isset($args['placeholder']) ? $args['placeholder'] : $args['title'];
        $db_group = $args['db_group'];
        $input = get_option($db_group);
        $value = isset($input[$name]) ? $input[$name] : null;
        $groupedName = '' . $db_group . '[' . $name . ']';
        $options = isset($args['options']) ? $args['options'] : array();

        $output = '<div class="' . $classes . '">';
        if ($type == 'checkbox') { // switch
            $class = isset($value) ? "switch pw-switch active" : "switch pw-switch";

            $output .= '<label class="' . $class . '" for="pw_checkbox">';
            $output .= '<input';
            $output .= ' type="checkbox"';
            $output .= ' value="1"';
            $output .= ' id="pw_checkbox"';
            $output .= ' class="checkbox"';
            $output .= ' name="' . $groupedName . '"';
            $output .= ' />';
            $output .= '<span class="slider round"></span>';
            $output .= '</div>';
        } else if ($type == 'select') {
            $output .= '<select name="' . $groupedName . '">';
            foreach ($options as $val) {
                $isSelected = $value == $val;
                if($isSelected) {
                    $output .= '<option value="'.$val.'" selected>'.$val.'</option>';
                } else {
                    $output .= '<option value="'.$val.'">'.$val.'</option>';
                }
            }
            $output .= '</select>';
        } else {
            $output .= '<input';
            $output .= ' type="text"';
            $output .= ' value="' . $value . '"';
            $output .= ' class="' . $classes . '"';
            $output .= ' name="' . $groupedName . '"';
            $output .= ' placeholder="' . $placeholder . '"';
            $output .= ' />';
        }

        echo $output;
    }
}