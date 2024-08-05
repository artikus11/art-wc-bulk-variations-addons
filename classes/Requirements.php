<?php

namespace Art\WoocommerceBulkVariationsAddons;

use Barn2\Plugin\WC_Bulk_Variations\Plugin_Factory;

class Requirements {

	/**
	 * @var array[]
	 */
	private array $required_plugins;


	protected Main $main;


	public function __construct( Main $main ) {

		$this->required_plugins = [
			[
				'plugin'  => 'woocommerce-bulk-variations/woocommerce-bulk-variations.php',
				'name'    => 'WooCommerce Bulk Variations',
				'slug'    => 'woocommerce-bulk-variations',
				'class'   => 'Plugin_Factory',
				'version' => '2.3',
				'active'  => false,
			],
			[
				'plugin'  => 'woocommerce/woocommerce.php',
				'name'    => 'WooCommerce',
				'slug'    => 'woocommerce',
				'class'   => 'WooCommerce',
				'version' => '8.0',
				'active'  => false,
			],
		];

		$this->main = $main;
	}


	public function init(): void {

		add_action( 'admin_init', [ $this, 'check_requirements' ] );

		foreach ( $this->required_plugins as $required_plugin ) {
			if ( ! class_exists( $required_plugin['class'] ) ) {
				return;
			}
		}
	}


	/**
	 * Check plugin requirements. If not met, show message and deactivate plugin.
	 *
	 * @since 1.0.0
	 */
	public function check_requirements(): void {

		if ( false === $this->requirements() ) {
			$this->deactivation_plugin();
		}
	}


	/**
	 * Сообщение при деактивации плагина
	 */
	public function deactivation_plugin(): void {

		add_action( 'admin_notices', [ $this, 'show_plugin_not_found_notice' ] );

		if ( is_plugin_active( AWBVA_PLUGIN_FILE ) ) {

			deactivate_plugins( AWBVA_PLUGIN_FILE );
			// @codingStandardsIgnoreStart
			if ( isset( $_GET['activate'] ) ) {
				unset( $_GET['activate'] );
			}
			// @codingStandardsIgnoreEnd
			add_action( 'admin_notices', [ $this, 'show_deactivate_notice' ] );
		}
	}


	public function show_plugin_not_found_notice(): void {

		$message = sprintf(
		/* translators: 1: Name author plugin */
			__( 'The <strong>%s</strong> requires installed and activated plugins: ', 'art-woocommerce-order-fast' ),
			esc_attr( AWBVA_PLUGIN_NAME )
		);

		$message_parts = [];

		foreach ( $this->required_plugins as $key => $required_plugin ) {
			if ( ! $required_plugin['active'] ) {
				$href = '/wp-admin/plugin-install.php?tab=plugin-information&plugin=';

				$href .= sprintf( '%s&TB_iframe=true&width=640&height=500', $required_plugin['slug'] );

				$message_parts[] = sprintf(
					'<strong><em><a href="%s" class="thickbox">%s%s%s</a>%s</em></strong>',
					$href,
					$required_plugin['name'],
					__( ' version ', 'art-woocommerce-order-fast' ),
					$required_plugin['version'],
					__( ' or higher', 'art-woocommerce-order-fast' )
				);
			}
		}

		$count = count( $message_parts );

		foreach ( $message_parts as $key => $message_part ) {
			if ( 0 !== $key ) {
				if ( ( ( $count - 1 ) === $key ) ) {
					$message .= __( ' and ', 'art-woocommerce-order-one-click' );
				} else {
					$message .= ', ';
				}
			}

			$message .= $message_part;
		}

		$message .= '.';

		$this->admin_notice( $message, 'notice notice-error is-dismissible' );
	}


	/**
	 * Show a notice to inform the user that the plugin has been deactivated.
	 *
	 * @since 2.0.0
	 */
	public function show_deactivate_notice(): void {

		$message = sprintf(
		/* translators: 1: Name author plugin */
			__( '<strong>%s</strong> plugin has been deactivated.', 'art-woocommerce-order-one-click' ),
			esc_attr( AWBVA_PLUGIN_NAME )
		);

		$this->admin_notice( $message, 'notice notice-warning is-dismissible' );
	}


	private function admin_notice( $message, $classes ): void {

		printf(
			'<div class="%1$s"><p><span>%2$s</span></p></div>',
			esc_attr( $classes ),
			wp_kses_post( $message )
		);
	}


	/**
	 * Check if plugin requirements.
	 *
	 * @return bool
	 * @since 1.0.0
	 */
	public function requirements(): bool {

		$all_active = true;

		include_once ABSPATH . 'wp-admin/includes/plugin.php';

		foreach ( $this->required_plugins as $key => $required_plugin ) {

			if ( is_plugin_active( $required_plugin['plugin'] ) ) {
				$this->required_plugins[ $key ]['active'] = true;
			} else {
				$all_active = false;
			}
		}

		return $all_active;
	}
}
