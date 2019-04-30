<?php
namespace Example_Me\App\Controllers\Admin;

use Example_Me\App\Controllers\Admin\Base_Controller;
use Example_Me as Example_Me;

if ( ! class_exists( __NAMESPACE__ . '\\' . 'Admin_Settings' ) ) {

	/**
	 * Controller class that implements Plugin Admin Settings configurations
	 *
	 * @since      1.0.0
	 * @package    Example_Me
	 * @subpackage Example_Me/controllers/admin
	 */
	class Admin_Settings extends Base_Controller {

		/**
		 * Holds suffix for dynamic add_action called on settings page.
		 *
		 * @var string
		 * @since 1.0.0
		 */
		private static $hook_suffix = 'settings_page_' . Example_Me::PLUGIN_ID;

		/**
		 * Slug of the Settings Page
		 *
		 * @since    1.0.0
		 */
		const SETTINGS_PAGE_SLUG = Example_Me::PLUGIN_ID;

		/**
		 * Capability required to access settings page
		 *
		 * @since 1.0.0
		 */
		const REQUIRED_CAPABILITY = 'manage_options';

		/**
		 * Register callbacks for actions and filters
		 *
		 * @since    1.0.0
		 */
		public function register_hook_callbacks() {
			// Create Menu.
			add_action( 'admin_menu', array( $this, 'plugin_menu' ) );

			// Enqueue Styles & Scripts.
			add_action( 'admin_print_scripts-' . static::$hook_suffix, array( $this, 'enqueue_scripts' ) );
			add_action( 'admin_print_styles-' . static::$hook_suffix, array( $this, 'enqueue_styles' ) );

			// Register Fields.
			add_action( 'load-' . static::$hook_suffix, array( $this, 'register_fields' ) );

			// Register Settings.
			add_action( 'admin_init', array( $this->get_model(), 'register_settings' ) );

			// Settings Link on Plugin's Page.
			add_filter(
				'plugin_action_links_' . Example_Me::PLUGIN_ID . '/' . Example_Me::PLUGIN_ID . '.php',
				array( $this, 'add_plugin_action_links' )
			);
		}

		/**
		 * Create menu for Plugin inside Settings menu
		 *
		 * @since    1.0.0
		 */
		public function plugin_menu() {
			// @codingStandardsIgnoreStart.
			static::$hook_suffix = add_options_page(
				__( Example_Me::PLUGIN_NAME, Example_Me::PLUGIN_ID ),        // Page Title.
				__( Example_Me::PLUGIN_NAME, Example_Me::PLUGIN_ID ),        // Menu Title.
				static::REQUIRED_CAPABILITY,           // Capability.
				static::SETTINGS_PAGE_SLUG,             // Menu URL.
				array( $this, 'markup_settings_page' ) // Callback.
			);
			// @codingStandardsIgnoreEnd.
		}

		/**
		 * Register the JavaScript for the admin area.
		 *
		 * @since    1.0.0
		 */
		public function enqueue_scripts() {

			/**
			 * This function is provided for demonstration purposes only.
			 */

			wp_enqueue_script(
				Example_Me::PLUGIN_ID . '_admin-js',
				Example_Me::get_plugin_url() . 'assets/js/admin/example-me.js',
				array( 'jquery' ),
				Example_Me::PLUGIN_VERSION,
				true
			);
		}

		/**
		 * Register the JavaScript for the admin area.
		 *
		 * @since    1.0.0
		 */
		public function enqueue_styles() {

			/**
			 * This function is provided for demonstration purposes only.
			 */

			wp_enqueue_style(
				Example_Me::PLUGIN_ID . '_admin-css',
				Example_Me::get_plugin_url() . 'assets/css/admin/example-me.css',
				array(),
				Example_Me::PLUGIN_VERSION,
				'all'
			);
		}

		/**
		 * Creates the markup for the Settings page
		 *
		 * @since    1.0.0
		 */
		public function markup_settings_page() {
			if ( current_user_can( static::REQUIRED_CAPABILITY ) ) {
				$this->view->admin_settings_page(
					array(
						'page_title'    => Example_Me::PLUGIN_NAME,
						'settings_name' => $this->get_model()->get_plugin_settings_option_key(),
					)
				);
			} else {
				wp_die( __( 'Access denied.' ) ); // WPCS: XSS OK.
			}
		}

		/**
		 * Registers settings sections and fields
		 *
		 * @since    1.0.0
		 */
		public function register_fields() {

			// Add Settings Page Section.
			add_settings_section(
				'example_me_section',                    // Section ID.
				__( 'Settings', Example_Me::PLUGIN_ID ), // Section Title.
				array( $this, 'markup_section_headers' ), // Section Callback.
				static::SETTINGS_PAGE_SLUG                 // Page URL.
			);

			// Add Settings Page Field.
			add_settings_field(
				'number_of_posts',                                // Field ID.
				__( 'Default Number of Posts:', Example_Me::PLUGIN_ID ), // Field Title.
				array( $this, 'markup_fields' ),                    // Field Callback.
				static::SETTINGS_PAGE_SLUG,                          // Page.
				'example_me_section',                              // Section ID.
				array(                                              // Field args.
					'id'        => 'number_of_posts',
					'label_for' => 'number_of_posts',
				)
			);
		}

		/**
		 * Adds the section introduction text to the Settings page
		 *
		 * @param array $section Array containing information Section Id, Section
		 *                       Title & Section Callback.
		 *
		 * @since    1.0.0
		 */
		public function markup_section_headers( $section ) {
			$this->view->section_headers(
				array(
					'section'      => $section,
					'text_example' => __( 'This is a text example for section header', Example_Me::PLUGIN_ID ),
				)
			);
		}

		/**
		 * Delivers the markup for settings fields
		 *
		 * @param array $field_args Field arguments passed in `add_settings_field`
		 *                          function.
		 *
		 * @since    1.0.0
		 */
		public function markup_fields( $field_args ) {
			$field_id = $field_args['id'];
			$settings_value = $this->get_model()->get_setting( $field_id );
			$this->view->markup_fields(
				array(
					'field_id'       => esc_attr( $field_id ),
					'settings_name'  => $this->get_model()->get_plugin_settings_option_key(),
					'settings_value' => ! empty( $settings_value ) ? esc_attr( $settings_value ) : '',
				)
			);
		}

		/**
		 * Adds links to the plugin's action link section on the Plugins page
		 *
		 * @param array $links The links currently mapped to the plugin.
		 * @return array
		 *
		 * @since    1.0.0
		 */
		public function add_plugin_action_links( $links ) {
			$settings_link = '<a href="options-general.php?page=' . static::SETTINGS_PAGE_SLUG . '">' . __( 'Settings', Example_Me::PLUGIN_ID ) . '</a>';
			array_unshift( $links, $settings_link );

			return $links;
		}

	}

}
