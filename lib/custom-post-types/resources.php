<?php
namespace Roots\Sage\CustomPostTypes\Resources;

function register_resource_post_type() {
    $labelSingular = 'Resource';
    $labelPlural = 'Resources';

    $labels = array(
        'name'               => _x($labelPlural, '', 'RPS'),
        'singular_name'      => _x($labelPlural.'', '', 'RPS'),
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
        'rewrite'            => array('slug' => 'resources/%commresourcecat%', 'with_front' => false, 'hierarchical' => true),
        'has_archive'        => 'resources',
        'menu_icon'          => 'dashicons-analytics',
        'capability_type'    => 'post',
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

function register_resource_tag_taxonomy() {
    $labelSingular = 'Resource Tag';
    $labelPlural = 'Resource Tags';

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
        'hierarchical'      => false,
        'labels'            => $labels,
        'show_ui'           => true,
        'public'            => false,
        'publicly_queryable' => false,
        'show_admin_column' => true,
        'query_var'         => true,
    );

    register_taxonomy('commresourcetag', 'commresource', $args);
}
add_action('init', __NAMESPACE__ . '\\register_resource_tag_taxonomy');

//Update the resource link structure so we can have URL's like comm100.com/resources/CATEGORY/RESOURCE
function commresource_post_link($post_link, $id = 0){
    $post = get_post($id);

    if (is_object($post)){
        $terms = wp_get_object_terms($post->ID, 'commresourcecat');

        if( $terms ){
            return str_replace('%commresourcecat%' , $terms[0]->slug , $post_link);
        }
    }

    return $post_link;
}

add_filter('post_type_link', __NAMESPACE__.'\\commresource_post_link', 1, 3);

function register_resource_rewrite_rules($wp_rewrite) {
    // $resource_rules  = [
    //                 'resources/(.+)/(.+)/(.+)/?$' => 'index.php?commresource=$matches[3]',
    //                 'resources/(.+)/(.+)/?$' => 'index.php?commresourcecat=$matches[2]'
    // ];

    // return array_merge($newRules, $wp_rewrite);
    $resource_rules = array(
        'resources/([^/]+)/?$' => 'index.php?commresourcecat=' . $wp_rewrite->preg_index( 1 ), // 'resources/any-character/'
        'resources/([^/]+)/([^/]+)/?$' => 'index.php?post_type=commresource&commresourcecat=' . $wp_rewrite->preg_index( 1 ) . '&commresource=' . $wp_rewrite->preg_index( 2 ), // 'resources/any-character/post-slug/'
        'resources/([^/]+)/([^/]+)/page/(\d{1,})/?$' => 'index.php?post_type=commresource&commresourcecat=' . $wp_rewrite->preg_index( 1 ) . '&paged=' . $wp_rewrite->preg_index( 3 ), // match paginated results for a sub-category archive
        'resources/([^/]+)/([^/]+)/([^/]+)/?$' => 'index.php?post_type=commresource&commresourcecat=' . $wp_rewrite->preg_index( 2 ) . '&commresource=' . $wp_rewrite->preg_index( 3 ), // 'resources/any-character/sub-category/post-slug/'
        'resources/([^/]+)/([^/]+)/([^/]+)/([^/]+)/?$' => 'index.php?post_type=commresource&commresourcecat=' . $wp_rewrite->preg_index( 3 ) . '&commresource=' . $wp_rewrite->preg_index( 4 ), // 'resources/any-character/sub-category/sub-sub-category/post-slug/'
    );

    // var_dump($wp_rewrite);
    return array_merge($resource_rules, $wp_rewrite->rules);
    // $wp_rewrite->rules = $resource_rules + $wp_rewrite->rules;
    // return $wp_rewrite;
}
add_action('generate_rewrite_rules', __NAMESPACE__.'\\register_resource_rewrite_rules');

function exclude_resources($query) {
    if(!is_admin() && $query->is_main_query() && (is_post_type_archive('commresource') || is_tax('commresourcecat'))) {
        $query->set('meta_query', [
            [
                'key' => 'exclude_from_archive',
                'type' => 'BINARY',
                'value' => '1',
                'compare' => '!='
            ],
            [
                'key' => 'exclude_from_archive',
                'compare' => 'NOT EXISTS'
            ],
            'relation' => 'or'
        ]);
    }
}
add_action('pre_get_posts', __NAMESPACE__.'\\exclude_resources');

function offset_resource_and_post( $query ) {
    if(!is_admin() && $query->is_main_query() && (is_post_type_archive('commresource') || is_tax('commresourcecat') || is_home() || is_post_type_archive('post') || is_tax('category') || is_tax('tag'))) {
        $ppp = get_option('posts_per_page');

        $offset = 1;

        if (is_post_type_archive('commresource') || is_tax('commresourcecat')):
            $offset = 3 - count(get_field('resources_ctas', 'options'));
        endif;

        if (is_home() || is_post_type_archive('post') || is_tax('category') || is_tax('tag')):
            $offset = 3 - count(get_field('blog_ctas', 'options')) + 1;
        endif;

        if ($offset > 0) {
            if (!$query->is_paged()) {
                $query->set('posts_per_page',$offset + $ppp);
            } else {
                $offset = $offset + ( ($query->query_vars['paged']-1) * $ppp );
                $query->set('posts_per_page',$ppp);
                $query->set('offset',$offset);
            }
        }
    }
}
add_action('pre_get_posts', __NAMESPACE__.'\\offset_resource_and_post');

function offset_resource_and_post_pagination($found_posts, $query) {
    $offset = 1;

    if (is_post_type_archive('commresource') || is_tax('commresourcecat')):
        $offset = 3 - count(get_field('resources_ctas', 'options'));
    endif;

    if (is_home() || is_post_type_archive('post') || is_tax('category') || is_tax('tag')):
        $offset = 3 - count(get_field('blog_ctas', 'options')) + 1;
    endif;

    if($offset > 0 && !is_admin() && $query->is_main_query() && (is_post_type_archive('commresource') || is_tax('commresourcecat') || is_home() || is_post_type_archive('post') || is_tax('category') || is_tax('tag'))) {
        $found_posts = $found_posts - $offset;
    }
    return $found_posts;
}
add_filter( 'found_posts', __NAMESPACE__.'\\offset_resource_and_post_pagination', 10, 2 );