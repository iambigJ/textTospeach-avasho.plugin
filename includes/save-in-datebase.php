<?php

class Saveandremove
{
    public function __construct() {
        add_action('save_avasho_meta_gender',[$this,'save_meta_gender'],30,2);
        add_action('save_avasho_metaid', [$this, 'sendToMe'],40 );
        add_action('remove_avasho_metaid', [$this, 'removeJKey'],31 );
    }

    public function sendToMe($post_ID) {
        delete_post_meta($post_ID, 'avasho_post_first');

        delete_post_meta($post_ID, 'avasho_post_final');
        // this file adds a column in the postmeta in the database with the value of the first ID and the key of the API key
        require avasho_dir . 'api/post.php';
    }

    public function removeJKey($post_ID) {
        delete_post_meta($post_ID, 'avasho_post_fistID');
        delete_post_meta($post_ID, 'avasho_post_final');
    }
    public function save_meta_gender($post_ID,$gender){
        update_post_meta(
            $post_ID,
            'gender',
            $gender
        );
    }
}
$sendAndRemove = new Saveandremove;