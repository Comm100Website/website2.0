<?php
namespace Roots\Sage\CustomPostTypes\DemandBase;

define ('DEMANDBASE_AUDIENCE_POST', 'dbaudience');

add_action( 'init', __NAMESPACE__ . '\\register_demandbase_audience_post_type' );

function register_demandbase_audience_post_type() {
    $label = 'Demandbase Audiences';
    $singularLabel = 'Demandbase Audience';

    $labels = array(
        'name' => $label,
        'singular_name' => __($singularLabel),
        'add_new' => _x('Add New '.$singularLabel, DEMANDBASE_AUDIENCE_POST),
        'add_new_item' => __('Add New ' . $singularLabel),
        'edit_item' => __('Edit ' . $singularLabel),
        'new_item' => __('New ' . $singularLabel),
        'view_item' => __('View ' . $singularLabel),
        'search_items' => __('Search ' . $label),
        'not_found' => __('No ' . strtolower($label) . ' found'),
        'not_found_in_trash' => __('No ' . strtolower($label) . ' found in Trash'),
        'parent_item_colon' => ''
    );

    $product_args = array(
        'labels' => $labels,
        'public' => false,
        'exclude_from_search' => true,
        'show_ui' => true,
        '_builtin' => false,
        'capability_type' => 'post',
        'hierarchical' => false,
        'menu_icon' => 'dashicons-networking',
        'rewrite' => array("slug" => "db-audience", "with_front" => false),
        'menu_position' => 20,
        'supports' => array('title')
    );

    register_post_type(DEMANDBASE_AUDIENCE_POST, $product_args);
}

add_filter( 'manage_edit-'.DEMANDBASE_AUDIENCE_POST.'_columns', __NAMESPACE__ . '\\set_custom_edit_demandbase_audience_columns' );
add_action( 'manage_'.DEMANDBASE_AUDIENCE_POST.'_posts_custom_column' , __NAMESPACE__ . '\\custom_demandbase_audience_column', 10, 2 );

function set_custom_edit_demandbase_audience_columns($columns) {
    $custom_columns = array(
        "cb" => "<input type=\"checkbox\" />",
        "title" => "Audience",
        'audience_url' => 'Industry Test URL',

    );
    return $custom_columns;
}

function custom_demandbase_audience_column( $column, $post_id ) {
    switch ( $column ) {
        case 'audience_url':
            echo '<a href="'.get_site_url().'?ip='.get_field('test_ip').'&reset=true" target="_blank">View site as '.get_the_title().' user</a>';
            break;
    }
}
?>
