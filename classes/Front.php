<?php

namespace Art\WoocommerceBulkVariationsAddons;

class Front {

	public function init_hooks(): void {

		add_filter( 'wc_bulk_variations_qty_input_html', [ $this, 'quantity_buttons' ], 10, 3 );
	}


	public function quantity_buttons( $input, $attrs, $variation ): string {

		$button_minus = '<input type="button" value="-" class="minus">';
		$button_plus  = '<input type="button" value="+" class="plus">';

		return $button_minus . $input . $button_plus;
	}
}