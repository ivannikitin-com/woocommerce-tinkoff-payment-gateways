/**
 * alg-wc-tinkoff-payment
-gateways.js
 *
 * @version 1.6.0
 * @since   1.6.0
 * @author  Imaginate Solutions
 */

jQuery(
	function() {
		function slowScroll( id ) {
			var offset = 0;
			$( 'html, body' ).animate( {
				scrollTop: $( id ).offset().top - offset
			}, 1000 );
			return false;
		}

		jQuery( 'body' ).on( 'click', 'li.wc_payment_method label', function() {
			jQuery( this ).closest( 'input[name="payment_method"' ).prop( 'checked', true );
			jQuery( 'body' ).trigger( 'update_checkout' );
		} );
		jQuery( 'body' ).on(
			'change',
			'input[name="payment_method"]',
			function() {
				jQuery( "#payment_message" ).remove();
				if ( jQuery( this ).closest( 'li' ).is( '[class^="wc_payment_method payment_method_alg_tinkoff_gateway_"]' ) ) {
					jQuery( '#place_order' ).attr( "disabled", true );
					//document.querySelector( "#payment h3" ).insertAdjacentHTML( 'afterEnd', '<div id="payment_message" style="color: red;text-align: center;">Вы выбрали оплату через кредит/рассрочку. Оформление заказа возможно только после оформления кредита/рассрочки.</div>' );
				} else {
					jQuery( '#place_order' ).attr( "disabled", false );
				}
			}

		);

		//jQuery( '#payment li[class^="payment_method_alg_tinkoff_gateway"]' ).each( function() {
		/*		jQuery( 'body' ).on( 'checked', jQuery( "#payment_method_alg_tinkoff_gateway_1" ), function() {
					console.log( "disabled" );
					jQuery( '#place_order' ).attr( "disabled", true );
				} );*/
		//} );

		tinkoff.methods.on( tinkoff.constants.SUCCESS, onMessage );
		tinkoff.methods.on( tinkoff.constants.REJECT, onMessage );
		tinkoff.methods.on( tinkoff.constants.CANCEL, onMessage );

		function onMessage( data ) {
			if ( ( data.type == tinkoff.constants.REJECTS ) || ( data.type == tinkoff.constants.CANCEL ) ) {
				document.querySelector( "#payment h3" ).insertAdjacentHTML( 'afterEnd', '<div id="payment_message" style="color: red;text-align: center;">Кредит/рассрочка не оформлены. Выберите другой способ оплаты.</div>' );
				slowScroll( "#payment" );
			}
			if ( data.type == tinkoff.constants.SUCCESS ) {
				jQuery( '#place_order' ).attr( "disabled", false );
			}
			/*			switch ( data.type ) {
							case tinkoff.constants.SUCCESS:
								console.log( 'SUCCESS', data.meta.iframe.url );
								break;
							case tinkoff.constants.REJECT:
								console.log( 'REJECT', data.meta.iframe.url );
								break;
							case tinkoff.constants.CANCEL:
								console.log( 'CANCEL', data.meta.iframe.url );
								break;
							default:
								return;
			}*/
			tinkoff.methods.off( tinkoff.constants.SUCCESS, onMessage );
			tinkoff.methods.off( tinkoff.constants.REJECT, onMessage );
			tinkoff.methods.off( tinkoff.constants.CANCEL, onMessage );
			data.meta.iframe.destroy();
		}

	} );