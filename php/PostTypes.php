<?php
/**
 * Register post types.
 *
 * @package Pods\phpDoc_Plugin
 */

namespace Pods\phpDoc_Plugin;

/**
 * Register post types class.
 */
class PostTypes {

	/**
	 * Add post types for parser.
	 */
	public static function create() {
		$supports = array(
			'comments',
			'custom-fields',
			'editor',
			'excerpt',
			'revisions',
			'title',
		);

		if ( ! post_type_exists( 'wp-parser-function' ) ) {
			register_post_type(
				'wp-parser-function',
				array(
					'has_archive'  => 'reference/functions',
					'label'        => __( 'Functions', 'phpdoc-plugin' ),
					'labels'       => array(
						'name'               => __( 'Functions', 'phpdoc-plugin' ),
						'singular_name'      => __( 'Function', 'phpdoc-plugin' ),
						'all_items'          => __( 'Functions', 'phpdoc-plugin' ),
						'new_item'           => __( 'New Function', 'phpdoc-plugin' ),
						'add_new'            => __( 'Add New', 'phpdoc-plugin' ),
						'add_new_item'       => __( 'Add New Function', 'phpdoc-plugin' ),
						'edit_item'          => __( 'Edit Function', 'phpdoc-plugin' ),
						'view_item'          => __( 'View Function', 'phpdoc-plugin' ),
						'search_items'       => __( 'Search Functions', 'phpdoc-plugin' ),
						'not_found'          => __( 'No Functions found', 'phpdoc-plugin' ),
						'not_found_in_trash' => __( 'No Functions found in trash', 'phpdoc-plugin' ),
						'parent_item_colon'  => __( 'Parent Function', 'phpdoc-plugin' ),
						'menu_name'          => __( 'Functions', 'phpdoc-plugin' ),
					),
					'menu_icon'    => 'dashicons-editor-code',
					'public'       => true,
					'rewrite'      => array(
						'feeds'      => false,
						'slug'       => 'reference/functions',
						'with_front' => false,
					),
					'supports'     => $supports,
					'show_in_rest' => true,
				)
			);
		}

		add_rewrite_rule( 'reference/classes/page/([0-9]{1,})/?$', 'index.php?post_type=wp-parser-class&paged=$matches[1]', 'top' );
		add_rewrite_rule( 'reference/classes/([^/]+)/([^/]+)/?$', 'index.php?post_type=wp-parser-method&name=$matches[1]-$matches[2]', 'top' );

		if ( ! post_type_exists( 'wp-parser-class' ) ) {
			register_post_type(
				'wp-parser-class',
				array(
					'has_archive'  => 'reference/classes',
					'label'        => __( 'Classes', 'phpdoc-plugin' ),
					'labels'       => array(
						'name'               => __( 'Classes', 'phpdoc-plugin' ),
						'singular_name'      => __( 'Class', 'phpdoc-plugin' ),
						'all_items'          => __( 'Classes', 'phpdoc-plugin' ),
						'new_item'           => __( 'New Class', 'phpdoc-plugin' ),
						'add_new'            => __( 'Add New', 'phpdoc-plugin' ),
						'add_new_item'       => __( 'Add New Class', 'phpdoc-plugin' ),
						'edit_item'          => __( 'Edit Class', 'phpdoc-plugin' ),
						'view_item'          => __( 'View Class', 'phpdoc-plugin' ),
						'search_items'       => __( 'Search Classes', 'phpdoc-plugin' ),
						'not_found'          => __( 'No Classes found', 'phpdoc-plugin' ),
						'not_found_in_trash' => __( 'No Classes found in trash', 'phpdoc-plugin' ),
						'parent_item_colon'  => __( 'Parent Class', 'phpdoc-plugin' ),
						'menu_name'          => __( 'Classes', 'phpdoc-plugin' ),
					),
					'menu_icon'    => 'dashicons-editor-code',
					'public'       => true,
					'rewrite'      => array(
						'feeds'      => false,
						'slug'       => 'reference/classes',
						'with_front' => false,
					),
					'supports'     => $supports,
					'show_in_rest' => true,
				)
			);
		}

		if ( ! post_type_exists( 'wp-parser-hook' ) ) {
			register_post_type(
				'wp-parser-hook',
				array(
					'has_archive'  => 'reference/hooks',
					'label'        => __( 'Hooks', 'phpdoc-plugin' ),
					'labels'       => array(
						'name'               => __( 'Hooks', 'phpdoc-plugin' ),
						'singular_name'      => __( 'Hook', 'phpdoc-plugin' ),
						'all_items'          => __( 'Hooks', 'phpdoc-plugin' ),
						'new_item'           => __( 'New Hook', 'phpdoc-plugin' ),
						'add_new'            => __( 'Add New', 'phpdoc-plugin' ),
						'add_new_item'       => __( 'Add New Hook', 'phpdoc-plugin' ),
						'edit_item'          => __( 'Edit Hook', 'phpdoc-plugin' ),
						'view_item'          => __( 'View Hook', 'phpdoc-plugin' ),
						'search_items'       => __( 'Search Hooks', 'phpdoc-plugin' ),
						'not_found'          => __( 'No Hooks found', 'phpdoc-plugin' ),
						'not_found_in_trash' => __( 'No Hooks found in trash', 'phpdoc-plugin' ),
						'parent_item_colon'  => __( 'Parent Hook', 'phpdoc-plugin' ),
						'menu_name'          => __( 'Hooks', 'phpdoc-plugin' ),
					),
					'menu_icon'    => 'dashicons-editor-code',
					'public'       => true,
					'rewrite'      => array(
						'feeds'      => false,
						'slug'       => 'reference/hooks',
						'with_front' => false,
					),
					'supports'     => $supports,
					'show_in_rest' => true,
				)
			);
		}

		if ( ! post_type_exists( 'wp-parser-method' ) ) {
			register_post_type(
				'wp-parser-method',
				array(
					'has_archive'  => 'reference/methods',
					'label'        => __( 'Methods', 'phpdoc-plugin' ),
					'labels'       => array(
						'name'               => __( 'Methods', 'phpdoc-plugin' ),
						'singular_name'      => __( 'Method', 'phpdoc-plugin' ),
						'all_items'          => __( 'Methods', 'phpdoc-plugin' ),
						'new_item'           => __( 'New Method', 'phpdoc-plugin' ),
						'add_new'            => __( 'Add New', 'phpdoc-plugin' ),
						'add_new_item'       => __( 'Add New Method', 'phpdoc-plugin' ),
						'edit_item'          => __( 'Edit Method', 'phpdoc-plugin' ),
						'view_item'          => __( 'View Method', 'phpdoc-plugin' ),
						'search_items'       => __( 'Search Methods', 'phpdoc-plugin' ),
						'not_found'          => __( 'No Methods found', 'phpdoc-plugin' ),
						'not_found_in_trash' => __( 'No Methods found in trash', 'phpdoc-plugin' ),
						'parent_item_colon'  => __( 'Parent Method', 'phpdoc-plugin' ),
						'menu_name'          => __( 'Methods', 'phpdoc-plugin' ),
					),
					'menu_icon'    => 'dashicons-editor-code',
					'public'       => true,
					'rewrite'      => array(
						'feeds'      => false,
						'slug'       => 'classes',
						'with_front' => false,
					),
					'supports'     => $supports,
					'show_in_rest' => true,
				)
			);
		}
	}

	/**
	 * Return registered post types for plugin.
	 *
	 * @param bool $labels Whether to return just post type keys or also labels.
	 */
	public static function get_parsed_post_types( bool $labels = true ) {
		$post_types = array(
			'wp-parser-class'    => __( 'Classes', 'phpdoc-plugin' ),
			'wp-parser-function' => __( 'Functions', 'phpdoc-plugin' ),
			'wp-parser-hook'     => __( 'Hooks', 'phpdoc-plugin' ),
			'wp-parser-method'   => __( 'Methods', 'phpdoc-plugin' ),
		);

		if ( ! $labels ) {
			return array_keys( $post_types );
		}

		return $post_types;
	}
}
