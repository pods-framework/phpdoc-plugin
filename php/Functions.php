<?php
/**
 * Helper functions/methods ported over from template tags.
 *
 * @package Pods\phpDoc_Plugin
 */

namespace Pods\phpDoc_Plugin;

/**
 * Class for helper functions/template tags.
 */
class Functions {
	/**
	 * Returns array of screen IDs for parsed post types.
	 *
	 * @access public
	 *
	 * @return array
	 */
	public static function get_parsed_post_types_screen_ids() {
		$screen_ids = array();
		foreach ( PostTypes::get_parsed_post_types() as $parsed_post_type ) {
			$screen_ids[] = $parsed_post_type;
			$screen_ids[] = "edit-{$parsed_post_type}";
		}

		return $screen_ids;
	}

	/**
	 * Checks if given post type is one of the parsed post types.
	 *
	 * @param  null|string $post_type Optional. The post type. Default null.
	 * @return bool True if post has a parsed post type
	 */
	public static function is_parsed_post_type( $post_type = null ) {
		$post_type = $post_type ? $post_type : get_post_type();

		return in_array( $post_type, PostTypes::get_parsed_post_types(), true );
	}
}

/**
 * Retrieve an explanation for the given post.
 *
 * @param int|WP_Post $post      Post ID or WP_Post object.
 * @param bool        $published Optional. Whether to only retrieve the explanation if it's published.
 *                               Default false.
 * @return WP_Post|null WP_Post object for the Explanation, null otherwise.
 */
function get_explanation( $post, $published = false ) {
	$post_compare = get_post( $post );
	if ( $post !== $post_compare ) {
		return null;
	}
	$post = $post_compare;

	$args = array(
		'post_type'      => 'wporg_explanations',
		'post_parent'    => $post->ID,
		'no_found_rows'  => true,
		'posts_per_page' => 1,
	);

	if ( true === $published ) {
		$args['post_status'] = 'publish';
	}

	$explanation = get_children( $args, OBJECT );

	if ( empty( $explanation ) ) {
		return null;
	}

	$explanation = reset( $explanation );

	if ( ! $explanation ) {
		return null;
	}
	return $explanation;
}
