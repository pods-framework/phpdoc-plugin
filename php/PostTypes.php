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
					'label'        => __( 'Functions', 'wporg' ),
					'labels'       => array(
						'name'               => __( 'Functions', 'wporg' ),
						'singular_name'      => __( 'Function', 'wporg' ),
						'all_items'          => __( 'Functions', 'wporg' ),
						'new_item'           => __( 'New Function', 'wporg' ),
						'add_new'            => __( 'Add New', 'wporg' ),
						'add_new_item'       => __( 'Add New Function', 'wporg' ),
						'edit_item'          => __( 'Edit Function', 'wporg' ),
						'view_item'          => __( 'View Function', 'wporg' ),
						'search_items'       => __( 'Search Functions', 'wporg' ),
						'not_found'          => __( 'No Functions found', 'wporg' ),
						'not_found_in_trash' => __( 'No Functions found in trash', 'wporg' ),
						'parent_item_colon'  => __( 'Parent Function', 'wporg' ),
						'menu_name'          => __( 'Functions', 'wporg' ),
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
					'label'        => __( 'Classes', 'wporg' ),
					'labels'       => array(
						'name'               => __( 'Classes', 'wporg' ),
						'singular_name'      => __( 'Class', 'wporg' ),
						'all_items'          => __( 'Classes', 'wporg' ),
						'new_item'           => __( 'New Class', 'wporg' ),
						'add_new'            => __( 'Add New', 'wporg' ),
						'add_new_item'       => __( 'Add New Class', 'wporg' ),
						'edit_item'          => __( 'Edit Class', 'wporg' ),
						'view_item'          => __( 'View Class', 'wporg' ),
						'search_items'       => __( 'Search Classes', 'wporg' ),
						'not_found'          => __( 'No Classes found', 'wporg' ),
						'not_found_in_trash' => __( 'No Classes found in trash', 'wporg' ),
						'parent_item_colon'  => __( 'Parent Class', 'wporg' ),
						'menu_name'          => __( 'Classes', 'wporg' ),
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
					'label'        => __( 'Hooks', 'wporg' ),
					'labels'       => array(
						'name'               => __( 'Hooks', 'wporg' ),
						'singular_name'      => __( 'Hook', 'wporg' ),
						'all_items'          => __( 'Hooks', 'wporg' ),
						'new_item'           => __( 'New Hook', 'wporg' ),
						'add_new'            => __( 'Add New', 'wporg' ),
						'add_new_item'       => __( 'Add New Hook', 'wporg' ),
						'edit_item'          => __( 'Edit Hook', 'wporg' ),
						'view_item'          => __( 'View Hook', 'wporg' ),
						'search_items'       => __( 'Search Hooks', 'wporg' ),
						'not_found'          => __( 'No Hooks found', 'wporg' ),
						'not_found_in_trash' => __( 'No Hooks found in trash', 'wporg' ),
						'parent_item_colon'  => __( 'Parent Hook', 'wporg' ),
						'menu_name'          => __( 'Hooks', 'wporg' ),
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
					'label'        => __( 'Methods', 'wporg' ),
					'labels'       => array(
						'name'               => __( 'Methods', 'wporg' ),
						'singular_name'      => __( 'Method', 'wporg' ),
						'all_items'          => __( 'Methods', 'wporg' ),
						'new_item'           => __( 'New Method', 'wporg' ),
						'add_new'            => __( 'Add New', 'wporg' ),
						'add_new_item'       => __( 'Add New Method', 'wporg' ),
						'edit_item'          => __( 'Edit Method', 'wporg' ),
						'view_item'          => __( 'View Method', 'wporg' ),
						'search_items'       => __( 'Search Methods', 'wporg' ),
						'not_found'          => __( 'No Methods found', 'wporg' ),
						'not_found_in_trash' => __( 'No Methods found in trash', 'wporg' ),
						'parent_item_colon'  => __( 'Parent Method', 'wporg' ),
						'menu_name'          => __( 'Methods', 'wporg' ),
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
}
