<?php
/**
 * Customized the theme options page.
 * @param $wp_customize
 */
function april_theme_customize ( $wp_customize ) {

	/**
	 * Renders a multiple select control.
	 */
	class april_multiple_select_control extends WP_Customize_Control {
		public $type = 'multi-select';
		public function render_content() {
			if ( empty( $this->choices ) ) {
				return;
			}
			?>
			<label>
				<span class="customize-control-title"><?php echo esc_html( $this->label ); ?></span>
				<select id="comment-display-control" <?php $this->link(); ?> multiple="multiple" style="height: 100%;">
					<?php
						foreach ( $this->choices as $value => $label ) {
							$selected = ( in_array( $value, $this->value() ) ) ? selected( 1, 1, false ) : '';
							echo '<option value="' . esc_attr( $value ) . '"' . $selected . '>' . $label . '</option>';
						}
					?>
				</select>
			</label>
		<?php }
	}

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
	// CHOOSE FRONT PAGE CATEGORIES
	// fetch categories, see https://codex.wordpress.org/Plugin_API/Action_Reference/customize_register
	$cats = array();
	$cats[0] = __( 'Display all', 'april' );
	foreach( get_categories() as $category ) {
		$cats[$category->term_id] = $category->name;
	}
	// settings
	$wp_customize->add_setting(
		'display_front_page_category',
		array(
			'default' => 0
		)
	);
	// control
	$wp_customize->add_control(
		new april_multiple_select_control(
			$wp_customize,
			'april_display_settings',
			array(
				'label'    => __( 'Limit front page posts to specific categories:', 'april' ),
				'section'  => 'april_display_settings',
				'settings' => 'display_front_page_category',
				'type'     => 'multi-select',
				'choices'  => $cats
			)
		)
	);
	// DISPLAY AUTHOR ON POSTS?
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
	// DISPLAY CATEGORIES ON POSTS?
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
	// DISPLAY TAGS ON POSTS?
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
	// DISPLAY PAGE TITLES ON PAGES?
	// settings
	$wp_customize->add_setting(
		'display_page_titles',
		array(
			'sanitize_callback' => 'esc_attr',
			'transport'         => 'postMessage',
		)
	);
	// control
	$wp_customize->add_control(
		'display_page_titles',
		array(
			'label'    => __( 'Display page titles on pages?', 'april' ),
			'section'  => 'april_display_settings',
			'settings' => 'display_page_titles',
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