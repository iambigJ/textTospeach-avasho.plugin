<?php
namespace avashoo;
require_once __DIR__ . '/../vendor/autoload.php';
use avashoo\GrapToPost;

class actions {

    public function __construct() {
        add_action('wp', [$this, 'check_for_metakey']);
    }
    public function delete_metakey($post_id){
        delete_post_meta( $post_id, 'avasho_fistID' );


    }
    public function check_for_metakey() {
        if (is_singular()) {
            $post_id = get_the_ID();
            if ($post_id) {
                $avasho_post_first_id = get_post_meta($post_id);


                if (!empty($avasho_post_first_id) && !empty($avasho_post_final)) {
                    new GrapToPost();
                } elseif (!empty($avasho_post_first_id)) {
                    $this->get_avasho($avasho_post_first_id);
                }
            }
        }
    }

    // Add your `add_mp3` and `get_avasho` functions here if they are missing.
}