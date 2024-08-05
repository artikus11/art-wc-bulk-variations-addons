<?php

namespace Art\AWBVA;

class Main {

	public function init(): void {

		add_action( 'plugins_loaded', [ $this, 'init_all' ], - PHP_INT_MAX );
	}


	public function init_all(): void {}


	public function init_hooks(): void {

		add_action( 'before_woocommerce_init', static function () {

			if ( class_exists( \Automattic\WooCommerce\Utilities\FeaturesUtil::class ) ) {
				\Automattic\WooCommerce\Utilities\FeaturesUtil::declare_compatibility(
					'custom_order_tables',
					AWBVA_PLUGIN_FILE,
					true
				);
			}
		} );
	}

}
