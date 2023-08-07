<?php

namespace avashoo;
class embedToPost {
    private $place;
    private $postId;
    private $mp3_url;
    private $method;
    private $gender;
    private $position;
    private $action;

    public function __construct($postId, $gender) {
        define('avasho_url',plugin_dir_url(__FILE__));
        $this->mp3_url = get_post_meta($postId)['avasho_mp3Url'][0];

        //--define the varibles
        $options = get_option('avasho_setting');
        [$this->place, $this->method] = [$options['avasho_setting_offset'], $options['avasho_setting_method']];
        $this->postId = $postId;
        $this->gender = $gender; // Corrected the variable name here.
        $action = $this->method === 'add filter' ? 'add_filter' : 'add_action';
        $this->position = $this->place === 'down' ? 'down' : 'up';
        //-- enqeueue the css and js
        add_action('wp_enqueue_scripts', function ()  {
            // Register the stylesheet
            wp_enqueue_script('avasho_blob', avasho_url . 'assets/enqueueBlob.js', array('jquery'), '1.0', false);
            wp_localize_script('avasho_blob', 'myLocalizedData', ['ajaxurl' => $this->mp3_url]);

        },20);

        $action('the_content', [$this, 'modify_content']); // Corrected the filter hook.

    }

    public function modify_content($content) {

        $modified_content = $this->htmlPart();
        $main_content = $this->position == 'down' ? $content.$modified_content : $modified_content.$content;
        return $this->mp3_url.$main_content; // Return the modified content.
    }
    public function htmlPart(){
        $audioElement = '<audio id="avashoMp3" controls>
    <source src="' . '#' . '" type="audio/mpeg">
    Your browser does not support the audio element.
</audio>';
        return $audioElement;

    }
}