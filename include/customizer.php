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

	// START: Typekit Kit ID //////////////////////////////////////////////////////////////////////////////////////////
	// section
	$wp_customize->add_section(
		'april_typekit_kit_id',
		array(
			'title'    => __( 'Typekit ID', 'april' ),
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
			'label'    => __( 'Typekit Kit ID, see https://typekit.com/account/kits', 'april' ),
			'section'  => 'april_typekit_kit_id',
			'settings' => 'typekit_kit_id',
			'type'     => 'input'
		)
	);
	// END: Typekit Kit ID
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