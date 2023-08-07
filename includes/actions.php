<?php
namespace avashoo;
require_once __DIR__ . '/../vendor/autoload.php';
use avashoo\getMp3Url;

class Actions {
    private $post_meta;
    public function __construct() {
        add_action('wp', [$this, 'check_for_metakey']);
    }
    public function check_for_metakey() {
        if (is_singular()) {
            $post_id = get_the_ID();
            $this->post_meta = get_post_meta($post_id);
            if (isset($this->post_meta['avasho_fistID'][0])){
                if (isset($this->post_meta['avasho_mp3Url'][0])){
                    echo 'class mp3 trigerd';
                    exit;
                }
                else{
                    $api_id =$this->post_meta['avasho_fistID'][0];
                    $result = new getMp3Url($api_id);
                    if (strlen($idlast) > 5 ) {
                        update_post_meta(
                            get_the_ID(),
                            'avasho_lastId',
                            "https://panel.iavasho.ir/backend/download/" . $idlast,
                        );
                    }
                }
            }
            return;

        }
    }

}
