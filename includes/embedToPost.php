<?php

namespace avashoo;
require_once __DIR__ . '/../vendor/autoload.php';
use avashoo\mp3Ui;
class embedToPost {
    private $place;
    private $postId;
    private $mp3_url;
    private $method;
    private $gender;
    private $position;
    private $action;

    private $skin;

    public function __construct($postId, $gender) {


        //$this->sking
        $this->postId = $postId;
        $this->mp3_url = get_post_meta($postId)['avasho_mp3Url'][0];
        $this->gender = $gender; // Corrected the variable name here.
        $this->position = $this->place === 'down' ? 'down' : 'up';
        $options = get_option('avasho_setting');
        [$this->place, $this->method] = [$options['avasho_setting_offset'], $options['avasho_setting_method']];
        $action = $this->method === 'add filter' ? 'add_filter' : 'add_action';
        $this->skin = 'skin1';
        //-- enqeueue the css and js
        add_action('wp_enqueue_scripts', function ()  {
            wp_enqueue_script('avasho_blob', avasho_url . 'assets/enqueueBlob.js', array('jquery'), '1.0', false);
            wp_localize_script('avasho_blob', 'myLocalizedData', ['ajaxurl' => $this->mp3_url]);

        },1);
        $action('the_content', [$this, 'modify_content'],10); // Corrected the filter hook.
    }
    public function modify_content($content) {

        $modified_content = $this->htmlpart();
        $main_content = $this->position == 'down' ? $content.$modified_content : $modified_content.$content;

        return $main_content; // Return the modified content.
    }
    public function htmlpart(){
        $x = new mp3Ui();
        $skin = $this->skin;
        $x = new mp3Ui();
        $htmlPart = $x->skin1();
        return $htmlPart;
    }



}