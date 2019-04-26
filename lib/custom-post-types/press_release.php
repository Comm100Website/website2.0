<?php
namespace Roots\Sage\CustomPostTypes\PressRelease;

define ('PRESS_RELEASE_POST', 'releases');
add_action( 'init', __NAMESPACE__ . '\\register_press_release_post_type' );

function register_press_release_post_type() {
    $label = 'Press Releases';
    $singularLabel = 'Press Release';

    $labels = array(
        'name' => $label,
        'singular_name' => __($singularLabel),
        'add_new' => _x('Add New '.$singularLabel, PRESS_RELEASE_POST),
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
        'public' => true,
        'show_ui' => true,
        '_builtin' => false,
        'capability_type' => 'post',
        'hierarchical' => false,
        'menu_icon' => 'dashicons-megaphone',
        'rewrite' => array("slug" => '/releases', "with_front" => false),
        'menu_position' => 20,
        'supports' => array('title', 'editor', 'excerpt', 'thumbnail', 'author')
    );

    register_post_type(PRESS_RELEASE_POST, $product_args);
}

add_filter( 'manage_edit-'.PRESS_RELEASE_POST.'_columns', __NAMESPACE__ . '\\set_custom_edit_press_release_columns' );

function set_custom_edit_press_release_columns($columns) {
    $custom_columns = array(
        "cb" => "<input type=\"checkbox\" />",
        "title" => "Title",
        "date" => "Date",
        "wpseo-score" => "SEO"
    );
    return $custom_columns;
}

add_action('manage_posts_custom_column',  __NAMESPACE__ . '\\set_custom_press_release_columns');

function set_custom_press_release_columns($custom_columns){
    switch ($custom_columns)
    {
        case 'pr_logo':
            echo '<img src="'.get_field('prototype_customer_logo').'" height="24" />';
            break;
    }
}
?>
