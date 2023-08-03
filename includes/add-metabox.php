<?php
/*
 * Class Meta_Boxes
 */
class Meta_Boxes {
    function __construct() {
        // load class.
        $this->setup_hooks();
    }

    function setup_hooks() {

        /**
         * Actions.
         */
        add_action( 'add_meta_boxes', [ $this, 'add_custom_meta_box' ] );
        add_action( 'save_post', [ $this, 'save_post_meta_data' ],10,2 );

    }

    /**
     * Add custom meta box.
     *
     * @return void
     */
    function add_custom_meta_box() {
        $screens = [ 'post' ];
        foreach ( $screens as $screen ) {
            add_meta_box(
                'hide-page-title',           // Unique ID
                __( 'avasho', 'avasho' ),  // Box title
                [ $this, 'custom_meta_box_html' ],  // Content callback, must be of type callable
                $screen,                   // Post type
                'side' // context
            );
        }
    }

    /**
     * Custom meta box HTML( for form )
     *
     * @param object $post Post.
     *
     * @return void
     */
    public function custom_meta_box_html( $post ) {
        $value = get_post_meta( $post->ID, '_hide_page_title', true );

        /**
         * Use nonce for verification.
         * This will create a hidden input field with id and name as
         * 'hide_title_meta_box_nonce_name' and unique nonce input value.
         */
        wp_nonce_field( plugin_basename(__FILE__), 'hide_title_meta_box_nonce_avasho' );
        $check_selected = get_post_meta(get_the_ID());
        isset($check_selected['avasho_post_fistID'][0]) ? $select = ' (speach in turn on)' : $select = ' (speach in of)';
        $gen = get_post_meta($post->ID)['gender'][0];
        ?>
        <label for="avashoField"><?php esc_html_e( 'add mp3 to post', ); ?></label>
        <select name="avasho_post_metabox" id="avashoField" class="postbox">
            <option value=""><?php esc_html_e( 'Select'.$select, 'avasho' ); ?></option>
            <option value="yes" <?php selected( $value, 'yes' ); ?>>
                <?php esc_html_e( 'add a speach to the post', 'avasho' ); ?>
            </option>
            <option value="no" <?php selected( $value, 'no' ); ?>>
                <?php esc_html_e( 'delete a speach to a post', 'avasho' ); ?>
            </option>
        </select>


        <div id="custom-meta-error"></div>
        <label for="avashoField"><?php esc_html_e( 'add mp3 to post', 'avasho' ); ?></label>
        <select name="avasho_post_metabox_gender" id="avashoField_gender" class="postbox">
            <option value="2" <?php selected( $gen, '2' ); ?>>
                <?php esc_html_e( 'man', 'avasho' ); ?>
            </option>
            <option value="1"   <?php selected( $gen, '1' ); ?>>
                <?php esc_html_e( 'woman', 'avasho' ); ?>
            </option>
        </select>

        <?php
    }





    /**
     * Save post meta into database
     * when the post is saved.
     *
     * @param integer $post_ID Post id.
     *
     * @return void
     */
    function save_post_meta_data($post_ID)
    {
        if ( ! current_user_can( 'edit_post', $post_ID ) ) {
            return;
        }

        /**
         * Check if the nonce value we received is the same we created.
         */
        if ( ! isset( $_POST['hide_title_meta_box_nonce_avasho'] ) ||
            ! wp_verify_nonce( $_POST['hide_title_meta_box_nonce_avasho'], plugin_basename(__FILE__) )
        ) {
            return;
        }
        if ($_POST['avasho_post_metabox_gender']){
            $gender = $_POST['avasho_post_metabox_gender'];
            do_action('save_avasho_meta_gender',$post_ID,$gender);
        }


        if ($_POST['avasho_post_metabox'] == 'yes'){
            do_action('save_avasho_metaid',$post_ID);
        }

        elseif  ($_POST['avasho_post_metabox'] == 'no'){
            do_action('remove_avasho_metaid',$post_ID);
        }
    }
}
$action = new Meta_Boxes;

