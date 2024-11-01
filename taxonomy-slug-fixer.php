<?php
/**
 * Plugin Name: Taxonomy slug fixer
 *
 *  @package   taxonomy-slug-fixer
 * Description: A challenge that had remained unsolved in WordPress for 16 years. One of the issues that can be problematic for website administrators and SEO specialists in WordPress is the presence of URLs that create duplicate pages. If you examine the taxonomy pages of WordPress, you will encounter this problem:
 * domain.com/category/master-cat/sub-cat
 * If your site has such a structure, adding any phrase between the slashes of subdirectories loads the page content and displays an HTTP status of 200.
 * The function of this plugin is such that if the entered address does not exist in the taxonomies, it changes the status to 404, preventing the creation of redundant and duplicate pages and protecting your site's SEO from harm.
 * Author: Fariborz Asgarpour
 * Version: 1.0.0
 * Author URI: https://t.me/fariborzasgarpour
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

function tsf_fix_category_slug_hierarchy( $q ) {
	if ( ( ! is_admin() && $q->is_main_query() && $q->is_category ) || ( ! is_admin() && $q->is_main_query() && $q->is_tax ) ) {
		foreach ( $q->query as $query ) {
			$slugs = explode( '/', $query );
			if ( count( $slugs ) > 1 ) {
				$category_path = rawurlencode( urldecode( $query ) );
				$category_path = str_replace( '%2F', '/', $category_path );
				$category_path = str_replace( '%20', ' ', $category_path );
				$slugs         = '/' . trim( $category_path, '/' );
				$slugs         = explode( '/', $slugs );
				$taxonomy      = get_queried_object()->taxonomy;
				$count         = array();
				foreach ( $slugs as $term_slug ) {
					$term = get_term_by( 'slug', $term_slug, $taxonomy );
					if ( $term == false ) {
						$count[] = $term;
					}
				}
				if ( count( $count ) > 1 ) {
					global $wp_query;
					$wp_query->set_404();
					status_header( 404 );
				}
			}
		}
	}
}
if ( function_exists( 'add_action' ) ) {
	add_action( 'parse_tax_query', 'tsf_fix_category_slug_hierarchy' );
}
