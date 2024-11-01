<?php

/**
 * 移除不需要的仪表板小部件
 */
add_action( 'wp_before_admin_bar_render', function () {
	global $wp_meta_boxes;
	unset( $wp_meta_boxes[ 'dashboard' ][ 'side' ][ 'core' ][ 'dashboard_recent_drafts' ] );
	unset( $wp_meta_boxes[ 'dashboard' ][ 'side' ][ 'core' ][ 'dashboard_primary' ] );
	unset( $wp_meta_boxes[ 'dashboard' ][ 'side' ][ 'core' ][ 'dashboard_secondary' ] );
	unset( $wp_meta_boxes[ 'dashboard' ][ 'normal' ][ 'core' ][ 'dashboard_duoshuo' ] );
	unset( $wp_meta_boxes[ 'dashboard' ][ 'normal' ][ 'core' ][ 'dashboard_recent_comments' ] );
	unset( $wp_meta_boxes[ 'dashboard' ][ 'normal' ][ 'core' ][ 'dashboard_incoming_links' ] );
	unset( $wp_meta_boxes[ 'dashboard' ][ 'normal' ][ 'core' ][ 'dashboard_plugins' ] );
} );


/**
 * 移除 <head> 不不需要的内容
 */
add_action( 'init', function () {
	remove_action( 'wp_head', 'feed_links', 2 );
	remove_action( 'wp_head', 'feed_links_extra', 3 );
	remove_action( 'wp_head', 'rsd_link' );
	remove_action( 'wp_head', 'wlwmanifest_link' );
	remove_action( 'wp_head', 'adjacent_posts_rel_link_wp_head', 10 );
	remove_action( 'wp_head', 'wp_generator' );
	remove_action( 'wp_head', 'wp_shortlink_wp_head', 10 );
}, 10 );


/**
 * 移除管理工具条上无用的链接
 */
add_action( 'wp_before_admin_bar_render', function () {
	global $wp_admin_bar;
	$wp_admin_bar->remove_menu( 'wp-logo' );
	$wp_admin_bar->remove_menu( 'about' );
	$wp_admin_bar->remove_menu( 'wporg' );
	$wp_admin_bar->remove_menu( 'documentation' );
	$wp_admin_bar->remove_menu( 'support-forums' );
	$wp_admin_bar->remove_menu( 'feedback' );
	$wp_admin_bar->remove_menu( 'view-site' );
} );


/**
 * 在前端移除 dashicon
 */
add_action( 'init', function () {
	if ( ! is_user_logged_in() ) {
		wp_deregister_style( 'dashicons' );
		wp_register_style( 'dashicons', false );
		wp_enqueue_style( 'dashicons', '' );
		wp_deregister_style( 'editor-buttons' );
		wp_register_style( 'editor-buttons', false );
		wp_enqueue_style( 'editor-buttons', '' );
	}
} );


/**
 * 清理菜单类
 */
add_filter( 'nav_menu_css_class', function ( $var ) {
	return is_array( $var ) ? array_intersect( $var, [ 'current-menu-item', 'menu-item', 'menu-item-has-children' ] ) : '';
}, 100, 1 );


/**
 * 移除 WordPress 标记
 */
add_filter( 'the_generator', function () {
	return '';
} );


/**
 * 移除标题中的空字符
 */
add_filter( 'wp_title', function ( $title ) {
	return trim( $title );
} );