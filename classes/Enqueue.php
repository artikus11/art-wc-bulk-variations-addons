<?php

namespace Art\WoocommerceBulkVariationsAddons;

class Enqueue {

	protected Main $main;


	public function __construct( Main $main ) {

		$this->main = $main;
	}


	public function init_hooks(): void {

		add_action( 'wp_enqueue_scripts', [ $this, 'enqueue' ], 100 );
	}


	public function enqueue(): void {

		/*wp_register_style(
			'afb-styles',
			AFB_PLUGIN_URI . 'assets/css/afb-styles' . $this->suffix . '.css',
			[],
			AFB_PLUGIN_VER
		);

		wp_register_script(
			'afb-scripts',
			AFB_PLUGIN_URI . 'assets/js/afb-scripts' . $this->suffix . '.js',
			[ 'jquery' ],
			AFB_PLUGIN_VER,
			true
		);*/
	}

}
