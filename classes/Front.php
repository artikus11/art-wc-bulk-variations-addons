<?php

namespace Art\WoocommerceBulkVariationsAddons;

class Front {

	public function init_hooks(): void {

		add_filter( 'wc_bulk_variations_qty_input_html', [ $this, 'quantity_buttons' ], 10, 3 );
	}


	public function quantity_buttons( $input, $attrs, $variation ): string {

		if ( ! wp_is_mobile() ) {
			return $input;
		}

		$button_minus = '<button type="button" class="minus">-</button>';
		$button_plus  = '<button type="button" class="plus">+</button>';

		return $button_minus . $input . $button_plus;
	}
}