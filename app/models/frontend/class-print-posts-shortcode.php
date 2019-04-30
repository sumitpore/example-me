<?php
namespace Example_Me\App\Models\Frontend;

use Example_Me\App\Models\Settings;

/**
 * Model to handle 'example_me_print_posts' shortcode
 *
 * @since      1.0.0
 * @package    Example_Me
 * @subpackage Example_Me/Models/Frontend
 */
class Print_Posts_Shortcode extends Base_Model {

	/**
	 * Fetch Posts
	 *
	 * @param array $atts Attributes passed to shortcode.
	 * @return \WP_Query Returns found posts as WP_Query Object.
	 */
	public function fetch_posts( $atts ) {
		$atts = shortcode_atts(
			[
				'number_of_posts' => Settings::get_setting( 'number_of_posts' ),
			], $atts, 'example_me_print_posts'
		);

		$args = [
			'post_type' => 'post',
			'posts_per_page' => is_numeric( $atts['number_of_posts'] ) ? $atts['number_of_posts'] : Settings::get_setting( 'number_of_posts' ),
		];

		return new \WP_Query( $args );
	}
}
