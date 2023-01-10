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

namespace F4fShopIntegration\Common;

use F4fShopIntegration\App\Frontend\Templates;
use F4fShopIntegration\Common\Abstracts\Base;

/**
 * Main function class for external uses
 *
 * @see f4f_shop_integration()
 * @package F4fShopIntegration\Common
 */
class Functions extends Base {
	/**
	 * Get plugin data by using f4f_shop_integration()->getData()
	 *
	 * @return array
	 * @since 1.0.0
	 */
	public function getData(): array {
		return $this->plugin->data();
	}

	/**
	 * Get the template instantiated class using f4f_shop_integration()->templates()
	 *
	 * @return Templates
	 * @since 1.0.0
	 */
	public function templates(): Templates {
		return new Templates();
	}
}
