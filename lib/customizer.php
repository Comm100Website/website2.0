<?php

namespace Roots\Sage\Customizer;

use Roots\Sage\Assets;

/**
 * Add postMessage support
 */
function customize_register($wp_customize) {
  $wp_customize->get_setting('blogname')->transport = 'postMessage';
}
add_action('customize_register', __NAMESPACE__ . '\\customize_register');

/**
 * Customizer JS
 */
function customize_preview_js() {
  wp_enqueue_script('sage/customizer', Assets\asset_path('scripts/customizer.js'), ['customize-preview'], null, true);
}
add_action('customize_preview_init', __NAMESPACE__ . '\\customize_preview_js');


/*Fliter to modify the author display name on author page title for co-authors plus guest authors.*/
/*Solution for issue with yoast seo and co-authors plus guest author name reading for title of author page.*/

// add_filter( 'wpseo_title', 'filterAuthorTitle' );
// function filterAuthorTitle( $title ) {
//   //check if author page, if it's not return as it is
//   if ( !is_author() ) {
//     return $title;
//   }
//   //its author page, so let's pull current author name
//   $current_display_name = get_the_author_meta( 'display_name', get_query_var( 'author' ) );
//   $authorobj = get_queried_object();
//   $new_display_name = $authorobj->display_name ;
//   return str_replace( $current_display_name, $new_display_name, $title );
// }