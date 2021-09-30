<?php
/**
 * Register Taxonomies.
 *
 * @package Pods\phpDoc_Plugin
 */

namespace Pods\phpDoc_Plugin;

/**
 * Register taxonomies class.
 */
class Taxonomies {

	/**
	 * Add taxonomies for parser.
	 */
	public static function create() {
		register_taxonomy(
			'wp-parser-source-file',
			PostTypes::get_parsed_post_types( false ),
			array(
				'label'                 => __( 'Files', 'phpdoc-plugin' ),
				'labels'                => array(
					'name'                       => __( 'Files', 'phpdoc-plugin' ),
					'singular_name'              => _x( 'File', 'taxonomy general name', 'phpdoc-plugin' ),
					'search_items'               => __( 'Search Files', 'phpdoc-plugin' ),
					'popular_items'              => null,
					'all_items'                  => __( 'All Files', 'phpdoc-plugin' ),
					'parent_item'                => __( 'Parent File', 'phpdoc-plugin' ),
					'parent_item_colon'          => __( 'Parent File:', 'phpdoc-plugin' ),
					'edit_item'                  => __( 'Edit File', 'phpdoc-plugin' ),
					'update_item'                => __( 'Update File', 'phpdoc-plugin' ),
					'add_new_item'               => __( 'New File', 'phpdoc-plugin' ),
					'new_item_name'              => __( 'New File', 'phpdoc-plugin' ),
					'separate_items_with_commas' => __( 'Files separated by comma', 'phpdoc-plugin' ),
					'add_or_remove_items'        => __( 'Add or remove Files', 'phpdoc-plugin' ),
					'choose_from_most_used'      => __( 'Choose from the most used Files', 'phpdoc-plugin' ),
					'menu_name'                  => __( 'Files', 'phpdoc-plugin' ),
				),
				'public'                => true,
				// Hierarchical x 2 to enable (.+) rather than ([^/]+) for rewrites.
				'hierarchical'          => true,
				'rewrite'               => array(
					'with_front'   => false,
					'slug'         => 'reference/files',
					'hierarchical' => true,
				),
				'sort'                  => false,
				'update_count_callback' => '_update_post_term_count',
				'show_in_rest'          => true,
			)
		);

		register_taxonomy(
			'wp-parser-package',
			PostTypes::get_parsed_post_types( false ),
			array(
				'hierarchical'          => true,
				'label'                 => '@package',
				'public'                => true,
				'rewrite'               => array(
					'with_front' => false,
					'slug'       => 'reference/package',
				),
				'sort'                  => false,
				'update_count_callback' => '_update_post_term_count',
				'show_in_rest'          => true,
			)
		);

		// @since
		register_taxonomy(
			'wp-parser-since',
			PostTypes::get_parsed_post_types( false ),
			array(
				'hierarchical'          => true,
				'label'                 => __( '@since', 'phpdoc-plugin' ),
				'public'                => true,
				'rewrite'               => array(
					'with_front' => false,
					'slug'       => 'reference/since',
				),
				'sort'                  => false,
				'update_count_callback' => '_update_post_term_count',
				'show_in_rest'          => true,
			)
		);

	}
}
