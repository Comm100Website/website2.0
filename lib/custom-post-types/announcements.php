<?php
namespace Roots\Sage\CustomPostTypes\Announcements;

define ('ANNOUNCEMENT_POST', 'announcement');
add_action( 'init', __NAMESPACE__ . '\\register_announcements_post_type' );

function register_announcements_post_type() {
    $label = 'Announcements';
    $singularLabel = 'Announcement';

    $labels = array(
        'name' => $label,
        'singular_name' => __($singularLabel),
        'add_new' => _x('Add New '.$singularLabel, ANNOUNCEMENT_POST),
        'add_new_item' => __('Add New ' . $singularLabel),
        'edit_item' => __('Edit ' . $singularLabel),
        'new_item' => __('New ' . $singularLabel),
        'view_item' => __('View ' . $singularLabel),
        'search_items' => __('Search ' . $label),
        'not_found' => __('No ' . strtolower($label) . ' found'),
        'not_found_in_trash' => __('No ' . strtolower($label) . ' found in Trash'),
        'parent_item_colon' => ''
    );

    $args = array(
        'labels' => $labels,
        'public' => false,
        'show_ui' => true,
        '_builtin' => false,
        'capability_type' => 'post',
        'hierarchical' => false,
        'menu_icon' => 'dashicons-clipboard',
        'rewrite' => array("slug" => '/announcement', "with_front" => false),
        'menu_position' => 20,
        'supports' => array('title')
    );

    register_post_type(ANNOUNCEMENT_POST, $args);
}

add_filter( 'manage_edit-'.ANNOUNCEMENT_POST.'_columns', __NAMESPACE__ . '\\set_custom_edit_announcements_columns' );

function set_custom_edit_announcements_columns($columns) {
    $custom_columns = array(
        "cb" => "<input type=\"checkbox\" />",
        "title" => "Title",
        "announcement" => "Announcement",
        "date" => "Date"
    );
    return $custom_columns;
}

add_action('manage_posts_custom_column',  __NAMESPACE__ . '\\set_custom_announcements_columns');

function set_custom_announcements_columns($custom_columns){
    switch ($custom_columns)
    {
        case 'announcement':
            the_field('announcement');
            break;
    }
}
?>
