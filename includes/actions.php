<?php
class Audio_Functionality_Plugin {
    public function __construct() {
        add_action( 'wp', [ $this, 'check_for_metakey' ],19 );
        add_action( 'get_post_avasho', [$this, 'get_avasho' ],20 );
     }

    public function check_for_metakey() {
        if ( is_singular() ) {
            $postid = get_the_ID() ;
            $array_meta = get_post_meta( $postid );
            if ( array_key_exists( 'avasho_post_fistID', $array_meta ) ) {
                if ( array_key_exists( 'avasho_post_final', $array_meta ) ) {
	                $post_id = get_the_ID();
	                do_action( 'avasho_add_mp3',$post_id );
                } else {
                    do_action( 'get_post_avasho', $array_meta );
                }
            }
        }
    }
    public function get_avasho( $array_meta ) {
        require avasho_dir . 'services/get-url.php';

    }
}

new Audio_Functionality_Plugin();