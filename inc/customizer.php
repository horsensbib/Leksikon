<?php
/**
 * Leksikon Theme Customizer
 *
 * @package Leksikon
 */

/**
 * Add postMessage support for site title and description for the Theme Customizer.
 *
 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
 */
function leksikon_customize_register( $wp_customize ) {
	$wp_customize->get_setting( 'blogname' )->transport         = 'postMessage';
	$wp_customize->get_setting( 'blogdescription' )->transport  = 'postMessage';
	$wp_customize->get_setting( 'header_textcolor' )->transport = 'postMessage';
	
	// Logo Settings Section
	// http://kwight.ca/2012/12/02/adding-a-logo-uploader-to-your-wordpress-site-with-the-theme-customizer/
	// -----------------------
	$wp_customize->add_section( 'leksikon_logo_options', array(
		'title'       => __( 'Logo Settings', 'leksikon' ),
		'priority'    => 20,
		'capability'  => 'edit_theme_options',
		'description' => __('Upload your logo here.', 'leksikon'), 
		) 
	);
	
	$wp_customize->add_setting( 'leksikon_logo');
	
	$wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, 'leksikon_logo_options_control', array(
		'label'    => __( 'Logo', 'leksikon' ),
    'section'  => 'leksikon_logo_options',
    'settings' => 'leksikon_logo',
	)	) );
}
add_action( 'customize_register', 'leksikon_customize_register' );

/**
 * Binds JS handlers to make Theme Customizer preview reload changes asynchronously.
 */
function leksikon_customize_preview_js() {
	wp_enqueue_script( 'leksikon_customizer', get_template_directory_uri() . '/js/customizer.js', array( 'customize-preview' ), '20130508', true );
}
add_action( 'customize_preview_init', 'leksikon_customize_preview_js' );
