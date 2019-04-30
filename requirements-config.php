<?php
/**
 * Contains the information about minimum requirements of the plugin.
 *
 * @package Requirements
 */

return [

	'min_php_version' => '5.6', // Minimum PHP Version.

	'min_wp_version' => '4.8',  // Minimum WordPress Version.

	'is_multisite_compatible' => false, // True if our plugin is Multisite Compatible.

	'required_plugins' => [ // Plugins on which our plugin is dependent on.

		// Example Config
		// 'WooCommerce' => [
		// 'plugin_slug' => 'woocommerce/woocommerce.php',
		// 'min_plugin_version' => '3.5',
		// ], // Config for WooCommerce.
	],

];
