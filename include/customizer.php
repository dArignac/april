<?php
/**
 * Customized the theme options page.
 * @param $wp_customize
 */
function april_theme_customize ( $wp_customize ) {

	// START: Logo upload /////////////////////////////////////////////////////////////////////////////////////////////
	// section
	$wp_customize->add_section(
		'april_logo_upload',
		array(
			'title'    => __( 'Logo', 'april' ),
			'priority' => 30
		)
	);
	// setting
	$wp_customize->add_setting(
		'logo_upload',
		array(
			'sanitize_callback' => 'esc_url_raw',
			'transport'         => 'postMessage'
		)
	);
	// control
	$wp_customize->add_control(
		new WP_Customize_Image_Control(
			$wp_customize,
			'logo_image',
			array(
				'label'    => __( 'Upload custom logo.', 'april' ),
				'section'  => 'april_logo_upload',
				'settings' => 'logo_upload'
			)
		)
	);
	///////////////////////////////////////////////////////////////////////////////////////////////////////////////////

	// START: Typekit Settings ////////////////////////////////////////////////////////////////////////////////////////
	// section
	$wp_customize->add_section(
		'april_typekit',
		array(
			'title'    => __( 'Typekit Settings', 'april' ),
			'priority' => 35
		)
	);
	// settings
	$wp_customize->add_setting(
		'typekit_kit_id',
		array(
			'sanitize_callback' => 'april_sanitize_alphanumeric',
			'transport'         => 'postMessage'
		)
	);
	// control
	$wp_customize->add_control(
		'typekit_kit_id',
		array(
			'label'    => __( 'Kit ID', 'april' ),
			'section'  => 'april_typekit',
			'settings' => 'typekit_kit_id',
			'type'     => 'input'
		)
	);
	// settings
	$wp_customize->add_setting(
		'typekit_font_family',
		array(
			'sanitize_callback' => 'esc_attr',
			'transport'         => 'postMessage'
		)
	);
	// control
	$wp_customize->add_control(
		'typekit_font_family',
		array(
			'label'    => __( 'font-family for <body>', 'april' ),
			'section'  => 'april_typekit',
			'settings' => 'typekit_font_family',
			'type'     => 'input'
		)
	);
	// settings
	$wp_customize->add_setting(
		'typekit_font_weight',
		array(
			'sanitize_callback' => 'esc_attr',
			'transport'         => 'postMessage'
		)
	);
	// control
	$wp_customize->add_control(
		'typekit_font_weight',
		array(
			'label'    => __( 'font-weight for <body>', 'april' ),
			'section'  => 'april_typekit',
			'settings' => 'typekit_font_weight',
			'type'     => 'input'
		)
	);
	// END: Typekit Settings
	///////////////////////////////////////////////////////////////////////////////////////////////////////////////////

	// START: Display Settings ////////////////////////////////////////////////////////////////////////////////////////
	// section
	$wp_customize->add_section(
		'april_display_settings',
		array(
			'title'    => __( 'Display Settings', 'april' ),
			'priority' => 40
		)
	);
	// settings
	$wp_customize->add_setting(
		'display_author',
		array(
			'sanitize_callback' => 'esc_attr',
			'transport'         => 'postMessage',
		)
	);
	// control
	$wp_customize->add_control(
		'display_author',
		array(
			'label'    => __( 'Display author on posts?', 'april' ),
			'section'  => 'april_display_settings',
			'settings' => 'display_author',
			'type'     => 'checkbox',
			'value'    => 1
		)
	);
	// settings
	$wp_customize->add_setting(
		'display_post_categories',
		array(
			'sanitize_callback' => 'esc_attr',
			'transport'         => 'postMessage',
		)
	);
	// control
	$wp_customize->add_control(
		'display_post_categories',
		array(
			'label'    => __( 'Display categories on posts?', 'april' ),
			'section'  => 'april_display_settings',
			'settings' => 'display_post_categories',
			'type'     => 'checkbox',
			'value'    => 1
		)
	);
	// settings
	$wp_customize->add_setting(
		'display_post_tags',
		array(
			'sanitize_callback' => 'esc_attr',
			'transport'         => 'postMessage',
		)
	);
	// control
	$wp_customize->add_control(
		'display_post_tags',
		array(
			'label'    => __( 'Display tags on posts?', 'april' ),
			'section'  => 'april_display_settings',
			'settings' => 'display_post_tags',
			'type'     => 'checkbox',
			'value'    => 1
		)
	);
	// END: Display Settings
	///////////////////////////////////////////////////////////////////////////////////////////////////////////////////
}

add_action( 'customize_register', 'april_theme_customize' );

/**
 * Sanitize the given string removing all but alphanumeric characters.
 * @param $s string to sanitize
 * @return string
 */
function april_sanitize_alphanumeric ( $s ) {
	return preg_replace("/[^a-zA-Z0-9]+/", "", $s);
}