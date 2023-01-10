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

namespace F4fShopIntegration\App\General;

use F4fShopIntegration\Common\Abstracts\Base;
use WC_Order;
use WC_Order_Item_Product;
use WP_User;

/**
 * Class Authentication
 *
 * @package F4fShopIntegration\App\General
 * @since 1.0.0
 */
class ShopIntegration extends Base {
	/**
	 * Initialize the class.
	 *
	 * @since 1.0.0
	 */
	public function init(): void {
		/**
		 * This general class is always being instantiated as requested in the Bootstrap class
		 *
		 * @see Bootstrap::__construct
		 *
		 */
		if (get_option( 'rd_f4f_shop_integration_add_transaction' ) && get_option( 'rd_f4f_shop_integration_product_category_id' )) {
			add_action( 'woocommerce_payment_complete', [ $this, 'sendOrder' ] );
		}
	}

	/**
	 * Checkout order hook for sending order data
	 *
	 * @param int $order_id WooCommerce Order ID
	 * @since 1.0.0
	 *
	 * ShopAddTransaction (POST)
		w body:
		{
		"UserName": "mb123@gazeta.pl", // Email
		"ExtTransactionId": 2,  // int – identyfikator transakcji ze sklepu
		"Date": "2022-12-22 16:55",
		"ProductId": 3, // int – identyfikator produktu
		"ProductName": "Ala" // string – nazwa produktu
		}
	 */
	public function sendOrder( int $order_id ): void {

		/** @var WC_Order $order */
		$order = wc_get_order( $order_id );

		/** @var WP_User $current_user */
		$current_user = wp_get_current_user();

		/**
		 * @var WC_Order_Item_Product $item
		 */
		$date = $order->get_date_paid();

		foreach ( $order->get_items() as $item ) {
			if (
				in_array( get_option( 'rd_f4f_shop_integration_product_category_id' ), wc_get_product_cat_ids( $item->get_product_id() ), false )
			) {
				$args = [
					'headers' => [
						'Content-Type' => 'application/x-www-form-urlencoded;charset=UTF-8',
					],
					'body'    => [
						'UserName' => $current_user->user_email,
						'ExtTransactionId'   => $order_id,
						'Date'   => $date->date('Y-m-d H:i'),
						'ProductId'   => $item->get_product_id(),
						'ProductName'   => $item->get_name(),
					],
				];

				$response = wp_remote_post( get_option( 'rd_f4f_shop_integration_add_transaction' ), $args );

				$order->update_meta_data( 'args', $args );
				$order->update_meta_data( 'response', $response );
				$order->save_meta_data();
			}
		}
	}
}