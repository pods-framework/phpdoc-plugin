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
		// todo - init actions here.
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
	 * Return the current version of the plugin.
	 *
	 * @return mixed
	 */
	public function version() {
		return $this->meta( 'Version' );
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
	 * Get plugin meta data.
	 *
	 * @param  string $field Optional field key.
	 *
	 * @return array|string|null
	 */
	public function meta( $field = null ) {
		static $meta;

		if ( ! isset( $meta ) ) {
			$meta = get_file_data( $this->file, array(), $field );
		}

		if ( isset( $field ) ) {
			if ( isset( $meta[ $field ] ) ) {
				return $meta[ $field ];
			}

			return null;
		}

		return $meta;
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
		return plugin_basename( PHPDOCPLUGIN_FILE );
	}

	/**
	 * Return the version for the plugin.
	 *
	 * @return float version for the plugin.
	 */
	public static function get_plugin_version() {
		return PHPDOCPLUGIN_VERSION;
	}

	/**
	 * Returns appropriate html for KSES.
	 *
	 * @param bool $svg Whether to add SVG data to KSES.
	 */
	public static function get_kses_allowed_html( $svg = true ) {
		$allowed_tags = wp_kses_allowed_html();

		$allowed_tags['nav']        = array(
			'class' => array(),
		);
		$allowed_tags['a']['class'] = array();

		if ( ! $svg ) {
			return $allowed_tags;
		}
		$allowed_tags['svg'] = array(
			'xmlns'       => array(),
			'fill'        => array(),
			'viewbox'     => array(),
			'role'        => array(),
			'aria-hidden' => array(),
			'focusable'   => array(),
			'class'       => array(),
		);

		$allowed_tags['path'] = array(
			'd'       => array(),
			'fill'    => array(),
			'opacity' => array(),
		);

		$allowed_tags['g'] = array();

		$allowed_tags['use'] = array(
			'xlink:href' => array(),
		);

		$allowed_tags['symbol'] = array(
			'aria-hidden' => array(),
			'viewBox'     => array(),
			'id'          => array(),
			'xmls'        => array(),
		);

		return $allowed_tags;
	}

	/**
	 * Get the plugin directory for a path.
	 *
	 * @param string $path The path to the file.
	 *
	 * @return string The new path.
	 */
	public static function get_plugin_dir( $path = '' ) {
		$dir = rtrim( plugin_dir_path( PHPDOCPLUGIN_FILE ), '/' );
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
		$dir = rtrim( plugin_dir_url( PHPDOCPLUGIN_FILE ), '/' );
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
