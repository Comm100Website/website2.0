<?php
namespace Roots\Sage\CustomPostTypes\Resources;

function register_resource_post_type() {
    $labelSingular = 'Resource';
    $labelPlural = 'Resources';

    $labels = array(
        'name'               => _x($labelPlural, '', 'RPS'),
        'singular_name'      => _x($labelPlural.' Item', '', 'RPS'),
        'menu_name'          => _x($labelPlural, '', 'RPS'),
        'name_admin_bar'     => _x($labelPlural, '', 'RPS'),
        'add_new'            => _x('Add New '.$labelSingular, '', 'RPS'),
        'add_new_item'       => __('Add New '.$labelSingular, 'RPS'),
        'new_item'           => __('New '.$labelSingular, 'RPS'),
        'edit_item'          => __('Edit '.$labelSingular, 'RPS'),
        'view_item'          => __('View '.$labelSingular, 'RPS'),
        'all_items'          => __('All '.$labelPlural, 'RPS'),
        'search_items'       => __('Search '.$labelPlural, 'RPS'),
        'parent_item_colon'  => __('Parent '.$labelSingular.':', 'RPS'),
        'not_found'          => __('No '.$labelSingular.' found.', 'RPS'),
        'not_found_in_trash' => __('No '.$labelSingular.' found in Trash.', 'RPS')
    );

    $args = array(
        'labels'             => $labels,
        'public'             => true,
        'publicly_queryable' => true,
        'show_ui'            => true,
        'show_in_menu'       => true,
        'query_var'          => true,
        'rewrite'            => array('slug' => 'resources/%commresourcecat%', 'with_front' => false),
        'menu_icon'          => 'dashicons-analytics',
        'capability_type'    => 'post',
        'has_archive'        => true,
        'hierarchical'       => true,
        'menu_position'      => null,
        'taxonomies'         => array('post_tag'),
        'supports'           => array('title', 'editor', 'author', 'thumbnail', 'excerpt', 'comments' , 'tags')
    );

    register_post_type('commresource', $args);
}
add_action('init', __NAMESPACE__ . '\\register_resource_post_type');

function register_resource_category_taxonomy() {
    $labelSingular = 'Resource Category';
    $labelPlural = 'Resource Categories';

    $labels = array(
        'name'              => _x($labelPlural, 'taxonomy general name' ),
        'singular_name'     => _x($labelSingular, 'taxonomy singular name' ),
        'search_items'      => __( 'Search '.$labelPlural ),
        'all_items'         => __( 'All '.$labelPlural ),
        'parent_item'       => __( 'Parent '.$labelPlural ),
        'parent_item_colon' => __( 'Parent '.$labelPlural.':' ),
        'edit_item'         => __( 'Edit '.$labelPlural ),
        'update_item'       => __( 'Update '.$labelPlural ),
        'add_new_item'      => __( 'Add New '.$labelPlural ),
        'new_item_name'     => __( 'New '.$labelPlural.' Name' ),
        'menu_name'         => __( $labelPlural ),
    );

    $args = array(
        'hierarchical'      => true,
        'labels'            => $labels,
        'show_ui'           => true,
        'show_admin_column' => true,
        'query_var'         => true,
        'rewrite'           => array('slug' => 'resources', 'with_front' => false)
    );

    register_taxonomy('commresourcecat', 'commresource', $args);
}
add_action('init', __NAMESPACE__ . '\\register_resource_category_taxonomy');

//Update the resource link structure so we can have URL's like comm100.com/resources/CATEGORY/RESOURCE
function commresource_post_link( $post_link, $id = 0 ){
    $post = get_post($id);

    if (is_object($post)){
        $terms = wp_get_object_terms($post->ID, 'commresourcecat');

        if( $terms ){
            return str_replace('%commresource%' , $terms[0]->slug , $post_link);
        }
    }

    return $post_link;
}

add_filter( 'post_type_link', __NAMESPACE__.'\\commresource_post_link', 1, 3 );
