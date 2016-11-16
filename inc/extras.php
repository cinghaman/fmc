<?php
/**
 * Custom functions that act independently of the theme templates
 *
 * Eventually, some of the functionality here could be replaced by core features
 *
 * @package _tk
 */

/**
 * Get our wp_nav_menu() fallback, wp_page_menu(), to show a home link.
 */
function _tk_page_menu_args( $args ) {
	$args['show_home'] = true;
	return $args;
}
add_filter( 'wp_page_menu_args', '_tk_page_menu_args' );

/**
 * Adds custom classes to the array of body classes.
 */
function _tk_body_classes( $classes ) {
	// Adds a class of group-blog to blogs with more than 1 published author
	if ( is_multi_author() ) {
		$classes[] = 'group-blog';
	}

	return $classes;
}
add_filter( 'body_class', '_tk_body_classes' );

/**
 * Filter in a link to a content ID attribute for the next/previous image links on image attachment pages
 */
function _tk_enhanced_image_navigation( $url, $id ) {
	if ( ! is_attachment() && ! wp_attachment_is_image( $id ) )
		return $url;

	$image = get_post( $id );
	if ( ! empty( $image->post_parent ) && $image->post_parent != $id )
		$url .= '#main';

	return $url;
}
add_filter( 'attachment_link', '_tk_enhanced_image_navigation', 10, 2 );

/**
 * Filters wp_title to print a neat <title> tag based on what is being viewed.
 */
function _tk_wp_title( $title, $sep ) {
	global $page, $paged;

	if ( is_feed() )
		return $title;

	// Add the blog name
	$title .= get_bloginfo( 'name' );

	// Add the blog description for the home/front page.
	$site_description = get_bloginfo( 'description', 'display' );
	if ( $site_description && ( is_home() || is_front_page() ) )
		$title .= " $sep $site_description";

	// Add a page number if necessary:
	if ( $paged >= 2 || $page >= 2 )
		$title .= " $sep " . sprintf( __( 'Page %s', '_tk' ), max( $paged, $page ) );

	return $title;
}
add_filter( 'wp_title', '_tk_wp_title', 10, 2 );

function listify_widget_posts_args( $args ) {
	if ( ! is_author() ) {
		return $args;
	}

	$args[ 'author' ] = get_the_author_meta( 'ID' );

	return $args;
}
add_filter( 'widget_posts_args', 'listify_widget_posts_args' );

// Shortcodes in widgets
add_filter( 'widget_text', 'do_shortcode' );

function listify_array_filter_deep( $item ) {
    if ( is_array( $item ) ) {
        return array_filter( $item, 'listify_array_filter_deep' );
    }

    if ( ! empty( $item ) ) {
        return true;
    }
}

function listify_get_terms( $args = array() ) {
	$args = wp_parse_args( $args, apply_filters( 'listify_get_terms_args', array(
		'orderby' => 'id',
		'order' => 'ASC',
		'hide_empty' => 1,
		'child_of' => 0,
		'exclude' => '',
		'hierarchical' => 0,
		'update_term_meta_cache' => false,
		'taxonomy' => 'job_listing_category'
	) ) );

	if ( ! listify_has_integration( 'wp-job-manager' ) ) {
		return get_terms( $args );
	}

	$terms_hash = 'jm_cats_' . md5( json_encode( $args ) . WP_Job_Manager_Cache_Helper::get_transient_version( 'jm_get_' . $args[ 'taxonomy' ] ) );
	$terms = get_transient( $terms_hash );

	if ( is_array( $terms ) ) {
		$terms = array_filter( $terms );
	}

	if ( empty( $terms ) || is_wp_error( $terms ) ) {
		$terms = get_terms( $args );

		set_transient( $terms_hash, $terms );
	}

	if ( empty( $terms ) || is_wp_error( $terms ) ) {
		return array();
	}

	return $terms;
}
