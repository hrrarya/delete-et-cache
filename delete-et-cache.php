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

function dec_menu_bar( $admin_bar ) { 
    global $pagenow;
    $admin_bar->add_menu( array( 
        'id'    => 'dec_delete_cache_menu',
        'title' => esc_html( 'Delete ET-Cache' ),
        'href'  => $pagenow .'?action=dec_delete_cache'
     ) );
}


add_action( 'admin_action_dec_delete_cache', 'dec_delete_cache' );

function dec_delete_cache() {
    $et_cache_dir = dirname(__DIR__, 2) . '/et-cache';

    if(is_dir($et_cache_dir)) {
        echo 'Directory Found';
    }else{
        echo 'Directory Not found';
    }
}
