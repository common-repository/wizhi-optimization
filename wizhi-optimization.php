<?php
/*
Plugin Name:        Wizhi Optimization by Wenprise
Plugin URI:         http://www.wpzhiku.com/wizhi-optimization-2/
Description:        针对WordPress中文用户的一些精简和优化
Version:            1.3.1
Author:             WordPress 智库
Author URI:         http://www.wpzhiku.com/
License:            MIT License
License URI:        http://opensource.org/licenses/MIT
*/

define( 'WIZHI_PATH', plugin_dir_path( __FILE__ ) );

add_action( 'after_setup_theme', function () {
	require_once( WIZHI_PATH . 'modules/cleanup.php' );
	require_once( WIZHI_PATH . 'modules/optimization.php' );
} );

