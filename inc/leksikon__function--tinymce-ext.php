<?php
/*
 * Add HR to TinyMCE
 * ------------------------------- */
function enable_more_buttons($buttons) {
	$buttons[] = 'hr'; 
	return $buttons;
}
add_filter("mce_buttons", "enable_more_buttons");

add_filter( 'mce_buttons_2', 'my_mce_buttons_2' );

/**
 * Add the Style selectbox to the second row of MCE buttons
 * Method: http://alisothegeek.com/2011/05/tinymce-styles-dropdown-wordpress-visual-editor/
 * ------------------------------- */
function my_mce_buttons_2( $buttons ) {
	array_unshift( $buttons, 'styleselect' );
	return $buttons;
}
add_filter( 'tiny_mce_before_init', 'my_mce_before_init' );

function my_mce_before_init( $settings ) {
	$style_formats = array(
		array(
			'title' => __( 'Button (solid blue)', 'leksikon' ),
			'selector' => 'a',
			'classes' => 'button button--solid--color__primary'
		),
		array(
			'title' => __( 'Button (solid red)', 'leksikon' ),
			'selector' => 'a',
			'classes' => 'button button--solid--color__secondary'
		),
		array(
			'title' => __( 'Button (solid yellow)', 'leksikon' ),
			'selector' => 'a',
			'classes' => 'button button--solid--color__accent'
		),
		array(
			'title' => __( 'Button (blue border)', 'leksikon' ),
			'selector' => 'a',
			'classes' => 'button button--bordered--color__primary'
		),
		array(
			'title' => __( 'Button (red border)', 'leksikon' ),
			'selector' => 'a',
			'classes' => 'button button--bordered--color__secondary'
		),
		array(
			'title' => __( 'Button (yellow border)', 'leksikon' ),
			'selector' => 'a',
			'classes' => 'button button--bordered--color__accent'
		),
		array(
			'title' => __( 'Big button', 'leksikon' ),
			'selector' => 'a.button',
			'classes' => 'button--large'
		),
		array(
			'title' => __( 'Medium button', 'leksikon' ),
			'selector' => 'a.button',
			'classes' => 'button--medium'
		),
		array(
			'title' => __( 'Small button', 'leksikon' ),
			'selector' => 'a.button',
			'classes' => 'button--small'
		)
	);
	$settings['style_formats'] = json_encode( $style_formats );
	return $settings;
}
?>