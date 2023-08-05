<?php
namespace avashoo;
class Audio_Functionality_Plugin {
    public function __construct() {
        add_action( 'wp', [ $this, 'check_for_metakey' ], 19 );
    }

    public function check_for_metakey() {
        if ( is_singular() ) {
            $post_id = get_the_ID();
            if ( $post_id ) {
                $avasho_post_first_id = get_post_meta( $post_id, 'avasho_post_fistID', true );
                $avasho_post_final = get_post_meta( $post_id, 'avasho_post_final', true );

                if ( isset( $avasho_post_first_id ) && isset( $avasho_post_final ) ) {
                    $this->add_mp3( $post_id );
                } elseif ( isset( $avasho_post_first_id ) ) {
                    $this->get_avasho( $avasho_post_first_id );
                }
            }
        }
    }

    private function add_mp3( $post_id ) {
        do_action( 'avasho_add_mp3', $post_id );
    }

    private function get_avasho( $avasho_post_first_id ) {
        // You can include the required file here if necessary.
        // require avasho_dir . 'services/get-url.php';

        // Or if 'get-url.php' is already loaded, call the appropriate function:
        // get_avasho_url( $avasho_post_first_id );

        // Alternatively, you can perform the logic directly within this method.
        // Example:
        $avasho_url = get_avasho_url( $avasho_post_first_id );
        // Do something with $avasho_url
    }
}