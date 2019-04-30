<?php
namespace Example_Me\App\Views\Frontend;

use Example_Me\Core\View;

if ( ! class_exists( __NAMESPACE__ . '\\' . 'Print_Posts_Shortcode' ) ) {

	/**
	 * View class to load all templates related to example_me_print_posts shortcode
	 *
	 * @since      1.0.0
	 * @package    Example_Me
	 * @subpackage Example_Me/Views/Frontend
	 */
	class Print_Posts_Shortcode extends View {

		/**
		 * Display Posts
		 *
		 * @param array $args Arguments to be used in the template.
		 * @return string
		 * @since 1.0.0
		 */
		public function display_posts( $args ) {
			return $this->render_template(
				'frontend/print-posts-shortcode.php',
				$args
			); // WPCS: XSS OK.
		}

	}
}
