<?php
/**
 * F4F Shop Integration
 *
 * @package   f4f-shop-integration
 * @author    R-DEV <office@r-dev.cloud>
 * @copyright 2022 F4F Shop Integration
 * @license   MIT
 * @link      https://r-dev.cloud
 */

declare( strict_types = 1 );

namespace F4fShopIntegration\Config;

use F4fShopIntegration\Common\Abstracts\Base;

/**
 * Internationalization and localization definitions
 *
 * @package F4fShopIntegration\Config
 * @since 1.0.0
 */
final class I18n extends Base {
	/**
	 * Load the plugin text domain for translation
	 * @docs https://developer.wordpress.org/plugins/internationalization/how-to-internationalize-your-plugin/#loading-text-domain
	 *
	 * @since 1.0.0
	 */
	public function load() {
		load_plugin_textdomain(
			$this->plugin->textDomain(),
			false,
			dirname( plugin_basename( F4F_SHOP_INTEGRATION_PLUGIN_FILE ) ) . '/languages' // phpcs:disable ImportDetection.Imports.RequireImports.Symbol -- this constant is global
		);
	}
}
