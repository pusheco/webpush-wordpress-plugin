<?php
/**
 * @package PusheWebpush
 */

namespace Inc\base;

use Inc\base\BaseController;

class WebpushScripts extends BaseController
{
    public $pushe_webpush_settings;
    public $pushe_webpush_modal_options;
    public $webpush_enabled = true;

    public $service_worker;
    public $service_worker_dest;

    public function __construct()
    {
        parent::__construct();

        $this->pushe_webpush_settings = get_option('pushe_webpush_settings', array());
        $this->pushe_webpush_modal_options = get_option('pushe_webpush_modal_options', array());

        $this->webpush_enabled = boolval($this->getSettingValue('webpush_enabled'));

        $this->service_worker = $this->plugin_path . "assets/pushe-sw.js";
        $this->service_worker_dest = ABSPATH . "pushe-sw.js";
    }

    public function register()
    {
        add_action('wp_footer', array($this, 'registerWebpushScripts'));

        $this->attachServiceWorker();
    }

    public function attachServiceWorker()
    {
        if (!file_exists($this->service_worker_dest) and is_ssl()) {
            copy($this->service_worker, $this->service_worker_dest);
        }
    }

    private function getCurrentPageNumber() {
        if (is_page()) {
            $pageNumber = -1; // If we couldn't find the page number then return -1

            if (isset($_GET['page_id'])) {
                $pageNumber = (string) $_GET['page_id'];
            }

            if (get_query_var('pagename') !== null) {
                $postObj = get_page_by_path(get_query_var('pagename'));
                if (isset($postObj->ID)) {
                    $pageNumber = (string) $postObj->ID;
                }
            }

            return $pageNumber;
        } else {
            // When it's the blog or it's a post
            $post = get_post();

            if (isset($post->ID)) {
                return (string) $post->ID;
            }

            return -1; // Means we couldn't find the page number
        }
    }

    private function shouldShowWebpush() {
        $pagesNotToShow = $this->getSettingValue('pages_not_to_show');
        $pagesToShow = $this->getSettingValue('pages_to_show');

        $pagesNotToShowArray = (isset($pagesNotToShow) & $pagesNotToShow !== "") ? preg_split("/[\s,]+/", $pagesNotToShow) : null;
        $pagesToShowArray = (isset($pagesToShow) & $pagesToShow !== "") ? preg_split("/[\s,]+/", $pagesToShow) : null;

        $currentPage = $this->getCurrentPageNumber();

        if ($currentPage !== -1 && $pagesToShowArray !== null) { // Pages To show has priority over pages not to show
            if (!in_array($currentPage, $pagesToShowArray)) {
                return false; // If current page is not in the array of pages to show then return function
            }
        } else if ($currentPage !== -1 && $pagesNotToShowArray !== null)  {
            if (in_array($currentPage, $pagesNotToShowArray)) {
                return false; // if current page is in the array of pages not to show then return function
            }
        }

        return true;
    }

    public function registerWebpushScripts()
    {
        if (!$this->shouldShowWebpush()) {
            return; // Prevent showing webpush, does not echo script in the body
        }

        $appId = $this->getSettingValue('app_id');
        $showDialog = $this->getModalOptionsValue('showDialog');
        $showDialog = boolval($showDialog) ? 'true' : 'false';
        $title = $this->getModalOptionsValue('title');
        $content = $this->getModalOptionsValue('content');
        $acceptText = $this->getModalOptionsValue('acceptText');
        $rejectText = $this->getModalOptionsValue('rejectText');
        $position = $this->getModalOptionsValue('position');
        $mobilePosition = $this->getModalOptionsValue('mobilePosition');
        $dialogRetryRate = $this->getModalOptionsValue('dialogRetryRate');
        $direction = $this->getModalOptionsValue('dialogDirection');

        $output = '<script src="https://static.pushe.co/pusheweb.js"></script>';
        $output .= '<script>Pushe.init("' . $appId . '");';
        $output .= 'var options={';
        $output .= 'showDialog:' . $showDialog;
        if (boolval($title)) {
            $output .= ',title:' . '"' . addslashes($title) . '"';
        }
        if (boolval($content)) {
            $output .= ',content:' . '"' . addslashes($content) . '"';
        }
        if (boolval($acceptText)) {
            $output .= ',acceptText:' . '"' . addslashes($acceptText) . '"';
        }
        if (boolval($rejectText)) {
            $output .= ',rejectText:' . '"' . addslashes($rejectText) . '"';
        }
        if (boolval($position)) {
            $output .= ',position:' . '"' . $position . '"';
        }
        if (boolval($mobilePosition)) {
            $output .= ',mobilePosition:' . '"' . $mobilePosition . '"';
        }
        if (boolval($dialogRetryRate)) {
            $output .= ',dialogRetryRate:' . $dialogRetryRate;
        }
        if (boolval($direction)) {
            $output .= ',direction:' . '"' . $direction . '"';
        }
        $output .= '};';
        $output .= 'Pushe.subscribe(options);</script>';

        if ($this->webpush_enabled) {
            echo $output;
        }
    }

    public function getSettingValue($key)
    {
        if (isset($this->pushe_webpush_settings)) {
            return isset($this->pushe_webpush_settings[$key]) ? $this->pushe_webpush_settings[$key] : null;
        }
    }

    public function getModalOptionsValue($key)
    {
        if (isset($this->pushe_webpush_modal_options)) {
            return isset($this->pushe_webpush_modal_options[$key]) ? $this->pushe_webpush_modal_options[$key] : null;
        }
    }
}