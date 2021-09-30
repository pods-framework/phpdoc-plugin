<?php
/**
 * Plugin Name: phpDoc Plugin
 * Plugin URI: https://github.com/pods-framework/phpdoc-plugin
 * Description: A companion plugin for docs parsing with the PHPDoc Parser.
 * Author: Pods Framework Team
 * Author URI: https://pods.io/about/
 * Version: 0.0.1
 * Requires at least: 5.8
 * Text Domain: phpdoc-plugin
 *
 * @package Pods\phpDoc_Plugin
 */

namespace Pods\phpDoc_Plugin;

define( 'PHPDOC_PLUGIN_FILE', __FILE__ );
define( 'PHPDOC_PLUGIN_VERSION', '0.0.1' );

// Support for site-level autoloading.
if ( file_exists( __DIR__ . '/vendor/autoload.php' ) ) {
	require_once __DIR__ . '/vendor/autoload.php';
}

/**
 * Main plugin class.
 */
class Bootstrap {
	/**
	 * Run when plugins have been loaded.
	 */
	public function plugins_loaded() {
		$plugin = new Plugin();

		// Run any actions for theme init.
		add_action( 'after_setup_theme', array( $plugin, 'after_setup_theme' ) );

		// Init the plugin.
		add_action( 'init', array( $plugin, 'init' ) );
	}
}

$phpdoc_plugin = new Bootstrap();
register_activation_hook( __FILE__, array( '\Pods\phpDoc_Plugin\Plugin', 'register_activation_hook' ) );

add_action( 'plugins_loaded', array( $phpdoc_plugin, 'plugins_loaded' ) );
