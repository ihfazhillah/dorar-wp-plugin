<?php
/*
 * Plugin Name: Dorar Hadith
 * Plugin URI: https://blog.ihfazh.com
 * Description: Help you to takhrij hadith on your article through dorar.net
 * Version: 0.0.1
 * Author: Ihfazhillah
 * Author URI: https://blog.ihfazh.com
 * Licence: MIT
 */

function dorar_shortcode_init(){
    function dorar_shortcode($attrs = [], $content = null, $tag = ''){

        $dorar_attrs = array_change_key_case((array)$attrs, CASE_LOWER);

        $dorar_attrs = shortcode_atts([
            'id' => 1
        ], $dorar_attrs, $tag);

        $id = esc_html__($dorar_attrs['id'], 1);

        $o = '<div class="dorar-hadith" id="' . $id . '">';

        // the content
        $o .= $content;

        // tag close

        $o .= '</div>';

        // takhrij button

        $o .= '<button class="dorar-takhrij-btn" id="' . $id . '">takhrij</button><br>';

        // modal
        //
        $o .= '
            <div class="dorar-modal" id="' . $id .'">
              <div class="dorar-modal-content">
                <div class="dorar-modal-header">
                  <div class="close">&times;</div>
                  <h2>تحقق من صحة الحديث</h2>
                </div>
                <div class="dorar-modal-body">
                  <p style="color: red;">لا يوجد</p></div>
                <div class="dorar-modal-footer">
                  <h3>نعتمد في البحث بموقع <a href="https://dorar.net">الدرر السنية</a></h3>
                  <small>مبرمج: <a href="http://blog.ihfazh.com">محمد احفظ الله الاندنيسي</a> | <a href="http://github.com/ihfazhillah/dorar-chrome-ext">شاركنا في البرمجة</a> | مفتوح المصدر</small>
                </div>
              </div>
            </div>
            ';

        return $o;
    }

    add_shortcode('dorar', 'dorar_shortcode');
}
add_action('init', 'dorar_shortcode_init');

function dorar_install(){
    dorar_shortcode_init();


}
register_activation_hook(__FILE__, 'dorar_install');

// register stylesheet and script
function dorar_register_assets(){
    wp_register_style('dorarcss', plugins_url('assets/css/style.css', __FILE__));

    wp_enqueue_style('dorarcss');
    
}

add_action('wp_enqueue_scripts', 'dorar_register_assets');

function dorar_register_script(){
    wp_register_script('dorar_js', plugins_url('/assets/js//dorar.js', __FILE__), array('jquery'), NULL, false);
    wp_enqueue_script('dorar_js');
}
add_action('wp_enqueue_scripts', 'dorar_register_script');

function dorar_deactivation(){
    if (shortcode_exists('dorar')){
        remove_shortcode('dorar');
    }

    wp_dequeue_style('dorarcss');
    wp_dequeue_script('dorar_js');
}

register_deactivation_hook(__FILE__, 'dorar_deactivation');
