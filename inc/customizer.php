<?php
/**
 * BlohmCP_s Theme Customizer
 *
 * @package BlohmCP_s
 * @since BlohmCP_s 1.2
 */

/**
 * Add postMessage support for site title and description for the Theme Customizer.
 *
 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
 *
 * @since BlohmCP_s 1.2
 */
function blohmcp_s_customize_register( $wp_customize ) {
	$wp_customize->get_setting( 'blogname' )->transport        = 'postMessage';
	$wp_customize->get_setting( 'blogdescription' )->transport = 'postMessage';
}
add_action( 'customize_register', 'blohmcp_s_customize_register' );

/**
 * Binds JS handlers to make Theme Customizer preview reload changes asynchronously.
 *
 * @since BlohmCP_s 1.2
 */
function blohmcp_s_customize_preview_js() {
	wp_enqueue_script( 'blohmcp_s_customizer', get_template_directory_uri() . '/js/customizer.js', array( 'customize-preview' ), '20120827', true );
}
add_action( 'customize_preview_init', 'blohmcp_s_customize_preview_js' );
