<?php
namespace Example_Me\App\Views\Frontend;

use \Example_Me\Core\View;
use \Example_Me as Example_Me;

if ( ! class_exists( __NAMESPACE__ . '\\' . 'Sample_Shortcode' ) ) {
	class Sample_Shortcode extends View {
		public function shortcode_html( $args ){
			return 	$this->render_template(
				'frontend/print-posts-shortcode.php',
				$args
			); // WPCS: XSS OK.
		}
	}
}
