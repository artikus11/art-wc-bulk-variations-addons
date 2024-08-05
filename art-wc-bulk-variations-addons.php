<?php
/**
 * Plugin Name: Art WC Bulk Variations Addons
 * Plugin URI: wpruse.ru
 * Text Domain: art-wc-bulk-variations-addons
 * Domain Path: /languages
 * Description: Дополнение к плагину WooCommerce Bulk Variations. Добавлется ± для инпутов на странице товара
 * Version: 1.0.0
 * Author: Artem Abramovich
 * Author URI: https://wpruse.ru/
 * License: GPL-2.0+
 * License URI: http://www.gnu.org/licenses/gpl-2.0.txt
 *
 *
 * WC requires at least: 8.0.0
 * WC tested up to: 8.0
 *
 * RequiresWP: 6.0
 * RequiresPHP: 8.0
 */

const AWBVA_PLUGIN_DIR       = __DIR__;
const AWBVA_PLUGIN_AFILE     = __FILE__;
const AWBVA_PLUGIN_VER       = '1.0.0';
const AWBVA_PLUGIN_SLUG      = 'art-wc-bulk-variations-addons';
const AWBVA_PLUGIN_TEPMLATES = 'templates';

define( 'AWBVA_PLUGIN_URI', untrailingslashit( plugin_dir_url( ACL_PLUGIN_AFILE ) ) );
define( 'AWBVA_PLUGIN_FILE', plugin_basename( __FILE__ ) );

require AWBVA_PLUGIN_DIR . '/vendor/autoload.php';