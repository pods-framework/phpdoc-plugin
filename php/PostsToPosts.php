<?php
/**
 * Register P2P Relationships.
 *
 * @package Pods\phpDoc_Plugin
 * @see https://wordpress.org/plugins/posts-to-posts/
 */

namespace Pods\phpDoc_Plugin;

/**
 * Register taxonomies class.
 */
class PostsToPosts {

	/**
	 * Determine if Posts to Posts is installed.
	 *
	 * @return bool true if active, false if not.
	 */
	public static function is_active() {
		return Plugin::is_activated( 'posts-to-posts/posts-to-posts.php' );
	}

	/**
	 * Registers P2P post relationships.
	 */
	public static function register_post_relationships() {

		if ( ! self::is_active() ) {
			return;
		}

		/*
		 * Functions to functions, methods and hooks
		 */
		p2p_register_connection_type(
			array(
				'name'             => 'functions_to_functions',
				'from'             => 'wp-parser-function',
				'to'               => 'wp-parser-function',
				'can_create_post'  => false,
				'self_connections' => true,
				'from_query_vars'  => array(
					'orderby' => 'post_title',
					'order'   => 'ASC',
				),
				'to_query_vars'    => array(
					'orderby' => 'post_title',
					'order'   => 'ASC',
				),
				'title'            => array(
					'from' => __( 'Uses Functions', 'phpdoc-plugin' ),
					'to'   => __( 'Used by Functions', 'phpdoc-plugin' ),
				),
			)
		);

		p2p_register_connection_type(
			array(
				'name'            => 'functions_to_methods',
				'from'            => 'wp-parser-function',
				'to'              => 'wp-parser-method',
				'can_create_post' => false,
				'from_query_vars' => array(
					'orderby' => 'post_title',
					'order'   => 'ASC',
				),
				'to_query_vars'   => array(
					'orderby' => 'post_title',
					'order'   => 'ASC',
				),
				'title'           => array(
					'from' => __( 'Uses Methods', 'phpdoc-plugin' ),
					'to'   => __( 'Used by Functions', 'phpdoc-plugin' ),
				),
			)
		);

		p2p_register_connection_type(
			array(
				'name'            => 'functions_to_hooks',
				'from'            => 'wp-parser-function',
				'to'              => 'wp-parser-hook',
				'can_create_post' => false,
				'from_query_vars' => array(
					'orderby' => 'post_title',
					'order'   => 'ASC',
				),
				'to_query_vars'   => array(
					'orderby' => 'post_title',
					'order'   => 'ASC',
				),
				'title'           => array(
					'from' => __( 'Uses Hooks', 'phpdoc-plugin' ),
					'to'   => __( 'Used by Functions', 'phpdoc-plugin' ),
				),
			)
		);

		/*
		 * Methods to functions, methods and hooks
		 */
		p2p_register_connection_type(
			array(
				'name'            => 'methods_to_functions',
				'from'            => 'wp-parser-method',
				'to'              => 'wp-parser-function',
				'can_create_post' => false,
				'from_query_vars' => array(
					'orderby' => 'post_title',
					'order'   => 'ASC',
				),
				'to_query_vars'   => array(
					'orderby' => 'post_title',
					'order'   => 'ASC',
				),
				'title'           => array(
					'from' => __( 'Uses Functions', 'phpdoc-plugin' ),
					'to'   => __( 'Used by Methods', 'phpdoc-plugin' ),
				),
			)
		);

		p2p_register_connection_type(
			array(
				'name'             => 'methods_to_methods',
				'from'             => 'wp-parser-method',
				'to'               => 'wp-parser-method',
				'can_create_post'  => false,
				'self_connections' => true,
				'from_query_vars'  => array(
					'orderby' => 'post_title',
					'order'   => 'ASC',
				),
				'to_query_vars'    => array(
					'orderby' => 'post_title',
					'order'   => 'ASC',
				),
				'title'            => array(
					'from' => __( 'Uses Methods', 'phpdoc-plugin' ),
					'to'   => __( 'Used by Methods', 'phpdoc-plugin' ),
				),
			)
		);

		p2p_register_connection_type(
			array(
				'name'            => 'methods_to_hooks',
				'from'            => 'wp-parser-method',
				'to'              => 'wp-parser-hook',
				'can_create_post' => false,
				'from_query_vars' => array(
					'orderby' => 'post_title',
					'order'   => 'ASC',
				),
				'to_query_vars'   => array(
					'orderby' => 'post_title',
					'order'   => 'ASC',
				),
				'title'           => array(
					'from' => __( 'Used by Methods', 'phpdoc-plugin' ),
					'to'   => __( 'Uses Hooks', 'phpdoc-plugin' ),
				),
			)
		);
	}
}
