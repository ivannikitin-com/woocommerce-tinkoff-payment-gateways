<?php
/**
 * Plugin Name: WooCommerce Tinkoff Payment Gateways 
 * Plugin URI: https://imaginate-solutions.com/downloads/woocommerce-tinkoff-payment-gateways/
 * Description: Tinkoff payment gateways for WooCommerce
 * Version: 1.6.6
 * Author: ИП Никитин и партнеры
 * Text Domain: woocommerce-tinkoff-payment-gateways

 * Domain Path: /langs
 * WC tested up to: 5.4
 * License: GNU General Public License v3.0
 * License URI: http://www.gnu.org/licenses/gpl-3.0.html
 *
 * @package cpgw
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

if ( ! class_exists( 'Alg_WC_Tinkoff_Payment_Gateways' ) ) :

	/**
	 * Main Alg_WC_Tinkoff_Payment_Gateways Class
	 *
	 * @class   Alg_WC_Tinkoff_Payment_Gateways
	 * @version 1.6.2
	 * @since   1.0.0
	 */
	final class Alg_WC_Tinkoff_Payment_Gateways {

		/**
		 * Plugin version.
		 *
		 * @var   string
		 * @since 1.0.0
		 */
		public $version = '1.6.6';

		/**
		 * The single instance of the class.
		 *
		 * @var   Alg_WC_Tinkoff_Payment_Gateways The single instance of the class
		 * @since 1.0.0
		 */
		protected static $_instance = null;

		/**
		 * Main Alg_WC_Tinkoff_Payment_Gateways Instance
		 *
		 * Ensures only one instance of Alg_WC_Tinkoff_Payment_Gateways is loaded or can be loaded.
		 *
		 * @version 1.0.0
		 * @since   1.0.0
		 * @static
		 * @return  Alg_WC_Tinkoff_Payment_Gateways - Main instance
		 */
		public static function instance() {
			if ( is_null( self::$_instance ) ) {
				self::$_instance = new self();
			}
			return self::$_instance;
		}

		/**
		 * Alg_WC_Tinkoff_Payment_Gateways Constructor.
		 *
		 * @version 1.6.0
		 * @since   1.0.0
		 * @access  public
		 */
		public function __construct() {

			// Check for active plugins.
			if (
			! $this->is_plugin_active( 'woocommerce/woocommerce.php' ) ||
			( 'woocommerce-tinkoff-payment-gateways.php' === basename( __FILE__ ) && $this->is_plugin_active( 'woocommerce-tinkoff-payment-gateways-pro/woocommerce-tinkoff-payment-gateways-pro.php' ) )
			) {
				return;
			}

			// Set up localisation.
			load_plugin_textdomain( 'woocommerce-tinkoff-payment-gateways', false, dirname( plugin_basename( __FILE__ ) ) . '/langs/' );

			// Pro.
			if ( 'woocommerce-tinkoff-payment-gateways-pro.php' === basename( __FILE__ ) ) {
				require_once 'includes/pro/class-alg-wc-tinkoff-payment-gateways-pro.php';
			}

			// Include required files.
			$this->includes();

			// Admin.
			if ( is_admin() ) {
				$this->admin();
			}

			add_filter( 'alg_wc_tinkoff_payment_gateways_values', function ($number) { return 4; } );
			add_filter( 'alg_wc_tinkoff_payment_gateways_settings', function ($number) { return array(); } );

			add_action( 'wp_enqueue_scripts', array($this,'enqueue_scripts_styles'));
			add_action( 'woocommerce_checkout_create_order', array($this, 'correct_payment_method_title_in_order'), 10, 2 );
						
		}

		public function correct_payment_method_title_in_order($order, $data) {
			$payment_method = $order->get_payment_method();
			//ob_start();
			$payment_gateways=WC()->payment_gateways->payment_gateways();
			$order->set_payment_method_title($payment_gateways[$payment_method]->method_title);
			//$output = ob_get_clean();
			//file_put_contents('tinkoff.log', $output.PHP_EOL, FILE_APPEND);
		}

		/**
		 * Is plugin active.
		 *
		 * @param   string $plugin Plugin Name.
		 * @return  bool
		 * @version 1.6.0
		 * @since   1.6.0
		 */
		public function is_plugin_active( $plugin ) {
			return ( function_exists( 'is_plugin_active' ) ? is_plugin_active( $plugin ) :
			(
				in_array( $plugin, apply_filters( 'active_plugins', (array) get_option( 'active_plugins', array() ) ), true ) ||
				( is_multisite() && array_key_exists( $plugin, (array) get_site_option( 'active_sitewide_plugins', array() ) ) )
			)
			);
		}

		/**
		 * Include required core files used in admin and on the frontend.
		 *
		 * @version 1.2.0
		 * @since   1.0.0
		 */
		public function includes() {
			// Functions.
			require_once 'includes/alg-wc-tinkoff-payment-gateways-functions.php';
			// Core.
			$this->core = require_once 'includes/class-alg-wc-tinkoff-payment-gateways-core.php';
		}

		/**
		 * Admin.
		 *
		 * @version 1.6.2
		 * @since   1.2.0
		 */
		public function admin() {
			// Action links.
			add_filter( 'plugin_action_links_' . plugin_basename( __FILE__ ), array( $this, 'action_links' ) );
			// Settings.
			add_filter( 'woocommerce_get_settings_pages', array( $this, 'add_woocommerce_settings_tab' ) );
			// Version update.
			if ( get_option( 'alg_wc_tinkoff_payment_gateways_version', '' ) !== $this->version ) {
				add_action( 'admin_init', array( $this, 'version_updated' ) );
			}
		}

		/**
		 * Show action links on the plugin screen.
		 *
		 * @version 1.2.1
		 * @since   1.0.0
		 * @param   mixed $links Links.
		 * @return  array
		 */
		public function action_links( $links ) {
			$custom_links   = array();
			$custom_links[] = '<a href="' . admin_url( 'admin.php?page=wc-settings&tab=alg_wc_tinkoff_payment_gateways' ) . '">' . __( 'Settings', 'woocommerce' ) . '</a>';
			if ( 'woocommerce-tinkoff-payment-gateways.php' === basename( __FILE__ ) ) {
				$custom_links[] = '<a target="_blank" href="https://imaginate-solutions.com/downloads/woocommerce-tinkoff-payment-gateways/">' .
				__( 'Unlock All', 'woocommerce-tinkoff-payment-gateways' ) . '</a>';
			}
			return array_merge( $custom_links, $links );
		}

		/**
		 * Add Tinkoff Payment Gateways settings tab to WooCommerce settings.
		 *
		 * @param   array $settings WC Settings Array.
		 * @return  array
		 * @version 1.2.0
		 * @since   1.0.0
		 */
		public function add_woocommerce_settings_tab( $settings ) {
			$settings[] = require_once 'includes/settings/class-alg-wc-settings-tinkoff-payment-gateways.php';
			return $settings;
		}

		/**
		 * Version updated.
		 *
		 * @version 1.2.0
		 * @since   1.2.0
		 */
		public function version_updated() {
			update_option( 'alg_wc_tinkoff_payment_gateways_version', $this->version );
		}

		/**
		 * Get the plugin url.
		 *
		 * @version 1.0.0
		 * @since   1.0.0
		 * @return  string
		 */
		public function plugin_url() {
			return untrailingslashit( plugin_dir_url( __FILE__ ) );
		}

		/**
		 * Get the plugin path.
		 *
		 * @version 1.0.0
		 * @since   1.0.0
		 * @return  string
		 */
		public function plugin_path() {
			return untrailingslashit( plugin_dir_path( __FILE__ ) );
		}

		/**
		 * Enqueue scripts.
		 *
		 * @version 1.0.0
		 * @since   1.0.0
		 */ 		
		public function enqueue_scripts_styles() {
			if (is_checkout() || is_product()) {
				wp_enqueue_script( 'tinkoffkredit-js', 'https://forma.tinkoff.ru/static/onlineScript.js', array('jquery'), null, true );
				wp_enqueue_style( 'tinkoffkredit-css', plugins_url( '/includes/css/style.css', __FILE__ ), false );
			}
		}
	}

endif;

if ( ! function_exists( 'alg_wc_tinkoff_payment_gateways' ) ) {
	/**
	 * Returns the main instance of Alg_WC_Tinkoff_Payment_Gateways to prevent the need to use globals.
	 *
	 * @version 1.0.0
	 * @since   1.0.0
	 * @return  Alg_WC_Tinkoff_Payment_Gateways
	 */
	function alg_wc_tinkoff_payment_gateways() {
		return Alg_WC_Tinkoff_Payment_Gateways::instance();
	}
}

alg_wc_tinkoff_payment_gateways();
