<?php
/**
 * Customized the theme options page.
 * @param $wp_customize
 */
function april_theme_customize ( $wp_customize ) {

    // START: Typekit Kit ID
    // section
    $wp_customize->add_section(
        'april_typekit_kit_id',
        array(
            'title'    => __( 'Typekit ID', 'april' ),
            'priority' => 70
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