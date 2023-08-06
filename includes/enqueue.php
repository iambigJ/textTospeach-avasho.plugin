<?php
namespace avashoo;
class Enqueuecss {
    public static function blocks($avasho_url) {
        // Use a closure to pass $avasho_url to avasho_enqueue_js function
        add_action('enqueue_block_editor_assets', function () use ($avasho_url) {
            // Register the stylesheet
            \wp_register_style('blockCss', $avasho_url . '/assets/metaboxes/metabox.css');
            \wp_enqueue_style('blockCss');
            \wp_register_script('blockjs', $avasho_url . '/assets/metaboxes/metabox_popup.js', array('jquery'), '1.0', true);
            \wp_enqueue_script('blockjs');



        });
    }
    public static function setting($avasho_url){
        add_action('admin_enqueue_scripts', function () use ($avasho_url) {
            // Register the stylesheet
            \wp_register_style('settingCss', $avasho_url . '/assets/settingFields/avashoSetting.css');
            \wp_enqueue_style('settingCss');
        });
    }

}