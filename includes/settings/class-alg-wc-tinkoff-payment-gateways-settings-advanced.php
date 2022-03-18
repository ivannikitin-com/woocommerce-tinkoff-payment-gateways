<?php
/**
 * Tinkoff Payment Gateways for WooCommerce - Advanced Section Settings
 *
 * @version 1.4.0
 * @since   1.4.0
 * @author  Imaginate Solutions
 * @package cpgw
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

if ( ! class_exists( 'Alg_WC_Tinkoff_Payment_Gateways_Settings_Advanced' ) ) :

	/**
	 * Advanced Settings class.
	 */
	class Alg_WC_Tinkoff_Payment_Gateways_Settings_Advanced extends Alg_WC_Tinkoff_Payment_Gateways_Settings_Section {

		/**
		 * Constructor.
		 *
		 * @version 1.4.0
		 * @since   1.4.0
		 */
		public function __construct() {
			$this->id   = 'advanced';
			$this->desc = __( 'Advanced', 'woocommerce-tinkoff-payment-gateways' );
			parent::__construct();
		}

		/**
		 * Get settings.
		 *
		 * @return array Settings Array.
		 * @version 1.4.0
		 * @since   1.4.0
		 */
		public function get_settings() {
			$settings = array(
				array(
					'title' => __( 'Advanced Options', 'woocommerce-tinkoff-payment-gateways' ),
					'type'  => 'title',
					'id'    => 'alg_wc_cpg_advanced_options',
				),
				array(
					'title'    => __( 'Shipping methods', 'woocommerce-tinkoff-payment-gateways' ),
					'desc_tip' => __( 'Used in "Enable for shipping methods" tinkoff payment gateway\'s option.', 'woocommerce-tinkoff-payment-gateways' ),
					'type'     => 'select',
					'class'    => 'chosen_select',
					'id'       => 'alg_wc_cpg_load_shipping_method_instances',
					'default'  => 'yes',
					'options'  => array(
						'yes'     => __( 'Load shipping methods and instances', 'woocommerce-tinkoff-payment-gateways' ),
						'no'      => __( 'Load shipping methods only', 'woocommerce-tinkoff-payment-gateways' ),
						'disable' => __( 'Do not load', 'woocommerce-tinkoff-payment-gateways' ),
					),
				),
				array(
					'type' => 'sectionend',
					'id'   => 'alg_wc_cpg_advanced_options',
				),
			);
			return $settings;
		}

	}

endif;

return new Alg_WC_Tinkoff_Payment_Gateways_Settings_Advanced();
