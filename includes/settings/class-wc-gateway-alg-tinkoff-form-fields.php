<?php
/**
 * Tinkoff Payment Gateways for WooCommerce - Gateways Form Fields
 *
 * @version 1.6.3
 * @since   1.0.0
 * @author  Imaginate Solutions
 * @package cpgw
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

$div_style = 'background-color: #fefefe; padding: 10px; border: 1px solid #d8d8d8; width: fit-content; font-style: italic; font-size: small;';

$fields = array(
	'enabled'                => array(
		'title'   => __( 'Enable/Disable', 'woocommerce' ),
		'type'    => 'checkbox',
		'label'   => __( 'Enable custom gateway', 'woocommerce-tinkoff-payment-gateways' ),
		'default' => 'no',
	),
	'title'                  => array(
		'title'       => __( 'Title', 'woocommerce' ),
		'type'        => 'text',
		'description' => __( 'This controls the title which the user sees during checkout.', 'woocommerce' ),
		'default'     => __( 'Tinkoff Payment Gateway', 'woocommerce-tinkoff-payment-gateways' ),
		'desc_tip'    => true,
	),
	'description'            => array(
		'title'       => __( 'Description', 'woocommerce' ),
		'type'        => 'textarea',
		'description' => __( 'Payment method description that the customer will see on your checkout.', 'woocommerce' ),
		'default'     => __( 'Tinkoff Payment Gateway Description.', 'woocommerce-tinkoff-payment-gateways' ),
		'desc_tip'    => true,
	),
	'instructions'           => array(
		'title'       => __( 'Instructions', 'woocommerce' ),
		'type'        => 'textarea',
		'description' => __( 'Instructions that will be added to the thank you page.', 'woocommerce-tinkoff-payment-gateways' ),
		'default'     => '',
		'desc_tip'    => true,
	),
	'instructions_in_email'  => array(
		'title'       => __( 'Email instructions', 'woocommerce-tinkoff-payment-gateways' ),
		'type'        => 'textarea',
		'description' => __( 'Instructions that will be added to the emails.', 'woocommerce-tinkoff-payment-gateways' ),
		'default'     => '',
		'desc_tip'    => true,
	),
	'icon'                   => array(
		'title'       => __( 'Icon', 'woocommerce-tinkoff-payment-gateways' ),
		'type'        => 'text',
		'desc_tip'    => __( 'If you want to show an image next to the gateway\'s name on the frontend, enter a URL to an image.', 'woocommerce-tinkoff-payment-gateways' ),
		'default'     => '',
		'description' => $icon_desc,
		'css'         => 'width:100%',
	),
	'advanced_options'       => array(
		'title' => __( 'Advanced Options', 'woocommerce-tinkoff-payment-gateways' ),
		'type'  => 'title',
	),
	'promocode'       => array(
		'title'       => __( 'Promocode', 'woocommerce-tinkoff-payment-gateways' ),
		'type'        => 'text',
		'desc_tip'    => __( 'Cпециальный промокод для оформления рассрочек и оплаты частями, если нужно работать не только с кредитами.', 'woocommerce-tinkoff-payment-gateways' ),
		'default'     => '',
		'css'         => 'width:100%',
	),	
	'min_amount'             => array(
		'title'             => __( 'Minimum order amount', 'woocommerce-tinkoff-payment-gateways' ),
		'type'              => 'number',
		'desc_tip'          => __( 'If you want to set minimum order amount (excluding fees) to show this gateway on frontend, enter a number here. Set to 0 to disable.', 'woocommerce-tinkoff-payment-gateways' ),
		'default'           => 0,
		'description'       => apply_filters(
			'alg_wc_tinkoff_payment_gateways_settings',
			sprintf(
				'<div style="' . $div_style . '">You will need <a target="_blank" href="%s">Tinkoff Payment Gateways for WooCommerce Pro plugin</a> to use minimum order amount option.</div>',
				'https://github.com/ivannikitin-com/woocommerce-tinkoff-payment-gateways'
			)
		),
		'custom_attributes' => apply_filters( 'alg_wc_tinkoff_payment_gateways_settings', array( 'disabled' => 'disabled' ), 'array_min_amount' ),
	),
	'enable_for_methods'     => array(
		'title'             => __( 'Enable for shipping methods', 'woocommerce' ),
		'type'              => 'multiselect',
		'class'             => 'chosen_select',
		'default'           => '',
		'description'       => __( 'If gateway is only available for certain shipping methods, set it up here. Leave blank to enable for all methods.', 'woocommerce-tinkoff-payment-gateways' ),
		'options'           => $shipping_methods,
		'desc_tip'          => true,
		'custom_attributes' => array( 'data-placeholder' => __( 'Select shipping methods', 'woocommerce' ) ),
	),
	'enable_for_virtual'     => array(
		'title'       => __( 'Accept for virtual orders', 'woocommerce' ),
		'label'       => __( 'Accept', 'woocommerce-tinkoff-payment-gateways' ),
		'description' => __( 'Accept gateway if the order is virtual.', 'woocommerce-tinkoff-payment-gateways' ),
		'type'        => 'checkbox',
		'default'     => 'yes',
	),
	'default_order_status'   => array(
		'title'       => __( 'Default order status', 'woocommerce-tinkoff-payment-gateways' ),
		'description' => sprintf(
			'In case you need more custom order statuses - we suggest using free <a target="_blank" href="%s">Order Status for WooCommerce plugin</a>.',
			'https://wordpress.org/plugins/custom-order-statuses-woocommerce/'
		),
		'default'     => apply_filters( 'woocommerce_default_order_status', 'pending' ),
		'type'        => 'select',
		'class'       => 'chosen_select',
		'options'     => alg_wc_tinkoff_payment_gateways_get_order_statuses(),
	),
	'send_email_to_admin'    => array(
		'title'       => __( 'Send additional emails', 'woocommerce-tinkoff-payment-gateways' ),
		'description' => sprintf(
			// translators: %s points a link to new order email settings.
			__( 'This may help if you are using pending or custom default order status and not receiving %s emails.', 'woocommerce-tinkoff-payment-gateways' ),
			'<a target="_blank" href="' . admin_url( 'admin.php?page=wc-settings&tab=email&section=wc_email_new_order' ) . '">' .
			__( 'admin new order', 'woocommerce-tinkoff-payment-gateways' ) . '</a>'
		),
		'label'       => __( 'Send to admin', 'woocommerce-tinkoff-payment-gateways' ),
		'default'     => 'no',
		'type'        => 'checkbox',
	),
	'send_email_to_customer' => array(
		'label'       => __( 'Send to customer', 'woocommerce-tinkoff-payment-gateways' ),
		'description' => sprintf(
			// translators: %s points a link to processing order email settings.
			__( 'This may help if you are using pending or custom default order status and not receiving %s emails.', 'woocommerce-tinkoff-payment-gateways' ),
			'<a target="_blank" href="' . admin_url( 'admin.php?page=wc-settings&tab=email&section=wc_email_customer_processing_order' ) . '">' .
			__( 'customer processing order', 'woocommerce-tinkoff-payment-gateways' ) . '</a>'
		),
		'default'     => 'no',
		'type'        => 'checkbox',
	),
	'custom_return_url'      => array(
		'title'       => __( 'Custom return URL (Thank You page)', 'woocommerce-tinkoff-payment-gateways' ),
		'label'       => __( 'URL', 'woocommerce-tinkoff-payment-gateways' ),
		'desc_tip'    => __( 'Enter full URL with http(s).', 'woocommerce-tinkoff-payment-gateways' ),
		'description' => __( 'Optional. Leave blank to use default URL.', 'woocommerce-tinkoff-payment-gateways' ) . ' ' .
			sprintf(
				// translators: %s Available placeholders.
				__( 'Available placeholders: %s.', 'woocommerce-tinkoff-payment-gateways' ),
				'<code>' . implode( '</code>, <code>', array( '%order_id%', '%order_key%', '%order_total%' ) ) . '</code>'
			),
		'default'     => '',
		'type'        => 'text',
		'css'         => 'width:100%',
	),
);
if ( 'yes' === get_option( 'alg_wc_cpg_fees_enabled', 'yes' ) ) {
	$fields = array_merge(
		$fields,
		array(
			'fees_options' => array(
				'title'       => __( 'Fees Options', 'woocommerce-tinkoff-payment-gateways' ),
				'type'        => 'title',
				'description' => __( 'This section allows you to set extra checkout fees.', 'woocommerce-tinkoff-payment-gateways' ) . ' ' .
					sprintf(
						// translators: %s points a link to CPG General settings.
						__( 'General options are in %s.', 'woocommerce-tinkoff-payment-gateways' ),
						'<a href="' . admin_url( 'admin.php?page=wc-settings&tab=alg_wc_tinkoff_payment_gateways&section=fees' ) . '" target="_blank">' .
						__( 'WooCommerce > Settings > Tinkoff Payment Gateways > Fees', 'woocommerce-tinkoff-payment-gateways' ) . '</a>'
					),
			),
			'fees_total'   => array(
				'title'             => __( 'Number of fees', 'woocommerce-tinkoff-payment-gateways' ),
				'desc_tip'          => __( 'Save changes to see new options.', 'woocommerce-tinkoff-payment-gateways' ),
				'description'       => apply_filters(
					'alg_wc_tinkoff_payment_gateways_settings',
					sprintf(
						'<div style="' . $div_style . '">You will need <a target="_blank" href="%s">Tinkoff Payment Gateways for WooCommerce Pro plugin</a> to add more than one fee.</div>',
						'https://github.com/ivannikitin-com/woocommerce-tinkoff-payment-gateways'
					),
					'total_number'
				),
				'default'           => 1,
				'type'              => 'number',
				'custom_attributes' => apply_filters( 'alg_wc_tinkoff_payment_gateways_settings', array( 'readonly' => 'readonly' ), 'array_fees' ),
			),
		)
	);
	for ( $i = 1; $i <= apply_filters( 'alg_wc_tinkoff_payment_gateways_values', 1, 'total_fees', $this ); $i++ ) { // phpcs:ignore
		$fields = array_merge(
			$fields,
			array(
				'fee_enabled_' . $i    => array(
					// translators: %s points to Fee number.
					'title'   => sprintf( __( 'Fee %s', 'woocommerce-tinkoff-payment-gateways' ), '#' . $i ),
					'label'   => __( 'Enabled', 'woocommerce-tinkoff-payment-gateways' ),
					'type'    => 'checkbox',
					'default' => 'yes',
				),
				'fee_name_' . $i       => array(
					'description' => __( 'Title', 'woocommerce-tinkoff-payment-gateways' ),
					'desc_tip'    => __( 'Name for the fee.', 'woocommerce-tinkoff-payment-gateways' ) . ' ' .
						__( 'Multiple fees of the same name will be merged into one (with tax options from the first fee).', 'woocommerce-tinkoff-payment-gateways' ),
					'type'        => 'text',
					'default'     => '',
				),
				'fee_type_' . $i       => array(
					'description' => __( 'Type', 'woocommerce-tinkoff-payment-gateways' ),
					'desc_tip'    => __( 'Percent is calculated from cart total.', 'woocommerce-tinkoff-payment-gateways' ),
					'type'        => 'select',
					'class'       => 'chosen_select',
					'default'     => 'fixed',
					'options'     => array(
						'fixed'   => __( 'Fixed', 'woocommerce-tinkoff-payment-gateways' ),
						'percent' => __( 'Percent', 'woocommerce-tinkoff-payment-gateways' ),
					),
				),
				'fee_amount_' . $i     => array(
					'description'       => __( 'Amount', 'woocommerce-tinkoff-payment-gateways' ),
					'desc_tip'          => __( 'Fee amount.', 'woocommerce-tinkoff-payment-gateways' ) . ' ' .
						__( 'This field is required.', 'woocommerce-tinkoff-payment-gateways' ),
					'type'              => 'number',
					'default'           => '',
					'custom_attributes' => array(
						'step' => '0.00001',
						'min'  => 0,
					),
				),
				'fee_amount_min_' . $i => array(
					'description'       => __( 'Min amount', 'woocommerce-tinkoff-payment-gateways' ),
					'desc_tip'          => __( 'Minimum fee amount.', 'woocommerce-tinkoff-payment-gateways' ) . ' ' .
						__( 'Used for "Percent" type fees.', 'woocommerce-tinkoff-payment-gateways' ),
					'type'              => 'number',
					'default'           => '',
					'custom_attributes' => array(
						'step' => '0.00001',
						'min'  => 0,
					),
				),
				'fee_amount_max_' . $i => array(
					'description'       => __( 'Max amount', 'woocommerce-tinkoff-payment-gateways' ),
					'desc_tip'          => __( 'Maximum fee amount.', 'woocommerce-tinkoff-payment-gateways' ) . ' ' .
						__( 'Used for "Percent" type fees.', 'woocommerce-tinkoff-payment-gateways' ),
					'type'              => 'number',
					'default'           => '',
					'custom_attributes' => array(
						'step' => '0.00001',
						'min'  => 0,
					),
				),
				'fee_taxable_' . $i    => array(
					'label'    => __( 'Taxable', 'woocommerce-tinkoff-payment-gateways' ),
					'desc_tip' => __( 'Is the fee taxable?', 'woocommerce-tinkoff-payment-gateways' ),
					'type'     => 'checkbox',
					'default'  => 'no',
				),
				'fee_tax_class_' . $i  => array(
					'description' => __( 'Tax class', 'woocommerce-tinkoff-payment-gateways' ),
					'desc_tip'    => __( 'The tax class for the fee if taxable. A blank string is standard tax class.', 'woocommerce-tinkoff-payment-gateways' ),
					'type'        => 'text',
					'default'     => '',
				),
				'fee_cart_min_' . $i   => array(
					'description'       => __( 'Min cart total', 'woocommerce-tinkoff-payment-gateways' ),
					'desc_tip'          => __( 'Minimum cart total for fee to be applied.', 'woocommerce-tinkoff-payment-gateways' ),
					'type'              => 'number',
					'default'           => '',
					'custom_attributes' => array(
						'step' => '0.00001',
						'min'  => 0,
					),
				),
				'fee_cart_max_' . $i   => array(
					'description'       => __( 'Max cart total', 'woocommerce-tinkoff-payment-gateways' ),
					'desc_tip'          => __( 'Maximum cart total for fee to be applied.', 'woocommerce-tinkoff-payment-gateways' ),
					'type'              => 'number',
					'default'           => '',
					'custom_attributes' => array(
						'step' => '0.00001',
						'min'  => 0,
					),
				),
			)
		);
	}
}
if ( 'yes' === get_option( 'alg_wc_cpg_input_fields_enabled', 'yes' ) ) {
	$fields = array_merge(
		$fields,
		array(
			'input_fields_options' => array(
				'title'       => __( 'Input Fields Options', 'woocommerce-tinkoff-payment-gateways' ),
				'type'        => 'title',
				'description' => __( 'This section allows you to collect data from customers on checkout.', 'woocommerce-tinkoff-payment-gateways' ) . ' ' .
					sprintf(
						// translators: %s points a link to General settings of CPG.
						__( 'General options are in %s.', 'woocommerce-tinkoff-payment-gateways' ),
						'<a href="' . admin_url( 'admin.php?page=wc-settings&tab=alg_wc_tinkoff_payment_gateways&section=input_fields' ) . '" target="_blank">' .
						__( 'WooCommerce > Settings > Tinkoff Payment Gateways > Input Fields', 'woocommerce-tinkoff-payment-gateways' ) . '</a>'
					),
			),
			'input_fields_total'   => array(
				'title'             => __( 'Number of input fields', 'woocommerce-tinkoff-payment-gateways' ),
				'desc_tip'          => __( 'Save changes to see new options.', 'woocommerce-tinkoff-payment-gateways' ),
				'description'       => apply_filters(
					'alg_wc_tinkoff_payment_gateways_settings',
					sprintf(
						'<div style="' . $div_style . '">You will need <a target="_blank" href="%s">Tinkoff Payment Gateways for WooCommerce Pro plugin</a> to add more than one input field.</div>',
						'https://github.com/ivannikitin-com/woocommerce-tinkoff-payment-gateways'
					),
					'total_number'
				),
				'default'           => 1,
				'type'              => 'number',
				'custom_attributes' => apply_filters( 'alg_wc_tinkoff_payment_gateways_settings', array( 'readonly' => 'readonly' ), 'array_input_fields' ),
			),
		)
	);
	for ( $i = 1; $i <= apply_filters( 'alg_wc_tinkoff_payment_gateways_values', 1, 'total_input_fields', $this ); $i++ ) { // phpcs:ignore
		$fields = array_merge(
			$fields,
			array(
				'input_fields_title_' . $i       => array(
					// translators: %s Input Field Number.
					'title'       => sprintf( __( 'Input field #%s', 'woocommerce-tinkoff-payment-gateways' ), $i ),
					'description' => __( 'Title', 'woocommerce-tinkoff-payment-gateways' ) . ' (' . __( 'required', 'woocommerce-tinkoff-payment-gateways' ) . ')',
					'desc_tip'    => __( 'The field will not be added to the frontend, if no title is set.', 'woocommerce-tinkoff-payment-gateways' ),
					'default'     => '',
					'type'        => 'text',
					'css'         => 'width:100%;',
				),
				'input_fields_required_' . $i    => array(
					'label'       => __( 'Required', 'woocommerce-tinkoff-payment-gateways' ),
					'description' => __( 'Is field required to fill in on checkout', 'woocommerce-tinkoff-payment-gateways' ),
					'default'     => 'no',
					'type'        => 'checkbox',
				),
				'input_fields_type_' . $i        => array(
					'description' => __( 'Type', 'woocommerce-tinkoff-payment-gateways' ),
					'default'     => 'text',
					'type'        => 'select',
					'class'       => 'chosen_select',
					'options'     => array(
						'text'     => __( 'Text', 'woocommerce-tinkoff-payment-gateways' ),
						'number'   => __( 'Number', 'woocommerce-tinkoff-payment-gateways' ),
						'select'   => __( 'Select (drop-down list)', 'woocommerce-tinkoff-payment-gateways' ),
						'color'    => __( 'Color', 'woocommerce-tinkoff-payment-gateways' ),
						'date'     => __( 'Date', 'woocommerce-tinkoff-payment-gateways' ),
						'email'    => __( 'Email', 'woocommerce-tinkoff-payment-gateways' ),
						'range'    => __( 'Range', 'woocommerce-tinkoff-payment-gateways' ),
						'tel'      => __( 'Tel', 'woocommerce-tinkoff-payment-gateways' ),
						'time'     => __( 'Time', 'woocommerce-tinkoff-payment-gateways' ),
						'url'      => __( 'URL', 'woocommerce-tinkoff-payment-gateways' ),
						'week'     => __( 'Week', 'woocommerce-tinkoff-payment-gateways' ),
						'month'    => __( 'Month', 'woocommerce-tinkoff-payment-gateways' ),
						'password' => __( 'Password', 'woocommerce-tinkoff-payment-gateways' ),
						'checkbox' => __( 'Checkbox', 'woocommerce-tinkoff-payment-gateways' ),
						'textarea' => __( 'Textarea', 'woocommerce-tinkoff-payment-gateways' ),
					),
				),
				'input_fields_placeholder_' . $i => array(
					'description' => __( 'Placeholder', 'woocommerce-tinkoff-payment-gateways' ) . ' (' . __( 'optional', 'woocommerce-tinkoff-payment-gateways' ) . ')',
					'default'     => '',
					'type'        => 'text',
					'css'         => 'width:100%;',
				),
				'input_fields_class_' . $i       => array(
					'description' => __( 'Class', 'woocommerce-tinkoff-payment-gateways' ) . ' (' . __( 'optional', 'woocommerce-tinkoff-payment-gateways' ) . ')',
					'default'     => '',
					'type'        => 'text',
					'css'         => 'width:100%;',
				),
				'input_fields_value_' . $i       => array(
					'description' => __( 'Default value', 'woocommerce-tinkoff-payment-gateways' ) . ' (' . __( 'optional', 'woocommerce-tinkoff-payment-gateways' ) . ')',
					'default'     => '',
					'type'        => 'text',
					'css'         => 'width:100%;',
				),
				'input_fields_options_' . $i     => array(
					'description' => __( 'Options', 'woocommerce-tinkoff-payment-gateways' ) . ' (' . __( 'for "Select" type; one option per line', 'woocommerce-tinkoff-payment-gateways' ) . ')',
					'default'     => '',
					'type'        => 'textarea',
					'css'         => 'width:100%;',
				),
			)
		);
	}
}
return $fields;
