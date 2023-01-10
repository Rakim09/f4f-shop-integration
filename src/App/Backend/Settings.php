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

namespace F4fShopIntegration\App\Backend;

use F4fShopIntegration\Common\Abstracts\Base;

/**
 * Class Settings
 *
 * @package F4fShopIntegration\App\Backend
 * @since 1.0.0
 */
class Settings extends Base {

	/**
	 * Initialize the class.
	 *
	 * @since 1.0.0
	 */
	public function init() {
		/**
		 * This backend class is only being instantiated in the backend as requested in the Bootstrap class
		 *
		 * @see Requester::isAdminBackend()
		 * @see Bootstrap::__construct
		 *
		 * Add plugin code here for admin settings specific functions
		 */
		add_action('admin_menu', [ $this, 'registerSettingsMenu' ]);

		add_action( 'admin_init', [ $this, 'registerSettingFields' ] );

		add_filter( 'allowed_options', function ($allowed_options) {
			$allowed_options['f4f-shop-integration-general-settings'] = [
				'rd_f4f_shop_integration_add_transaction',
				'rd_f4f_shop_integration_product_category_id',
				'rd_f4f_shop_integration_cancel_transaction'
			];
			return $allowed_options;
		});
	}

	/**
	 * Register plugin settings menu
	 *
	 * @return void
	 * @since 1.0.0
	 */
	public function registerSettingsMenu(): void {
		add_options_page(
			__( 'F4F Shop Integration', $this->plugin->textDomain() ),
			__( 'F4F Shop Integration', $this->plugin->textDomain() ),
			'administrator',
			'f4f-shop-integration-general-settings',
			[ $this, 'renderSettingsPage' ],
		);
	}

	public function renderSettingsPage(): void {
		require_once $this->plugin->templatePath().'/admin/f4f-shop-integration-settings.php';
	}

	public function registerSettingFields(): void {
		add_settings_section(
			'f4f-shop-integration-general-settings-section',
			__( 'General', $this->plugin->textDomain() ),
			[ $this, 'settingsSectionCallback' ],
			'f4f-shop-integration-general-settings',
		);

		add_settings_field(
			'rd_f4f_shop_integration_add_transaction',
			'Add Transaction URL',
			[ $this, 'renderSettingsField' ],
			'f4f-shop-integration-general-settings',
			'f4f-shop-integration-general-settings-section',
			[
				'label_for' => 'rd_f4f_shop_integration_add_transaction',
				'required' => true,
			]
		);

		add_settings_field(
			'rd_f4f_shop_integration_product_category_id',
			'Product Category',
			[ $this, 'renderSettingsField' ],
			'f4f-shop-integration-general-settings',
			'f4f-shop-integration-general-settings-section',
			[
				'label_for' => 'rd_f4f_shop_integration_product_category_id',
				'required' => true,
			]
		);

		add_settings_field(
			'rd_f4f_shop_integration_cancel_transaction',
			'Cancel Transaction URL',
			[ $this, 'renderSettingsField' ],
			'f4f-shop-integration-general-settings',
			'f4f-shop-integration-general-settings-section',
			[
				'label_for' => 'rd_f4f_shop_integration_cancel_transaction',
				'required' => true,
			]
		);

		register_setting(
			'f4f-shop-integration-general-settings-section',
			'rd_f4f_shop_integration_add_transaction',
		);

		register_setting(
			'f4f-shop-integration-general-settings-section',
			'rd_f4f_shop_integration_product_category_id',
		);

		register_setting(
			'f4f-shop-integration-general-settings-section',
			'rd_f4f_shop_integration_cancel_transaction',
		);
	}

	public function settingsSectionCallback( array $args ): void {
		echo "";
	}

	public function renderSettingsField( array $args ): void {
		$value = get_option( $args['label_for'] );

		$html = sprintf(
			'<input
				class="regular-text"
				name="%1$s"
				id="%1$s"
				type="text"
				value="%2$s"
				%3$s
			/>',
			$args['label_for'],
			esc_attr( $value ),
			$args['required'] ? 'required="required"' : '',
		);

		if ( isset( $args['description'] ) && '' !== $args['description'] ) {
			$html .= sprintf(
				'<p class="description" id="%1$s">
					%2$s
				</p>',
				$args['label_for'] . '-description',
				$args['description'],
			);
		}

		echo $html;
	}
}
