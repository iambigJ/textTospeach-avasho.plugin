<?php
namespace avashoo;
class avashoSettingsPage {
public function __construct() {
    add_action('admin_menu', array($this, 'avasho_add_menu'));
    add_action('admin_init', array($this, 'avasho_add_section'),20);
}
//action for adding menu
public function avasho_add_menu() {
    if (!get_option('avasho_api')) {
    add_option('avasho_setting');
    }

    add_submenu_page(
    'tools.php',
    'تبدیل صوت به متن اواشو',
    'تبدیل صوت به متن اواشو',
    'manage_options',
    'avasho_setting',
    array($this, 'avasho_menu_callback')
    );
    }
//action for adding section and field setting to it
    public function avasho_menu_callback() {
    include avasho_dir . 'assets/settingFields/do_setting_field.php';
    }

    public function avasho_add_section() {
        add_settings_section(
        'avasho_section_main',
        'تنظیمات',
        array($this, 'avasho_section_callback'),
        'avasho_setting'
    );

     add_settings_field(
        'avasho_api_key',
        __('api','avasho'),
        array($this, 'avasho_apifield_callback'),
        'avasho_setting',
        'avasho_section_main'
    );
    add_settings_field('avasho_setting_method',
            'روش فراخوانی در پست ها',
            [$this,'avasho_setting_method'],
            'avasho_setting',
            'avasho_section_main');


    add_settings_field('avasho_setting_offset',
        __('جایگاه مدیاپلیر در پست ها','avasho'),
            [$this,'avasho_setting_offset'],
        'avasho_setting',
        'avasho_section_main',
    ''
    );

    register_setting('avasho_setting', 'avasho_setting');
    }

    public function avasho_section_callback() {
    }

    //option for api key input
    public function avasho_apifield_callback() {
	    $value = get_option('avasho_setting')['api_key'];
	    $place_holder =  $value;
	    $text_api = '<div "><input style="width:900px;height:20px;  "  type="text" name="avasho_setting[api_key]" placeholder = "'.$place_holder.'". value="' . $value . '" /><div>';
	    echo $text_api;
    }
    //option for up or down mp3 in the post
	    public function avasho_setting_offset(){
	    $option = get_option('avasho_setting');
	    $value = isset($option['avasho_setting_offset']) ? $option['avasho_setting_offset']:'';
	    $checked1 = checked( $value, 'up of the post', false );
	    $checked2 = checked( $value, 'down of the post', false );

		printf('
			<div style= "display : inline-block; margin-left:10px; margin-right:10px;"><label><input type="radio" name="avasho_setting[avasho_setting_offset]" value="up of the post" %s>در بالای پست</label></div>
		  <div style= "display : inline-block; margin-left:10px; margin-right:10px;"><label><input type="radio" name="avasho_setting[avasho_setting_offset]" value="down of the post" %s>در پایین پست </label></div>', $checked1,$checked2);
    }
    //option for action and filter in the post
    public function avasho_setting_method(){
        $option = get_option('avasho_setting');
        $value = isset($option['avasho_setting_method']) ? $option['avasho_setting_method']:'';
        $checked1 = checked( $value, 'add action', false );
        $checked2 = checked( $value, 'add filter', false );

        printf('
            <div style=  "display : inline-block; margin-left:10px; margin-right:10px;"><label ><input type="radio" name="avasho_setting[avasho_setting_method]" value="add action" %s>add action</label></div>
            <div  style= "display : inline-block; margin-left:10px; margin-right:10px;"><label><input type="radio" name="avasho_setting[avasho_setting_method]" value="add filter" %s>add filter</label></div>',
            $checked1,$checked2);
    }

}
