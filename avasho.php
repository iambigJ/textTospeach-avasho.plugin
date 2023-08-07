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
       // Enqueuecss::enqueueBlob(avasho_url);
        new avashoSettingsPage();
        new Actions();
    }
}

new Init();

//////////////////////////
