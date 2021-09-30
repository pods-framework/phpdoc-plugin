<?php
/**
 * Plugin Utility class.
 *
 * @package Pods\phpDoc_Plugin
 */

namespace Pods\phpDoc_Plugin;

/**
 * Plugin utility class.
 */
class Plugin {

	/**
	 * Absolute path to the main plugin file.
	 *
	 * @var string
	 */
	protected $file;

	/**
	 * Absolute path to the root directory of this plugin.
	 *
	 * @var string
	 */
	protected $dir;

	/**
	 * Setup the plugin.
	 */
	public function __construct() {
		$this->file = PHPDOC_PLUGIN_FILE;
		$this->dir  = dirname( PHPDOC_PLUGIN_FILE );
	}

	/**
	 * Plugin init function.
	 *
	 * @see WP init action.
	 */
	public function init() {
		// Create post types.
		PostTypes::create();

		// Add taxonomies.
		Taxonomies::create();

		// Init Posts to Posts.
		PostsToPosts::register_post_relationships();
	}

	/**
	 * After a theme's functions.php file has been run.
	 *
	 * @see WP after_setup_theme action.
	 */
	public function after_setup_theme() {
		// Remove post types registered by theme.
		global $explanations;
		remove_action( 'init', array( 'DevHub_CLI', 'action_init_register_post_types' ) );
		remove_action( 'init', array( 'DevHub_Registrations', 'do_init' ), 10 );
		remove_action( 'init', array( $explanations, 'register_post_type' ), 0 );
	}

	/**
	 * Is WP debug mode enabled.
	 *
	 * @return boolean
	 */
	public static function is_debug() {
		return ( defined( 'WP_DEBUG' ) && WP_DEBUG );
	}

	/**
	 * Is WP script debug mode enabled.
	 *
	 * @return boolean
	 */
	public static function is_script_debug() {
		return ( defined( 'SCRIPT_DEBUG' ) && SCRIPT_DEBUG );
	}

	/**
	 * Sync the plugin version with the asset version.
	 *
	 * @return string
	 */
	public static function asset_version() {
		if ( self::is_debug() || self::is_script_debug() ) {
			return time();
		}

		return self::get_plugin_version();
	}

	/**
	 * Return the plugin slug.
	 *
	 * @return string plugin slug.
	 */
	public static function get_plugin_slug() {
		return dirname( plugin_basename( PHPDOC_PLUGIN_FILE ) );
	}

	/**
	 * Return the basefile for the plugin.
	 *
	 * @return string base file for the plugin.
	 */
	public static function get_plugin_file() {
		return plugin_basename( PHPDOC_PLUGIN_FILE );
	}

	/**
	 * Return the version for the plugin.
	 *
	 * @return float version for the plugin.
	 */
	public static function get_plugin_version() {
		return PHPDOC_PLUGIN_VERSION;
	}

	/**
	 * Get the plugin directory for a path.
	 *
	 * @param string $path The path to the file.
	 *
	 * @return string The new path.
	 */
	public static function get_plugin_dir( $path = '' ) {
		$dir = rtrim( plugin_dir_path( PHPDOC_PLUGIN_FILE ), '/' );
		if ( ! empty( $path ) && is_string( $path ) ) {
			$dir .= '/' . ltrim( $path, '/' );
		}
		return $dir;
	}

	/**
	 * Return a plugin URL path.
	 *
	 * @param string $path Path to the file.
	 *
	 * @return string URL to to the file.
	 */
	public static function get_plugin_url( $path = '' ) {
		$dir = rtrim( plugin_dir_url( PHPDOC_PLUGIN_FILE ), '/' );
		if ( ! empty( $path ) && is_string( $path ) ) {
			$dir .= '/' . ltrim( $path, '/' );
		}
		return $dir;
	}

	/**
	 * Checks if the plugin is on a multisite install.
	 *
	 * @since 0.0.1
	 *
	 * @param bool $network_admin Check if in network admin.
	 *
	 * @return true if multisite, false if not.
	 */
	public static function is_multisite( $network_admin = false ) {
		if ( ! function_exists( 'is_plugin_active_for_network' ) ) {
			require_once ABSPATH . '/wp-admin/includes/plugin.php';
		}
		$is_network_admin = false;
		if ( $network_admin ) {
			if ( is_network_admin() ) {
				if ( is_multisite() && is_plugin_active_for_network( self::get_plugin_slug() ) ) {
					return true;
				}
			} else {
				return false;
			}
		}
		if ( is_multisite() && is_plugin_active_for_network( self::get_plugin_slug() ) ) {
			return true;
		}
		return false;
	}

	/**
	 * Checks to see if an asset is activated or not.
	 *
	 * @since 0.0.1
	 *
	 * @param string $path Path to the asset.
	 * @param string $type Type to check if it is activated or not.
	 *
	 * @return bool true if activated, false if not.
	 */
	public static function is_activated( $path, $type = 'plugin' ) {

		// Gets all active plugins on the current site.
		$active_plugins = self::is_multisite() ? get_site_option( 'active_sitewide_plugins' ) : get_option( 'active_plugins', array() );
		if ( in_array( $path, $active_plugins, true ) ) {
			return true;
		}
		return false;
	}
}
