<?php
namespace Example_Me\App\Controllers\Frontend;

use Example_Me\Core\View;

/**
 * Controller that handles `example_me_print_posts` Shortcode
 *
 * @since      1.0.0
 * @package    Example_Me
 * @subpackage Example_Me/Controllers/Frontend
 */
class Print_Posts_Shortcode extends Base_Controller {

	/**
	 * Handle add_action & add_filter required for this module
	 *
	 * @ignore Blank Method
	 * @since 1.0.0
	 */
	protected function register_hook_callbacks(){}

	/**
	 * Registers the 'example_me_print_posts` shortcode
	 *
	 * @return void
	 * @since 1.0.0
	 */
	public function register_shortcode() {
		add_shortcode( 'example_me_print_posts', array( $this, 'print_posts_callback' ) );
	}

	/**
	 * Callback to handle `example_me_print_posts` shortcode
	 *
	 * @param array $atts Attributes passed to shortcode.
	 * @return string Html to rendered
	 */
	public function print_posts_callback( $atts ) {
		return $this->get_view()->display_posts(
			[
				'fetched_posts' => $this->get_model()->fetch_posts( $atts ),
			]
		);
	}
}
