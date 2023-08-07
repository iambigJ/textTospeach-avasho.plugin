<?php
//array meta come from add_action come mp3
namespace avashoo;
class getMp3Url
{
    private $api_id;
    private $url;
    private $headers;
    private $args;
    private $token;
    public function __construct($api_id)
    {
        $this->token = get_option('avasho_setting')['api_key'];
        $this->api_id = $api_id;
        $this->url = "https://panel.iavasho.ir/backend/api/archives/public/{$this->api_id}";
        $this->headers = array(
            'x-access-token' => $this->token, // Replace with the actual API key
            'Content-Type' => 'application/json'
        );
        $this->args = array(
            'method' => 'GET',
            'timeout' => 2,
            'httpversion' => '1.1',
            'redirection' => 5,
            'blocking' => true,
            'headers' => $this->headers,
            'sslverify' => false,
        );
    }

    public function result()
    {
        $response_send = wp_remote_get($this->url, $this->args);

        if (is_wp_error($response_send)) {
            return null; // Return null or handle the error as per your requirement
        }
        $response_body = wp_remote_retrieve_body($response_send);
        $response_array = json_decode($response_body, true);
        return $response_array;

    }
}



