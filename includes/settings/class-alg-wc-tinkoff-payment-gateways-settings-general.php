<?php
/**
 * Tinkoff Payment Gateways for WooCommerce - General Section Settings
 *
 * @version 1.5.0
 * @since   1.0.0
 * @author  Imaginate Solutions
 * @package cpgw
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

if ( ! class_exists( 'Alg_WC_Tinkoff_Payment_Gateways_Settings_General' ) ) :

	/**
	 * General Settings Class.
	 */
	class Alg_WC_Tinkoff_Payment_Gateways_Settings_General extends Alg_WC_Tinkoff_Payment_Gateways_Settings_Section {

		/**
		 * Constructor.
		 *
		 * @version 1.2.1
		 * @since   1.0.0
		 */
		public function __construct() {
			$this->id   = '';
			$this->desc = __( 'General', 'woocommerce-tinkoff-payment-gateways' );
			parent::__construct();
		}

		/**
		 * Get settings.
		 *
		 * @return array Settings Array.
		 * @version 1.5.0
		 * @since   1.0.0
		 */
		public function get_settings() {
			$settings = array(
				array(
					'title' => __( 'Tinkoff Payment Gateways Options', 'woocommerce-tinkoff-payment-gateways' ),
					'type'  => 'title',
					'id'    => 'alg_wc_tinkoff_payment_gateways_options',
					'desc'  => __( 'Here you can set number of tinkoff payment
 gateways to add.', 'woocommerce-tinkoff-payment-gateways' )
						. ' ' . sprintf(
							// translators: %s is link to payment gateway settings.
							__( 'After setting the number, visit %s to set each gateway\'s options.', 'woocommerce-tinkoff-payment-gateways' ),
							'<a href="' . admin_url( 'admin.php?page=wc-settings&tab=checkout' ) . '">' .
							__( 'WooCommerce > Settings > Payments', 'woocommerce-tinkoff-payment-gateways' ) . '</a>'
						),
				),
				array(
					'title'   => __( 'Tinkoff Payment Gateways', 'woocommerce-tinkoff-payment-gateways' ),
					'desc'    => '<strong>' . __( 'Enable plugin', 'woocommerce-tinkoff-payment-gateways' ) . '</strong>',
					'id'      => 'alg_wc_tinkoff_payment_gateways_enabled',
					'default' => 'yes',
					'type'    => 'checkbox',
				),
				array(
					'title'   => __( 'SHOP ID', 'woocommerce-tinkoff-payment-gateways' ),
					'id'      => 'alg_wc_tinkoff_payment_gateways_shop_id',
					'type'    => 'text'
				),
				array(
					'title'   => __( 'Showcase id', 'woocommerce-tinkoff-payment-gateways' ),
					'id'      => 'alg_wc_tinkoff_payment_gateways_showcase_id',
					'type'    => 'text'
				),				
				array(
					'title'             => __( 'Number of gateways', 'woocommerce-tinkoff-payment-gateways' ),
					'desc'              => apply_filters(
						'alg_wc_tinkoff_payment_gateways_settings',
						sprintf(
							'<p><div style="background-color: #fefefe; padding: 10px; border: 1px solid #d8d8d8; width: fit-content;">You will need <a target="_blank" href="%s">Tinkoff Payment Gateways for WooCommerce Pro plugin</a> to add more than one tinkoff payment
 gateway.</div></p>',
							'https://github.com/ivannikitin-com/woocommerce-tinkoff-payment-gateways'
						),
						'total_number'
					),
					'desc_tip'          => __( 'Number of tinkoff payment
s gateways to be added.', 'woocommerce-tinkoff-payment-gateways' ) . ' ' .
						__( 'Press "Save changes" after changing this number to see new options.', 'woocommerce-tinkoff-payment-gateways' ),
					'id'                => 'alg_wc_tinkoff_payment_gateways_number',
					'default'           => 2,
					'type'              => 'number',
					'custom_attributes' => apply_filters( 'alg_wc_tinkoff_payment_gateways_settings', array( 'readonly' => 'readonly' ), 'array' ),
				),				
			);
			for ( $i = 1; $i <= apply_filters( 'alg_wc_tinkoff_payment_gateways_values', 2, 'total_gateways' ); $i++ ) { // phpcs:ignore
				$settings[] = array(
					'title'   => __( 'Admin title for Custom Gateway', 'woocommerce-tinkoff-payment-gateways' ) . ' #' . $i,
					'id'      => 'alg_wc_tinkoff_payment_gateways_admin_title_' . $i,
					'default' => __( 'Custom Gateway', 'woocommerce-tinkoff-payment-gateways' ) . ' #' . $i,
					'type'    => 'text',
					'desc'    => '<a class="button" href="' . admin_url( 'admin.php?page=wc-settings&tab=checkout&section=alg_tinkoff_gateway_' . $i ) . '" target="_blank">' .
						__( 'Settings', 'woocommerce' ) . '</a>',
				);
			}
			$settings = array_merge(
				$settings,
				array(
					array(
						'type' => 'sectionend',
						'id'   => 'alg_wc_tinkoff_payment_gateways_options',
					),
				)
			);
			return $settings;
		}

	}

endif;

return new Alg_WC_Tinkoff_Payment_Gateways_Settings_General();
