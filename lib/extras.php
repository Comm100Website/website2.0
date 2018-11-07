<?php
namespace Roots\Sage\Extras;

use Roots\Sage\Setup;

/**
 * Add <body> classes
 */
function body_class($classes) {
    $classes[0] = 'page-'.$classes[0];

    for ($i = 0; $i < count($classes); $i++) {
        if ($classes[$i] == 'search') {
            $classes[$i] = 'page-'.$classes[$i];
        }
    }

    // Add page slug if it doesn't exist
    if (is_single() || is_page() && !is_front_page()) {
        if (!in_array(basename(get_permalink()), $classes)) {
            $classes[] = ' page-'.basename(get_permalink());
        }
    }

  return $classes;
}
add_filter('body_class', __NAMESPACE__ . '\\body_class');

//Remove [...] string using Filters
function ellipsis_excerpt_more( $more ) {
    return '...';
}
add_filter('excerpt_more', __NAMESPACE__.'\\ellipsis_excerpt_more');

function custom_excerpt_length( $length ) {
	return 23;
}
add_filter('excerpt_length', __NAMESPACE__.'\\custom_excerpt_length', 999);

function get_post_taxonomy($taxonomy) {
    global $post;

    $post_terms = wp_get_post_terms($post->ID, $taxonomy);
    $term = '';

	if (count($post_terms) > 0):
        $term = get_term($post_terms[0]);
	endif;

	return $term;
}