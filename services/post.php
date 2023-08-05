<?php


namespace avashoo;
namespace avashoo;

class Postandupdate {
    private $token;
    private $url = 'https://panel.iavasho.ir/backend/api/archives/public/';

    public function __construct($post_ID)
    {
        // Get the API key from the settings
        $this->token = get_option('avasho_setting')['api_key'];
        $this->header = array(
            'x-access-token' => $this->token,
            'Content-Type' => 'application/json'
        );

        // Prepare data to be sent in the request
        $title = get_the_title($post_ID);
        $content = get_the_content($post_ID);
        $stripped_content = wp_filter_nohtml_kses($content);
        $gender_post = get_post_meta($post_ID, 'gender', true);
        $gender = $gender_post ? $gender_post : '1';

        $body = array(
            'title' => $title,
            'text' => $stripped_content,
            'speaker' => $gender
        );

        $args = array(
            'method' => 'POST',
            'timeout' => 2,
            'redirection' => 5,
            'blocking' => false,
            'headers' => $this->header,
            'sslverify' => false,
            'body' => json_encode($body)
        );

        // Use the WordPress HTTP API function to make the POST request
        return $response = wp_remote_post($this->url, $args);
    }
}
