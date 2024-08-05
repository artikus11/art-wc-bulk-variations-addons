<?php

namespace Art\WoocommerceBulkVariationsAddons;

use Barn2\Plugin\WC_Bulk_Variations\Frontend_Scripts;

class Enqueue {

	protected Main $main;


	public function __construct( Main $main ) {

		$this->main = $main;
	}


	public function init_hooks(): void {

		add_action( 'wp_enqueue_scripts', [ $this, 'enqueue' ], 100 );
	}


	public function enqueue(): void {

		wp_register_style(
			'awbva-styles',
			$this->main->get_url_assets() . 'css/awbva-styles' . $this->main->get_suffix() . '.css',
			[ Frontend_Scripts::SCRIPT_HANDLE ],
			AWBVA_PLUGIN_VER
		);

		wp_enqueue_style( 'awbva-styles' );
		wp_register_script(
			'afb-scripts',
			AFB_PLUGIN_URI . 'assets/js/afb-scripts' . $this->suffix . '.js',
			[ 'jquery' ],
			AFB_PLUGIN_VER,
			true
		);*/
	}

}
