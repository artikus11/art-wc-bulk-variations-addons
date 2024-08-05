<?php

namespace Art\WoocommerceBulkVariationsAddons;

class Main {

	protected string $suffix;


	protected string $url;


	protected string $path;


	protected string $url_assets;


	protected string $path_assets;


	public function __construct() {

		$this->suffix = defined( 'SCRIPT_DEBUG' ) && SCRIPT_DEBUG ? '' : '.min';

		$this->url  = AWBVA_PLUGIN_URI;
		$this->path = AWBVA_PLUGIN_FILE;

		$this->url_assets  = $this->url . '/assets/';
		$this->path_assets = $this->path . '/assets/';
	}


	public function init(): void {

		add_action( 'plugins_loaded', [ $this, 'init_all' ], - PHP_INT_MAX );
	}


	public function init_all(): void {

		( new Enqueue( $this ) )->init_hooks();
		(new Front())->init_hooks();
	}


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


	/**
	 * @return string
	 */
	public function get_suffix(): string {

		return $this->suffix;
	}


	/**
	 * @return string
	 */
	public function get_url_assets(): string {

		return $this->url_assets;
	}


	/**
	 * @return string
	 */
	public function get_path_assets(): string {

		return $this->path_assets;
	}

}
