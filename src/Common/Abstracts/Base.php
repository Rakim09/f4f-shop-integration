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

namespace F4fShopIntegration\Common\Abstracts;

use F4fShopIntegration\Config\Plugin;

/**
 * The Base class which can be extended by other classes to load in default methods
 *
 * @package F4fShopIntegration\Common\Abstracts
 * @since 1.0.0
 */
abstract class Base {
	/**
	 * @var array : will be filled with data from the plugin config class
	 * @see Plugin
	 */
	protected $plugin = [];

	/**
	 * Base constructor.
	 *
	 * @since 1.0.0
	 */
	public function __construct() {
		$this->plugin = Plugin::init();
	}
}
