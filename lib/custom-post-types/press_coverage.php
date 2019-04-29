<?php
namespace Roots\Sage\CustomPostTypes\PressCoverage;

define ('PRESS_COVERAGE_POST', 'news');

add_action( 'init', __NAMESPACE__ . '\\register_press_coverage_post_type' );

function register_press_coverage_post_type() {
    $label = 'News';
    $singularLabel = 'News';

    $labels = array(
        'name' => $label,
        'singular_name' => __($singularLabel),
        'add_new' => _x('Add News', PRESS_COVERAGE_POST),
        'add_new_item' => __('Add News'),
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
        'show_ui' => true,
        '_builtin' => false,
        'capability_type' => 'post',
        'hierarchical' => false,
        'menu_icon' => 'dashicons-admin-links',
        'menu_position' => 20,
        'supports' => array('title')
    );

    register_post_type(PRESS_COVERAGE_POST, $product_args);
}

add_filter( 'manage_edit-'.PRESS_COVERAGE_POST.'_columns', __NAMESPACE__ . '\\set_custom_edit_press_coverage_columns' );

function set_custom_edit_press_coverage_columns($columns) {
    $custom_columns = array(
        "cb" => "<input type=\"checkbox\" />",
        "title" => "Title",
        "press_article_link" => "Article",
        "press_media_outlet" => "Media Outlet"
    );
    return $custom_columns;
}

add_action('manage_posts_custom_column',  __NAMESPACE__ . '\\set_custom_press_coverage_columns');

function set_custom_press_coverage_columns($custom_columns){
    switch ($custom_columns)
    {
        case 'press_article_link':
            echo '<a href="'.get_field('article_url').'" target="_blank">View Article</a>';
            break;
        case 'press_media_outlet':
            the_field('source');
            break;
    }
}
?>
