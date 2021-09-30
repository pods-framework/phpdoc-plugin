<?php
/**
 * Register rewrite rules.
 *
 * @package Pods\phpDoc_Plugin
 */

namespace Pods\phpDoc_Plugin;

/**
 * Register rewrite rules.
 */
class RewriteRules {

	/**
	 * Add rewrite rules.
	 */
	public static function create() {
		add_rewrite_rule( 'reference/classes/page/([0-9]{1,})/?$', 'index.php?post_type=wp-parser-class&paged=$matches[1]', 'top' );
		add_rewrite_rule( 'reference/classes/([^/]+)/([^/]+)/?$', 'index.php?post_type=wp-parser-method&name=$matches[1]-$matches[2]', 'top' );
	}

	/**
	 * Flush Rewrite Rules.
	 */
	public static function flush() {
		flush_rewrite_rules( true );
	}
}
