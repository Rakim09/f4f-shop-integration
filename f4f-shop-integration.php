<?php
/**
 * F4F Shop Integration
 *
 * @package   f4f-shop-integration
 * @author    R-DEV <office@r-dev.cloud>
 * @copyright 2022 F4F Shop Integration
 * @license   MIT
 * @link      https://r-dev.cloud
 *
 * Plugin Name:     F4F Shop Integration
 * Plugin URI:      https://r-dev.cloud
 * Description:     F4F Shop Integration
 * Version:         1.0.0
 * Author:          R-DEV
 * Author URI:      https://r-dev.cloud
 * Text Domain:     f4f-shop-integration
 * Domain Path:     /languages
 * Requires PHP:    7.1
 * Requires WP:     5.5.0
 * Namespace:       F4fShopIntegration
 */

declare( strict_types = 1 );

/**
 * Define the default root file of the plugin
 *
 * @since 1.0.0
 */
const F4F_SHOP_INTEGRATION_PLUGIN_FILE = __FILE__;

/**
 * Load PSR4 autoloader
 *
 * @since 1.0.0
 */
$f4f_shop_integration_autoloader = require plugin_dir_path( F4F_SHOP_INTEGRATION_PLUGIN_FILE ) . 'vendor/autoload.php';

/**
 * Setup hooks (activation, deactivation, uninstall)
 *
 * @since 1.0.0
 */
register_activation_hook( __FILE__, [ 'F4fShopIntegration\Config\Setup', 'activation' ] );
register_deactivation_hook( __FILE__, [ 'F4fShopIntegration\Config\Setup', 'deactivation' ] );
register_uninstall_hook( __FILE__, [ 'F4fShopIntegration\Config\Setup', 'uninstall' ] );

/**
 * Bootstrap the plugin
 *
 * @since 1.0.0
 */
if ( ! class_exists( '\F4fShopIntegration\Bootstrap' ) ) {
	wp_die( __( 'F4F Shop Integration is unable to find the Bootstrap class.', 'f4f-shop-integration' ) );
}
add_action(
	'plugins_loaded',
	static function () use ( $f4f_shop_integration_autoloader ) {
		/**
		 * @see \F4fShopIntegration\Bootstrap
		 */
		try {
			new \F4fShopIntegration\Bootstrap( $f4f_shop_integration_autoloader );
		} catch ( Exception $e ) {
			wp_die( __( 'F4F Shop Integration is unable to run the Bootstrap class.', 'f4f-shop-integration' ) );
		}
	}
);

/**
 * Create a main function for external uses
 *
 * @return \F4fShopIntegration\Common\Functions
 * @since 1.0.0
 */
function f4f_shop_integration(): \F4fShopIntegration\Common\Functions {
	return new \F4fShopIntegration\Common\Functions();
}
