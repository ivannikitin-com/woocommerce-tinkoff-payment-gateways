document.getElementById( "alg_tinkoff_gateway_' . $id_count.'" ).onclick = function( event ) {
	console.log( event.target );
	event.target.closest( "label" ).click();
	let params = {
		sum: '.$result_sum.',
		items: '.$products_str.',
		demoFlow: "sms",
		promoCode: "'.$this->promocode.'",
		shopId: "'.get_option('alg_wc_tinkoff_payment_gateways_shop_id').'",
		showcaseId: "'.get_option('alg_wc_tinkoff_payment_gateways_showcase_id').'"
	}
	let billingLastName = document.getElementById( "billing_last_name" ).value;
	let billingFirstName = document.getElementById( "billing_first_name" ).value;
	let mobilePhone = document.getElementById( "billing_phone" ).value;
	let billingEmail = document.getElementById( "billing_email" ).value;

	if ( ( billingLastName !== "" ) && ( billingFirstName !== "" ) && ( billingPhone !== "" ) && ( billingEmail !== "" ) ) {
		params.values = {
			contact: {
				fio: {
					lastName: billingLastName,
					firstName: billingFirstName,
					middelName: ""
				}
				mobilePhone: billingPhone.value,
				email: billingEmail
			}
		}
	}

	tinkoff.createDemo(
		params, { view: "modal" }
	);
}