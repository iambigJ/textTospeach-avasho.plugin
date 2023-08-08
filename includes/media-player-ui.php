<?php

namespace avashoo;
class mp3Ui {
    function __construct()
    {




    }

    public function skin1(){
        define('avasho_url',plugin_dir_url(__FILE__));

        wp_enqueue_style('avasho_fontawesome', 'https://netdna.bootstrapcdn.com/font-awesome/4.0.3/css/font-awesome.css');
        wp_enqueue_style('avasho_fontawesome2', 'https://cdnjs.cloudflare.com/ajax/libs/normalize/5.0.0/normalize.min.css');

        wp_enqueue_script('avasho_prefix','https://cdnjs.cloudflare.com/ajax/libs/prefixfree/1.0.7/prefixfree.min.js');
        // wp_enqueue_script('avashojs2','https://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js');
        wp_enqueue_script('avashojs_main', avasho_url . 'assets/posts/skin1.js', array(), null, true);
        wp_enqueue_style('avashocss_main', avasho_url . 'assets/posts/skin1.css');

        $htmlCode = '
<div class="pcast-player">
  <div class="pcast-player-controls">
    <button class="pcast-play"><i class="fa fa-play"></i><span>Play</span></button>
    <button class="pcast-pause"><i class="fa fa-pause"></i><span>Pause</span></button>
    <button class="pcast-rewind"><i class="fa fa-fast-backward"></i><span>Rewind</span></button>
    <span class="pcast-currenttime pcast-time">00:00</span>
    <progress class="pcast-progress" value="0"></progress>
    <span class="pcast-duration pcast-time">00:00</span>
    <button class="pcast-speed">1x</button>
    <button class="pcast-mute"><i class="fa fa-volume-up"></i><span>Mute/Unmute</span></button>
  </div>
  <audio id="avashoMp3" src=""></audio>


';
        return $htmlCode ;
    }


}