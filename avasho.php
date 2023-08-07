<?php
/*
 * Plugin Name: avashoo
 * Plugin URI: https://hooshio.com
 * Description: avasho for partdp
 * Version: 0.2.0
 * Author : alij
 * Domain Patch: /languages
 */


define('avasho_dir',plugin_dir_path(__FILE__));
define('avasho_url',plugin_dir_url(__FILE__));
define('avasho_api_key',(get_option('avasho_setting')['api_key']));


require_once avasho_dir . 'vendor/autoload.php';


use avashoo\Enqueuecss;
use avashoo\Meta_Boxes;
use avashoo\Actions;
use avashoo\avashoSettingsPage;
use avashoo\Postandupdate;
class Init
{
    public function __construct()
    {
        Meta_Boxes::init();
        Enqueuecss::blocks(avasho_url);
        Enqueuecss::setting(avasho_url);
        new avashoSettingsPage();
       // new Actions();
    }
}

new Init();
$check_selected = get_post_meta(20);
$CHECKED = isset($check_selected['avasho_fistID'][0]) ? 'checked' : '';
//////////////////////////

//class getMp3Url
//{
//    private $api_id;
//    private $url;
//    private $headers;
//    private $args;
//    private $token;
//    public function __construct($api_id)
//    {
//        $this->token = get_option('avasho_setting')['api_key'];
//        $this->api_id = $api_id;
//        $this->url = "https://panel.iavasho.ir/backend/api/archives/public/{$this->api_id}";
//        $this->headers = array(
//            'x-access-token' => $this->token, // Replace with the actual API key
//            'Content-Type' => 'application/json'
//        );
//        $this->args = array(
//            'method' => 'GET',
//            'timeout' => 2,
//            'httpversion' => '1.1',
//            'redirection' => 5,
//            'blocking' => true,
//            'headers' => $this->headers,
//            'sslverify' => false,
//        );
//    }
//
//    public function result()
//    {
//        $response_send = wp_remote_get($this->url, $this->args);
//        if (is_wp_error($response_send)) {
//            return null; // Return null or handle the error as per your requirement
//        }
//
//        $response_array = json_decode($response_send['body'], true);
//        print_r($response_array);
//        if (!isset($response_array['status']) || $response_array['status'] !== 'success') {
//            return null; // Return null or handle the error as per your requirement
//        }
//
//        $mp3_url = isset($response_array['data']['result']['aiResult']) ? $response_array['data']['result']['aiResult'] : null;
//
//        return '$mp3_url';
//    }
//}
//$x = get_post_meta(20);
//$api_id = $x['avasho_fistID'][0];
//$y = new getMp3Url($api_id);
//$goo = $y->result();
//echo $goo;