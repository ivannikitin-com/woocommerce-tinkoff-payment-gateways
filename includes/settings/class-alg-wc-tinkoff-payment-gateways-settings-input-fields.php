<?php
/**
 * Tinkoff Payment Gateways for WooCommerce - Input Fields Section Settings
 *
 * @version 1.6.1
 * @since   1.4.0
 * @author  Imaginate Solutions
 * @package cpgw
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

if ( ! class_exists( 'Alg_WC_Tinkoff_Payment_Gateways_Settings_Input_Fields' ) ) :

	/**
	 * Input Fields Class.
	 */
	class Alg_WC_Tinkoff_Payment_Gateways_Settings_Input_Fields extends Alg_WC_Tinkoff_Payment_Gateways_Settings_Section {

		/**
		 * Constructor.
		 *
		 * @version 1.4.0
		 * @since   1.4.0
		 */
		public function __construct() {
			$this->id   = 'input_fields';
			$this->desc = __( 'Input Fields', 'woocommerce-tinkoff-payment-gateways' );
			parent::__construct();
		}

		/**
		 * Get settings.
		 *
		 * @return array Settings Array.
		 * @version 1.6.1
		 * @since   1.4.0
		 */
		public function get_settings() {
			$settings = array(
				array(
					'title' => __( 'Input Fields', 'woocommerce-tinkoff-payment-gateways' ),
					'type'  => 'title',
					'id'    => 'alg_wc_cpg_input_fields_section_options',
				),
				array(
					'title'   => __( 'Input fields', 'woocommerce-tinkoff-payment-gateways' ),
					'desc'    => '<strong>' . __( 'Enable section', 'woocommerce-tinkoff-payment-gateways' ) . '</strong>',
					'type'    => 'checkbox',
					'id'      => 'alg_wc_cpg_input_fields_enabled',
					'default' => 'yes',
				),
				array(
					'type' => 'sectionend',
					'id'   => 'alg_wc_cpg_input_fields_section_options',
				),
				array(
					'title' => __( 'Order Details Options', 'woocommerce-tinkoff-payment-gateways' ),
					'type'  => 'title',
					'id'    => 'alg_wc_cpg_input_fields_order_details_options',
				),
				array(
					'title'    => __( 'Add to order details', 'woocommerce-tinkoff-payment-gateways' ),
					'desc'     => '<strong>' . __( 'Enable', 'woocommerce-tinkoff-payment-gateways' ) . '</strong>',
					'desc_tip' => __( 'After order table.', 'woocommerce-tinkoff-payment-gateways' ) . ' ' .
						__( 'For example on "Thank You" page.', 'woocommerce-tinkoff-payment-gateways' ),
					'type'     => 'checkbox',
					'id'       => 'alg_wc_cpg_input_fields_add_to_order_details',
					'default'  => 'no',
				),
				array(
					'title'          => __( 'Templates', 'woocommerce-tinkoff-payment-gateways' ),
					'desc'           => __( 'Header', 'woocommerce-tinkoff-payment-gateways' ),
					'type'           => 'textarea',
					'id'             => 'alg_wc_cpg_input_fields_add_to_order_details_template[header]',
					'default'        => '<table class="widefat striped"><tbody>',
					'css'            => 'width:100%;',
					'alg_wc_cpg_raw' => true,
				),
				array(
					'desc'           => __( 'Each field', 'woocommerce-tinkoff-payment-gateways' ) . ' | ' .
						sprintf(
							// translators: %s indicates the placeholders available.
							__( 'Placeholders: %s', 'woocommerce-tinkoff-payment-gateways' ),
							'<code>' . implode( '</code>, <code>', array( '%title%', '%value%' ) ) . '</code>'
						),
					'type'           => 'textarea',
					'id'             => 'alg_wc_cpg_input_fields_add_to_order_details_template[field]',
					'default'        => '<tr><th>%title%</th><td>%value%</td></tr>',
					'css'            => 'width:100%;',
					'alg_wc_cpg_raw' => true,
				),
				array(
					'desc'           => __( 'Footer', 'woocommerce-tinkoff-payment-gateways' ),
					'type'           => 'textarea',
					'id'             => 'alg_wc_cpg_input_fields_add_to_order_details_template[footer]',
					'default'        => '</tbody></table>',
					'css'            => 'width:100%;',
					'alg_wc_cpg_raw' => true,
				),
				array(
					'type' => 'sectionend',
					'id'   => 'alg_wc_cpg_input_fields_order_details_options',
				),
				array(
					'title' => __( 'Emails Options', 'woocommerce-tinkoff-payment-gateways' ),
					'type'  => 'title',
					'id'    => 'alg_wc_cpg_input_fields_emails_options',
				),
				array(
					'title'    => __( 'Add to emails', 'woocommerce-tinkoff-payment-gateways' ),
					'desc'     => '<strong>' . __( 'Enable', 'woocommerce-tinkoff-payment-gateways' ) . '</strong>',
					'desc_tip' => __( 'After order table.', 'woocommerce-tinkoff-payment-gateways' ),
					'type'     => 'checkbox',
					'id'       => 'alg_wc_cpg_input_fields_add_to_emails',
					'default'  => 'no',
				),
				array(
					'title'   => __( 'Sent to', 'woocommerce-tinkoff-payment-gateways' ),
					'type'    => 'select',
					'class'   => 'chosen_select',
					'id'      => 'alg_wc_cpg_input_fields_add_to_emails_sent_to',
					'default' => 'all',
					'options' => array(
						'all'      => __( 'All emails', 'woocommerce-tinkoff-payment-gateways' ),
						'admin'    => __( 'Admin emails only', 'woocommerce-tinkoff-payment-gateways' ),
						'customer' => __( 'Customer emails only', 'woocommerce-tinkoff-payment-gateways' ),
					),
				),
				array(
					'title'          => __( 'HTML templates', 'woocommerce-tinkoff-payment-gateways' ),
					'desc'           => __( 'Header', 'woocommerce-tinkoff-payment-gateways' ),
					'type'           => 'textarea',
					'id'             => 'alg_wc_cpg_input_fields_add_to_emails_template[header]',
					'default'        => '',
					'css'            => 'width:100%;',
					'alg_wc_cpg_raw' => true,
				),
				array(
					'desc'           => __( 'Each field', 'woocommerce-tinkoff-payment-gateways' ) . ' | ' .
						sprintf(
							// translators: %s indicates the placeholders available.
							__( 'Placeholders: %s', 'woocommerce-tinkoff-payment-gateways' ),
							'<code>' . implode( '</code>, <code>', array( '%title%', '%value%' ) ) . '</code>'
						),
					'type'           => 'textarea',
					'id'             => 'alg_wc_cpg_input_fields_add_to_emails_template[field]',
					'default'        => '<p>%title%: %value%</p>',
					'css'            => 'width:100%;',
					'alg_wc_cpg_raw' => true,
				),
				array(
					'desc'           => __( 'Footer', 'woocommerce-tinkoff-payment-gateways' ),
					'type'           => 'textarea',
					'id'             => 'alg_wc_cpg_input_fields_add_to_emails_template[footer]',
					'default'        => '',
					'css'            => 'width:100%;',
					'alg_wc_cpg_raw' => true,
				),
				array(
					'title'          => __( 'Plain text templates', 'woocommerce-tinkoff-payment-gateways' ),
					'desc'           => __( 'Header', 'woocommerce-tinkoff-payment-gateways' ),
					'type'           => 'textarea',
					'id'             => 'alg_wc_cpg_input_fields_add_to_emails_template_plain[header]',
					'default'        => '',
					'css'            => 'width:100%;',
					'alg_wc_cpg_raw' => true,
				),
				array(
					'desc'           => __( 'Each field', 'woocommerce-tinkoff-payment-gateways' ) . ' | ' .
						sprintf(
							// translators: %s indicates the placeholders available.
							__( 'Placeholders: %s', 'woocommerce-tinkoff-payment-gateways' ),
							'<code>' . implode( '</code>, <code>', array( '%title%', '%value%' ) ) . '</code>'
						),
					'type'           => 'textarea',
					'id'             => 'alg_wc_cpg_input_fields_add_to_emails_template_plain[field]',
					'default'        => '%title%: %value%' . "\n",
					'css'            => 'width:100%;',
					'alg_wc_cpg_raw' => true,
				),
				array(
					'desc'           => __( 'Footer', 'woocommerce-tinkoff-payment-gateways' ),
					'type'           => 'textarea',
					'id'             => 'alg_wc_cpg_input_fields_add_to_emails_template_plain[footer]',
					'default'        => '',
					'css'            => 'width:100%;',
					'alg_wc_cpg_raw' => true,
				),
				array(
					'type' => 'sectionend',
					'id'   => 'alg_wc_cpg_input_fields_emails_options',
				),
				array(
					'title' => __( 'General Options', 'woocommerce-tinkoff-payment-gateways' ),
					'type'  => 'title',
					'id'    => 'alg_wc_cpg_input_fields_general_options',
				),
				array(
					'title'   => __( 'Add to order notes', 'woocommerce-tinkoff-payment-gateways' ),
					'desc'    => __( 'Enable', 'woocommerce-tinkoff-payment-gateways' ),
					'type'    => 'checkbox',
					'id'      => 'alg_wc_cpg_input_fields_add_order_note',
					'default' => 'no',
				),
				array(
					'title'   => __( 'Process in "Advanced Order Export For WooCommerce" plugin', 'woocommerce-tinkoff-payment-gateways' ),
					'desc'    => __( 'Enable', 'woocommerce-tinkoff-payment-gateways' ),
					'type'    => 'checkbox',
					'id'      => 'alg_wc_cpg_input_fields_woe_enabled',
					'default' => 'no',
				),
				array(
					'desc'           => __( 'Template', 'woocommerce-tinkoff-payment-gateways' ),
					'desc_tip'       => __( 'Template for a single input field output.', 'woocommerce-tinkoff-payment-gateways' ),
					'type'           => 'text',
					'id'             => 'alg_wc_cpg_input_fields_woe_template',
					'default'        => '%title%: %value%',
					'alg_wc_cpg_raw' => true,
				),
				array(
					'desc'           => __( 'Glue', 'woocommerce-tinkoff-payment-gateways' ),
					'desc_tip'       => __( 'Inserted between input field in output.', 'woocommerce-tinkoff-payment-gateways' ),
					'type'           => 'text',
					'id'             => 'alg_wc_cpg_input_fields_woe_glue',
					'default'        => ' | ',
					'alg_wc_cpg_raw' => true,
				),
				array(
					'type' => 'sectionend',
					'id'   => 'alg_wc_cpg_input_fields_general_options',
				),
			);
			return $settings;
		}

	}

endif;

return new Alg_WC_Tinkoff_Payment_Gateways_Settings_Input_Fields();
