<?php


namespace avashoo;

class Postandupdate {
    private $token;
    private $url;
    private $header;
    private $gender;
    private $stripped_content;
    private $body;
    private $content;
    public function __construct($post_ID){
        $this->title = get_the_title($post_ID);
        $this->$content = get_the_content($post_ID);
        $this->stripped_content = wp_filter_nohtml_kses($content);
        $this->token = get_option('avasho_setting')['api_key'];
        $this->url = 'https://panel.iavasho.ir/backend/api/archives/public/'; // Replace with your actual API URL.
        $this->header = array(
            'x-access-token' => $this->token,
            'Content-Type' => 'application/json'
        );
        $gender_post = get_post_meta($post_ID, 'gender', true);
        $this->gender = $gender_post ? $gender_post : '1';
        $this->body = array(
            'title' => $this->title,
            'text' => '$this->$content',
            'speaker' => $this->gender
        );
    }

    public function post_and_update() {
        $response = wp_remote_post($this->url, array(
            'headers' => $this->header,
            'body' => wp_json_encode($this->body),
        ));

        if (is_wp_error($response)) {
            // Handle the error appropriately, e.g., log or display a message.
            $error_message = $response->get_error_message();
            return "API Request Failed: $error_message";
        }

        $response_code = wp_remote_retrieve_response_code($response);
        $response_body = wp_remote_retrieve_body($response);

        if ($response_code !== 201) {
            // Handle non-200 status code response here.
            return "API Request Failed: HTTP $response_code";
        }
        $response_array = json_decode($response_body, true);
        return $response_array;
        //return $response_body;
    }
}