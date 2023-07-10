<?php
//array meta come from add_action come mp3
class Getinfoavasho
{

    function __construct($array_meta)
    {

        $avashoGetUrl = $array_meta['avasho_post_fistID']['0'];
        $url = "https://panel.iavasho.ir/backend/api/archives/public/$avashoGetUrl";
        $headers = array(
            'x-access-token' =>  avasho_api_key,
            'Content-Type' => 'application/json'

        );
        $args = array(
            'method' => 'GET',
            'timeout' => 2,
            'httpversion' => '1.1',
            'redirection' => 5,
            'blocking' => true,
            'headers' => $headers,
            'sslverify' => false,
        );
        $responce_send = wp_remote_post($url, $args);

        if ( is_wp_error( $responce_send ) ) {
            return;
        }
        $responce_array = json_decode($responce_send['body'],true);

        if  (!$responce_array['status'] =='success') {
            return;
        }
        $idlast =  ($responce_array['data'] ['result']['aiResult']);
        if (strlen($idlast) > 5 ) {
            update_post_meta(
                get_the_ID(),
                'avasho_post_final',
                "https://panel.iavasho.ir/backend/download/" . $idlast,
            );
        }

    }

}
$getInfo = new Getinfoavasho($array_meta);




