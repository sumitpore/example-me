<?php
namespace Example_Me\App\Controllers\Frontend;

if ( ! class_exists( __NAMESPACE__ . '\\' . 'Sample_Shortcode' ) ) {
	class Sample_Shortcode extends Base_Controller {

		/**
		 * Registers the `example_me_print_posts` shortcode
		 *
		 * @return void
		 * @since 1.0.0
		 */
		public function register_shortcode() {
			add_shortcode( 'example_me_print_posts', array( $this, 'print_posts_callback' ) );
		}

		/**
		 * @ignore Blank Method
		 */
		protected function register_hook_callbacks(){}

		/**
		 * Callback to handle `example_me_print_posts` shortcode
		 *
		 * @return void
		 * @since 1.0.0
		 */
		public function print_posts_callback( $atts ) {

			return $this->get_view()->shortcode_html([
				'fetched_posts'	=>	$this->get_model()->get_posts_for_shortcode( 'example_me_print_posts', $atts )
			]);

		}

	}
}
