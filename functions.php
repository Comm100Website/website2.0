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

//Mega menu display
function prefix_nav_description( $item_output, $item, $depth, $args ) {
    $menu_type = get_field('menu_type', $item);    
    if( $menu_type == "intro" ) {
       $menu_intro = get_field('intro', $item);
       if($menu_intro ){
          $item_output .= "<h3>" .$menu_intro['title']. "</h3>";
          $item_output .= "<div class='subtitle'>" .$menu_intro['subtitle']. "</div>";
          $item_output .= "<a href=".$menu_intro['btn']['url']."><button class='btn  c-btn-border-2x c-btn-white'  >" . $menu_intro['btn']['title'] ."</button></a>";
      }
    }		


    if( $menu_type == "sublink" ) {
        if( have_rows('sub_links', $item) ){
            while ( have_rows('sub_links', $item) ) : the_row();
                $item_output .="<div class='col-xs-6'><a href='".get_sub_field('url')['url']."'><h4>".get_sub_field('url')['title']."</h4></a><p style='
                line-height: initial;
                word-wrap: break-word;
                '>".get_sub_field('description')."</p></div>";
            endwhile;
            if(have_rows('other_links', $item)){
                $item_output .="<div class='other_links col-xs-12'><hr>";
                while ( have_rows('other_links', $item) ) : the_row();
                    $item_output .="<div class='col-xs-3'><span class='other_links_item'><a href='".get_sub_field('link')['url']."'>".get_sub_field('link')['title']."</a></span></div>";
                endwhile;
                $item_output .= '</div>';
            }
        }
    }
return $item_output;
}
add_filter( 'walker_nav_menu_start_el', 'prefix_nav_description', 10, 4 );