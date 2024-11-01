<?php

/**
 * 对非管理员用户隐藏提醒
 */
add_action( 'admin_head', function () {
	if ( ! current_user_can( 'update_core' ) ) {
		remove_action( 'admin_notices', 'update_nag', 3 );
		remove_action( 'network_admin_notices', 'update_nag', 3 );
	}
}, 1 );


/**
 * 文章最多保存 5 个版本
 */
if ( ! defined( 'WP_POST_REVISIONS' ) ) {
	define( 'WP_POST_REVISIONS', 5 );
}


/**
 * 自动设置图像链接为 none
 */
add_action( 'admin_init', function () {
	$image_set = get_option( 'image_default_link_type' );
	if ( $image_set !== 'none' ) {
		update_option( 'image_default_link_type', 'none' );
	}
}, 10 );


/**
 * 自动添加未命名标题
 */
add_filter( 'the_title', function ( $title ) {
	if ( $title == '' ) {
		return 'Untitled';
	} else {
		return $title;
	}
} );


/**
 * 选中的分类显示在顶部
 */
add_filter( 'wp_terms_checklist_args', function ( $args, $post_id ) {
	if ( isset( $args[ 'taxonomy' ] ) ) {
		$args[ 'checked_ontop' ] = false;
	}

	return $args;
}, 10, 2 );


/**
 * 添加浏览器到 body class 上
 */
add_filter( 'body_class', function ( $classes ) {
	global $is_lynx, $is_gecko, $is_IE, $is_opera, $is_NS4, $is_safari, $is_chrome, $is_iphone;

	if ( $is_lynx ) {
		$classes[] = 'lynx';
	} elseif ( $is_gecko ) {
		$classes[] = 'gecko';
	} elseif ( $is_opera ) {
		$classes[] = 'opera';
	} elseif ( $is_NS4 ) {
		$classes[] = 'ns4';
	} elseif ( $is_safari ) {
		$classes[] = 'safari';
	} elseif ( $is_chrome ) {
		$classes[] = 'chrome';
	} elseif ( $is_IE ) {
		$browser = $_SERVER[ 'HTTP_USER_AGENT' ];
		$browser = substr( "$browser", 25, 8 );
		if ( $browser == "MSIE 7.0" ) {
			$classes[] = 'ie7';
			$classes[] = 'ie';
		} elseif ( $browser == "MSIE 6.0" ) {
			$classes[] = 'ie6';
			$classes[] = 'ie';
		} elseif ( $browser == "MSIE 8.0" ) {
			$classes[] = 'ie8';
			$classes[] = 'ie';
		} elseif ( $browser == "MSIE 9.0" ) {
			$classes[] = 'ie9';
			$classes[] = 'ie';
		} else {
			$classes[] = 'ie';
		}
	} else {
		$classes[] = 'unknown';
	}

	if ( $is_iphone ) {
		$classes[] = 'iphone';
	}

	return $classes;
} );
