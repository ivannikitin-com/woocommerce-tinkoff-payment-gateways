<?php
/**
 * Tinkoff Payment Gateways for WooCommerce - Core Class
 *
 * @version 1.6.0
 * @since   1.0.0
 * @author  Imaginate Solutions
 * @package cpgw
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

if ( ! class_exists( 'Alg_WC_Tinkoff_Payment_Gateways_Core' ) ) :

	/**
	 * Tinkoff Payment Gateway Core Class.
	 */
	class Alg_WC_Tinkoff_Payment_Gateways_Core {

		/**
		 * Constructor.
		 *
		 * @version 1.6.0
		 * @since   1.0.0
		 * @todo    [dev] add "language" shortcode
		 * @todo    [dev] (maybe) currency conversion (#6974)
		 */
		public function __construct() {
			if ( 'yes' === get_option( 'alg_wc_tinkoff_payment_gateways_enabled', 'yes' ) ) {
				// Include tinkoff paymentgateways class.
				require_once 'class-wc-gateway-alg-tinkoff.php';
				// Input fields.
				if ( 'yes' === get_option( 'alg_wc_cpg_input_fields_enabled', 'yes' ) ) {
					require_once 'class-alg-wc-tinkoff-payment-gateways-input-fields.php';
				}
				// Fees.
				if ( 'yes' === get_option( 'alg_wc_cpg_fees_enabled', 'yes' ) ) {
					require_once 'class-alg-wc-tinkoff-payment-gateways-fees.php';
				}
			}
		}

	}

endif;

return new Alg_WC_Tinkoff_Payment_Gateways_Core();
