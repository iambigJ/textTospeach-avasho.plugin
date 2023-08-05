<?php
namespace avashoo;
class Enqueuecss {
    public static function init($avasho_url) {
        // Use a closure to pass $avasho_url to avasho_enqueue_js function
        add_action('enqueue_block_editor_assets', function () use ($avasho_url) {
            // Register the stylesheet
            \wp_register_style('blockCss', $avasho_url . '/assets/metaboxes/metabox.css');
            \wp_enqueue_style('blockCss');
        });
    }
}