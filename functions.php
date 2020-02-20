<?php
/**
 * Sage includes
 *
 * The $sage_includes array determines the code library included in your theme.
 * Add or remove files to the array as needed. Supports child theme overrides.
 *
 * Please note that missing files will produce a fatal error.
 *
 * @link https://github.com/roots/sage/pull/1042
 */
$sage_includes = [
    'lib/custom-post-types/setup.php',    // Set up custom post types
    'lib/ajax.php',    // Ajax related scripts
    'lib/analytics.php',    // Custom post page view tracking
    'lib/navigation.php',    // Custom page navigation
    'lib/assets.php',    // Scripts and stylesheets
    'lib/extras.php',    // Custom functions
    'lib/gdpr.php',    // Custom WebToffee GDPR functions
    'lib/setup.php',     // Theme setup
    'lib/shortcodes.php', // Custom Shortcodes
    'lib/titles.php',    // Page titles
    'lib/wrapper.php',   // Theme wrapper class
    'lib/widgets.php',   // Custom sidebar widgets
    'lib/customizer.php', // Theme customizer
    'lib/theme-upgrades.php' // Includes scripts to be run during theme upgrades.
];

foreach ($sage_includes as $file) {
    if (!$filepath = locate_template($file)) {
        trigger_error(sprintf(__('Error locating %s for inclusion', 'sage'), $file), E_USER_ERROR);
    }

    require_once $filepath;
}
unset($file, $filepath);
function disable_admin_page_rich_editing( $settings, $post ) {
    $post_id = $_GET['post'] ? $_GET['post'] : $_POST['post_ID'] ;
    $post_type = get_post_type($post_id);
    if( $_GET['post_type'] == 'page' || $post_type == 'page' ){
        $settings['richEditingEnabled'] = FALSE;
        return $settings;
    }
}
add_filter( 'block_editor_settings', 'disable_admin_page_rich_editing', 10, 2 );