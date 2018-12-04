<?php
namespace Roots\Sage\Extras;

use Roots\Sage\Setup;

/**
 * Add <body> classes
 */
function body_class($classes) {
    global $post;
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

    if ($post && get_field('activate_demandbase', $post->ID) && get_field('demandbase_page_type', $post->ID)) {
        $classes[] = 'db-audience-'.sanitize_title(get_field('demandbase_audience', $post->ID)->post_title);
    } elseif (isset($_COOKIE['audience']) && isset($_COOKIE['country'])) {
        $classes[] = 'db-audience-'.sanitize_title($_COOKIE['audience']);
        $classes[] = 'db-audience-'.sanitize_title($_COOKIE['country']);
    }

  return $classes;
}
add_filter('body_class', __NAMESPACE__ . '\\body_class');

//Remove [...] string using Filters
function ellipsis_excerpt_more( $more ) {
    return ' <a href="'.get_permalink().'" class="read-more">+ Read More</a>';
}
add_filter('excerpt_more', __NAMESPACE__.'\\ellipsis_excerpt_more');

function custom_excerpt_length( $length ) {
	return 23;
}
add_filter('excerpt_length', __NAMESPACE__.'\\custom_excerpt_length', 999);

function get_post_taxonomy($taxonomy, $postID) {

    if (!$postID) {
        global $post;
        $postID = $post->ID;
    }

    $post_terms = wp_get_post_terms($postID, $taxonomy);
    $term = '';

	if (count($post_terms) > 0):
        $term = get_term($post_terms[0]);
	endif;

	return $term;
}