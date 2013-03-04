<?php
/**
 * Jetpack Compatibility File
 * See: http://jetpack.me/
 *
 * @package BlohmCP_s
 */

/**
 * Add theme support for Infinite Scroll.
 * See: http://jetpack.me/support/infinite-scroll/
 */
function blohmcp_s_infinite_scroll_setup() {
	add_theme_support( 'infinite-scroll', array(
		'container' => 'content',
		'footer'    => 'page',
	) );
}
add_action( 'after_setup_theme', 'blohmcp_s_infinite_scroll_setup' );
