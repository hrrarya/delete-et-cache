<?php
/**
 * @package Delete ET-Cache
 * @version 1.0.0
 */
/*
Plugin Name: Delete ET-Cache
Plugin URI: 
Description: A plugin that deletes divi et-cache.
Author: Hridoy Mozumder
Version: 1.0.0
Author URI: https://vsportfolio.vercel.app/
*/

add_action('admin_bar_menu', 'dec_menu_bar', 100);
const VERSION = '1.0.0';

function dec_menu_bar( $admin_bar ) { 
    $admin_bar->add_menu( array( 
        'id'    => 'dec_delete_cache_menu',
        'title' => esc_html( 'Delete ET-Cache' ),
        'href'  => ''
     ) );
}

wp_enqueue_style( 'dec_delete-cache_main', plugin_dir_url(__FILE__) . 'assets/css/style.css', array(), VERSION, 'all');

wp_enqueue_script ( 'dec_delete_cache_main', plugin_dir_url(__FILE__) .'assets/js/main.js', array('jquery'), VERSION, true );

wp_localize_script ( 'dec_delete_cache_main', 'DecDeleteET', array( 
    'ajaxurl' => admin_url('admin-ajax.php')
));

add_action( 'wp_ajax_dec_delete_cache', 'dec_delete_cache' );

function dec_delete_cache() {
    $et_cache_dir = dirname(__DIR__, 2) . DIRECTORY_SEPARATOR . 'et-cache';


    if(is_dir($et_cache_dir)) {
        shell_exec("rm -rf " . $et_cache_dir);
        shell_exec("rm -rf " . sys_get_temp_dir() . "/{$et_cache_dir}");
		rrmdir($et_cache_dir);
        return wp_send_json(array( 
            'message' => 'deleted',
            'isDone' => true
        ));
    }else{
        return wp_send_json( array( 
            'error' => '',
            'isDone' => false
        ));
    }
    
    
}


// $dirPath = "../images/productimages/$productid";
// 	if (is_dir($dirPath)) {
// 		shell_exec("rm -rf " . $dirPath);
//         shell_exec("rm -rf " . sys_get_temp_dir() . "/{$dirPath}");
// 		rrmdir($dirPath);
// 	}

// call function

function rrmdir($src) {
    // $dir = is_dir($src) ? opendir($src) : 'not found';
    // echo $dir;
    if( is_dir($src) ) {
        if( $dir = opendir($src) ) {
            // echo 'found';
            while(false !== ( $file = readdir($dir)) ) {
                if (( $file != '.' ) && ( $file != '..' )) {
                    $full = $src . '/' . $file;
                    if ( is_dir($full) ) {
                        rrmdir($full);
                    }
                    else {
                        unlink($full);
                    }
                }
            }
            closedir($dir);
            rmdir($src);
        }
    }
}

