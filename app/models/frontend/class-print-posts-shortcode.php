<?php
namespace Example_Me\App\Models\Frontend;

if ( ! class_exists( __NAMESPACE__ . '\\' . 'Print_Posts_Shortocde' ) ) {
	class Print_Posts_Shortocde extends Base_Model {

		public function get_posts_for_shortcode( $shortcode, $atts ) {
			$atts = shortcode_atts(
				array(
					'number_of_posts' => '10',
				), $atts, $shortcode
			);

			$args = array(
				'post_type' => 'post',
				'posts_per_page' => is_int( $atts['number_of_posts'] ) ? $atts['number_of_posts'] : 10,
			);

			return new \WP_Query( $args );
		}
	}
}
