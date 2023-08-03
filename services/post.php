<?php
add_action('wp_ajax_my_alert_action', 'my_ajax_callback', 200);
add_action('wp_ajax_nopriv_my_alert_action', 'my_ajax_callback', 200);
class Postandupdate {
    private $token;
    private $header;
    private $url = 'https://panel.iavasho.ir/backend/api/archives/public/';

    public function __construct($post_ID) {

        $this->token = get_option('avasho_setting')['api_key'];
        $this->header =  [    "x-access-token" => avasho_api_key,    "Content-Type" => "application/json"];
        $title = get_the_title($post_ID);
        $content = get_the_content($post_ID);
        $stripped_content_0 = wp_strip_all_tags($content);
        $stripped_content = wp_filter_nohtml_kses($stripped_content_0);
        $gender_post = get_post_meta($post_ID)['gender'][0];
        $gender = $gender_post ? $gender_post : '1';

        $body = [
            "title" => $title,
            "text" => $stripped_content,
            'speaker'=> $gender
        ];
        $args = [
            'method' => 'POST',
            'timeout' => 45,
            'redirection' => 5,
            'blocking' => true,
            'headers' => $this->header,
            'sslverify' => false,
            'body' => json_encode($body)
        ];
        $response = wp_remote_post($this->url, $args);

        if (is_wp_error($response)) {
            return;
        }

        $response_body = wp_remote_retrieve_body($response);
        $response_array = json_decode($response_body, true);
        $idFirst = $response_array['data']['id'];
        update_post_meta(
            $post_ID,
            'avasho_post_fistID',
            $idFirst
        );


        // Hook the callback function to the appropriate WordPress AJAX actions
    }
}



$postAvasho = new Postandupdate($post_ID);