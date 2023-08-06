<?php

namespace avashoo;
class GrapToPost {
    private $place;
    private $method;
    private $mp3_url;

    public function __construct() {
        $options = get_option('avasho_setting');
        [$this->place, $this->method] = [$options['avasho_setting_offset'], $options['avasho_setting_method']];
        add_action('avasho_add_mp3', [$this, 'add_mp3_to_post'], 99);
    }

    public function add_mp3_to_post($post_id) {
        $this->mp3_url = get_post_meta($post_id)['avasho_post_final'][0];
        add_action('wp_enqueue_scripts', [$this, 'add_avasho_styleSheet'], 50);

        $audio_player = '<div id="avasho-center"></div>';
        if ($this->place === 'down of the post') {
            $audio_player = '<div id="audio-container"></div>';
        }
        $action = $this->method === 'add filter' ? 'add_filter' : 'add_action';
        $position = $this->place === 'up of the post' ? 'the_content' : 'the_content';
        $action($position, [$this, $this->place === 'up of the post' ? 'action_up' : 'action_down']);
    }

    public function action_up($content) {
        $audio_player = '<div id="avasho-center"></div>';
        return $audio_player . $content;
    }

    public function action_down($content) {
        $audio_player = '<div id="audio-container"></div>';
        return $content . $audio_player;
    }

    public function add_avasho_styleSheet() {
        wp_enqueue_script('avasho_styleSheet', avasho_url . 'asests/enqueueBlob.js', array('jquery'), '1.0', false);
        wp_localize_script('avasho_styleSheet', 'myLocalizedData', ['ajaxurl' => $this->mp3_url]);
    }
}

$x = new GrapToPost();


