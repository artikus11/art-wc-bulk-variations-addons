jQuery( document ).ready( function ( $ ) {

	$( '.wcbvp-form-variation' ).on( 'click', 'button.plus, button.minus', function ( e ) {

		// Get values
		let $qty       = $( this ).closest( '.wcbvp-form-variation' ).find( 'input[name="input_quantity"]' ),
		    currentVal = parseFloat( $qty.val() ),
		    max        = parseFloat( $qty.attr( 'max' ) ),
		    min        = parseFloat( $qty.attr( 'min' ) ),
		    step       = $qty.attr( 'step' );

		// Format values
		if ( ! currentVal || currentVal === '' || currentVal === 'NaN' ) {
			currentVal = 0;
		}
		if ( max === '' || max === 'NaN' ) {
			max = '';
		}
		if ( min === '' || min === 'NaN' ) {
			min = 0;
		}
		if ( step === 'any' || step === '' || step === undefined || parseFloat( step ) === 'NaN' ) {
			step = 1;
		}

		// Change the value
		if ( $( this ).is( '.plus' ) ) {

			if ( max && (
				max === currentVal || currentVal > max
			) ) {
				$qty.val( max );
			} else {
				$qty.val( currentVal + parseFloat( step ) );
			}

		} else {

			if ( min && (
				min === currentVal || currentVal < min
			) ) {
				$qty.val( min );
			} else if ( currentVal > 0 ) {
				$qty.val( currentVal - parseFloat( step ) );
			}

		}

		$qty.trigger( 'input' );


		WCBulkVariations.recalculate();
	} );


} );

