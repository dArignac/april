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

	/**
	 * Class for encapsulating the theme section, setting and control generation.
	 */
	class AprilCustomizer {

		public function __construct( $wp_customize ) {
			$this->customizer = $wp_customize;
		}

		/**
		 * Adds a section.
		 * @param $name string name of the section ("april_" will be prepended)
		 * @param $title
		 * @param $priority
		 */
		public function add_section( $name, $title, $priority ) {
			$this->customizer->add_section(
				'april_' . $name,
				array(
					'title'    => $title,
					'priority' => $priority
				)
			);
		}

		/**
		 * Adds an image logo control element. Wow.
		 * @param $name		string	name of the setting ("april_" will be prepended)
		 * @param $label
		 * @param $section	string	name of the section (without "april_")
		 */
		public function add_image_logo_control( $name, $label, $section ) {
			$this->customizer->add_setting(
				'april_' . $name,
				array(
					'sanitize_callback' => 'esc_url_raw',
					'transport'         => 'postMessage'
				)
			);
			// control
			$this->customizer->add_control(
				new WP_Customize_Image_Control(
					$this->customizer,
					'april_' . $name,
					array(
						'label'    => $label,
						'section'  => 'april_' . $section,
						'settings' => 'april_' . $name
					)
				)
			);
		}

		/**
		 * Adds an input control.
		 * @param $name		string	the name of the control ("april_" will be prepended)
		 * @param $label
		 * @param $section	string	the name of the section (without "april_")
		 */
		public function add_input_control( $name, $label, $section ) {
			$this->customizer->add_setting(
				'april_' . $name,
				array(
					'sanitize_callback' => 'april_sanitize_alphanumeric',
					'transport'         => 'postMessage'
				)
			);
			// control
			$this->customizer->add_control(
				'april_' . $name,
				array(
					'label'    => $label,
					'section'  => 'april_' . $section,
					'settings' => 'april_' . $name,
					'type'     => 'input'
				)
			);
		}

		/**
		 * @param $name_setting	string	name of the setting ("april_" will be prepended)
		 * @param $name_control	string	name of the control ("april_" will be prepended)
		 * @param $label
		 * @param $section		string	the name of the section (without "april_")
		 */
		public function add_category_control( $name_setting, $name_control, $label, $section ) {
			// fetch categories, see https://codex.wordpress.org/Plugin_API/Action_Reference/customize_register
			$cats = array();
			$cats[0] = __( 'Display all', 'april' );
			foreach( get_categories() as $category ) {
				$cats[$category->term_id] = $category->name;
			}
			// settings
			$this->customizer->add_setting('april_' . $name_setting, array( 'default' => 0 ) );
			// control
			$this->customizer->add_control(
				new april_multiple_select_control(
					$this->customizer,
					'april_' . $name_control,
					array(
						'label'    => $label,
						'section'  => 'april_' . $section,
						'settings' => 'april_' . $name_setting,
						'type'     => 'multi-select',
						'choices'  => $cats
					)
				)
			);
		}

		/**
		 * Adds a checkbox control.
		 * @param $name		string	name of the section ("april_" will be prepended)
		 * @param $label
		 * @param $section	string	the name of the section (without "april_")
		 */
		public function add_checkbox_control( $name, $label, $section ) {
			$this->customizer->add_setting(
				'april_' . $name,
				array(
					'sanitize_callback' => 'esc_attr',
					'transport'         => 'postMessage',
				)
			);
			// control
			$this->customizer->add_control(
				'april_' . $name,
				array(
					'label'    => $label,
					'section'  => 'april_' . $section,
					'settings' => 'april_' . $name,
					'type'     => 'checkbox',
					'value'    => 1
				)
			);
		}
	}
	// instantiate the customizer class
	$c = new AprilCustomizer( $wp_customize );

	// Logo upload ////////////////////////////////////////////////////////////////////////////////////////////////////
	$c->add_section( 'logo_and_icons', __( 'Logo & Icons', 'april' ), 30 );
	$c->add_image_logo_control( 'logo_image',          __( 'Logo image',          'april' ), 'logo_and_icons' );
	$c->add_image_logo_control( 'hamburger_image',     __( 'Hamburger image',     'april' ), 'logo_and_icons' );
	$c->add_image_logo_control( 'widgets_open_image',  __( 'Widgets open image',  'april' ), 'logo_and_icons' );
	$c->add_image_logo_control( 'widgets_close_image', __( 'Widgets close image', 'april' ), 'logo_and_icons' );
	///////////////////////////////////////////////////////////////////////////////////////////////////////////////////

	// Typekit Settings ///////////////////////////////////////////////////////////////////////////////////////////////
	$c->add_section( 'typekit', __( 'Typekit Settings', 'april' ), 35 );
	$c->add_input_control( 'typekit_kit_id',      __( 'Kit ID',                 'april' ), 'typekit' );
	$c->add_input_control( 'typekit_font_family', __( 'font-family for <body>', 'april' ), 'typekit' );
	$c->add_input_control( 'typekit_font_weight', __( 'font-weight for <body>', 'april' ), 'typekit' );
	///////////////////////////////////////////////////////////////////////////////////////////////////////////////////

	// Display Settings ///////////////////////////////////////////////////////////////////////////////////////////////
	$c->add_section( 'display_settings', __( 'Display Settings', 'april' ), 40 );
	$c->add_category_control( 'display_front_page_category', 'display_settings', __( 'Limit front page posts to specific categories:', 'april' ), 'display_settings' );
	$c->add_checkbox_control( 'display_author',                                       __( 'Display author on posts?',     'april' ),                                 'display_settings' );
	$c->add_checkbox_control( 'display_post_categories',                              __( 'Display categories on posts?', 'april' ),                                 'display_settings' );
	$c->add_checkbox_control( 'display_post_tags',                                    __( 'Display tags on posts?',       'april' ),                                 'display_settings' );
	$c->add_checkbox_control( 'display_page_titles',                                  __( 'Display page titles on pages?','april' ),                                 'display_settings' );
	$c->add_checkbox_control( 'display_additional_first_level_navigation_on_desktop', __( 'Display additional first level navigation on desktop browser?','april' ), 'display_settings' );
	///////////////////////////////////////////////////////////////////////////////////////////////////////////////////
}

add_action( 'customize_register', 'april_theme_customize' );

/**
 * Sanitize the given string removing all but alphanumeric characters.
 * @param $s string to sanitize
 * @return string
 */
function april_sanitize_alphanumeric ( $s ) {
	return preg_replace("/[^a-zA-Z0-9\\-]+/", "", $s);
}