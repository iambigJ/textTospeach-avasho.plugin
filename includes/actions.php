<?php
namespace avashoo;
require_once __DIR__ . '/../vendor/autoload.php';
use avashoo\embedToPost;

class Actions {
    private $post_meta;
    private $post_id;
    private $gender;
    public function __construct() {
        add_action('wp', [$this, 'check_for_metakey']);
    }

    public function check_for_metakey() {
        if (is_singular()) {
            $this->post_id = get_the_ID();
            $this->post_meta = get_post_meta($this->post_id);
            $this->gender = isset($this->post_meta['gender']) ? $this->post_meta['gender'] : '1';

            if (isset($this->post_meta['avasho_fistID'][0])) {

                if (isset($this->post_meta['avasho_mp3Url'][0])) {
                    $this->addToPost();
                } else {

                    $api_id = $this->post_meta['avasho_fistID'][0];
                    $getObject = new getMp3Url($api_id);
                    $result =  $getObject->result();

                    if (isset($result['status']) && $result['status'] === "success" && isset($result['data']['result']['aiResult'])) {
                        // Store the mp3 URL in the post meta 'avasho_mp3Url'
                        $mp3Url = $result['data']['result']['aiResult'];
                        update_post_meta($this->post_id, 'avasho_mp3Url', $mp3Url);
                    }
                        // Handle the case when the getMp3Url call is not successful

                }
            }
        }
    }
    public function addToPost(){
        $gender = $this->gender ;
        $post_id = $this->post_id;
        $postAction = new embedToPost($post_id,$gender);
    }
}