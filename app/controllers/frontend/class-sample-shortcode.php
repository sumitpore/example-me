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
			$the_query = $this->get_model()->get_posts_for_shortcode( 'plugin_name_print_posts', $atts );

			if ( $the_query->have_posts() ) : ?>

				<!-- the loop -->
				<?php
				while ( $the_query->have_posts() ) :
					$the_query->the_post();
					?>
					<h2><?php the_title(); ?></h2>
				<?php endwhile; ?>
				<!-- end of the loop -->

				<?php wp_reset_postdata(); ?>

			<?php else : ?>
				<p><?php esc_html_e( 'Sorry, no posts matched your criteria.' ); ?></p>
			<?php
			endif;
		}

	}
}
