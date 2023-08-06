<?php
/**
 * Class Meta_Boxes
 */
namespace avashoo;
require_once __DIR__ . '/../vendor/autoload.php';
use avashoo\Postandupdate;
class Meta_Boxes {
    public static $CHECKED;
    public static function init() {
        // load class.
        self::setup_hooks();
    }

    public static function setup_hooks() {
        // Actions.
        add_action('add_meta_boxes', [self::class, 'add_custom_meta_box'],10);
        add_action('save_post', [self::class, 'save_post_meta_data'], 10, 2);
    }
    /**
     * Add custom meta box.
     *
     * @return void
     */
    public static function add_custom_meta_box() {
        $screens = ['post', 'page'];
        foreach ($screens as $screen) {
            add_meta_box(
                'avasho_meta_boxes', // Unique ID
                __('تبدیل صوت به متن اواشو', 'avasho'), // Box title
                [self::class, 'custom_meta_box_html'], // Content callback, must be of type callable
                $screen, // Post type
                'side'
            );
        }
    }
    /**
     * Custom meta box HTML (for form)
     *
     * @param object $post Post.
     *
     * @return void
     */
    public static function custom_meta_box_html($post) {
        /**
         * Use nonce for verification.
         * This will create a hidden input field with id and name as
         * 'hide_title_meta_box_nonce_name' and a unique nonce input value.
         */
        wp_nonce_field(plugin_basename(__FILE__), 'hide_title_meta_box_nonce_avashoo');
        $check_selected = get_post_meta($post->ID);
        self::$CHECKED = isset($check_selected['avasho_fistID'][0]) ? 'checked' : '';
        $gen = get_post_meta($post->ID, 'gender', true); // Specify 'true' to get a single value.
        ?>
        <label class="toggle">
            <input name="avasho_post_metabox" class="avashoo_toggle-checkbox" type="checkbox" value="on" <?php echo self::$CHECKED?>>
            <div class="avashoo_toggle-switch"></div>
        </label>

        <div class="mydict">
            <div>
                <label>
                    <input type="radio" name="avasho_radio_box" value=2 <?php checked($gen, 2);?>>
                    <span>بارگزاری با صدای مرد</span>
                </label>
                <label>
                    <input type="radio" name="avasho_radio_box" value=1 <?php checked($gen, 1);?>>
                    <span >بارگزاری با صدای زن</span>
                </label>
            </div>
        </div>
<?php
        wp_localize_script( 'blockjs', 'my_data_object', ['another_variable'=>'alij'] );

    }

    /**
     * Save post meta into the database when the post is saved.
     *
     * @param integer $post_ID Post id.
     *
     * @return void
     */
    public static function save_post_meta_data($post_ID) {
        if (!isset($_POST['hide_title_meta_box_nonce_avashoo']) || !wp_verify_nonce($_POST['hide_title_meta_box_nonce_avashoo'], plugin_basename(__FILE__))) {
            return;
        }

        if (isset($_POST['avasho_radio_box'])) {
            $gender = $_POST['avasho_radio_box'];
            update_post_meta($post_ID, 'gender', $gender);
        }
        if (!isset($_POST['avasho_post_metabox'])){
            delete_post_meta($post_ID, 'avasho_fistID');
        }
        if (isset($_POST['avasho_post_metabox'])) {
                $response = new Postandupdate($post_ID);
                $response_array = $response->post_and_update();
                if ($response_array['status'] !== 'succsess'){
                   // update_post_meta($post_ID, 'avasho_fistID', 'error');
                }
                if (isset($response_array['data']['id'])) {
                    update_post_meta($post_ID, 'avasho_fistID', $response_array['data']['id']);
                }

            }
        }

}
