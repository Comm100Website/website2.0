<?php
namespace Roots\Sage\ThemeUpgrades;

use WP_Query;

function theme_upgrade() {
    if (array_key_exists('upgrade_comm100', $_GET)):
        global $post;

        //Get all of the current resource pages and get the tiles so we can loop through them and attempt to populate the resource thumbnail, sub-title, category, tag, etc.
        $args = [
            'post_type' => 'page',
            'posts_per_page' => -1,
            'meta_query' => [
                [
                    'key' => 'modules_0_resources_list_item_0_category',
                    'compare' => 'EXISTS'
                ]
            ]
        ];

        $currentResourcePages = new WP_Query($args);
        $resourceTiles = [];

        if ($currentResourcePages->have_posts()):
            while ($currentResourcePages->have_posts()):
                $currentResourcePages->the_post();

                $modules = get_field('modules');

                foreach ($modules as $module):
                    if ($module['resources_promotion_item']):
                        $resourceTiles = array_merge($resourceTiles, $module['resources_promotion_item']);
                    endif;

                    if ($module['resources_list_item']):
                        $resourceTiles = array_merge($resourceTiles, $module['resources_list_item']);
                    endif;
                endforeach;
            endwhile;
        endif;

        wp_reset_postdata();

        $args = [
            'post_type' => 'page',
            'posts_per_page' => -1,
            'post_parent' => 18891,
            'post__not_in' => [51, 8209]
        ];

        $resourceCategories = new WP_Query($args);

        if ($resourceCategories->have_posts()):
            //Get all of the current resource category pages.
            foreach ($resourceCategories->posts as $oldCategoryPost):
                // echo '<h4>'.trim(str_replace('Resources -', '', $oldCategoryPost->post_title)).' - '.basename(get_permalink($oldCategoryPost)).'</h4>';
                $category = get_term_by('slug', basename(get_permalink($oldCategoryPost)), 'commresourcecat');

                if (!$category):
                    $newTermID = wp_insert_term(trim(str_replace('Resources -', '', $oldCategoryPost->post_title)), 'commresourcecat', ['slug' => basename(get_permalink($oldCategoryPost))]);
                    $category = get_term($newTermID, 'commresourcecat');
                endif;

                //Now that we have the resource categories, let's find all of the resource pages.
                $args = [
                    'post_type' => 'page',
                    'posts_per_page' => -1,
                    'post_parent' => $oldCategoryPost->ID,
                    'post__not_in' => [$oldCategoryPost->ID]
                ];

                $resources = new WP_Query($args);

                if ($resources->have_posts()):
                    foreach ($resources->posts as $resource):
                        if (strpos($resource->post_title, 'Thank You') === false):
                            $resourceTile = '';

                            foreach($resourceTiles as $resourceTile):
                                if ($resourceTile['link']['url'] == get_permalink($resource->ID, $leavename)):
                                    break;
                                endif;
                            endforeach;

                            $postTitle = trim(str_replace('Resources –', '', str_replace('Resources -', '', $resource->post_title)));
                            $postTitle = trim(str_replace($category->name.' –', '', str_replace($category->name.' -', '', $postTitle)));
                            $postTitle = trim(str_replace('- Landing Page', '', $postTitle));

                            // echo $postTitle.'<br/>';

                            $resourcePost = array(
                                'ID'           => $resource->ID,
                                'post_title'   => $postTitle,
                                'post_type'    => 'commresource',
                                'post_parent'  => null,
                                'post_name'    => basename(get_permalink($resource->ID)),
                            );
                            wp_update_post($resourcePost);

                            wp_set_post_terms($resource->ID, [$category->term_id], 'commresourcecat', false);

                            if ($resourceTile):
                                $tag = get_term_by('name', $resourceTile['category'], 'commresourcetag');

                                if (!$tag):
                                    $newTermID = wp_insert_term($resourceTile['category'], 'commresourcetag');
                                    $tag = get_term($newTermID, 'commresourcetag');
                                endif;

                                wp_set_post_terms($resource->ID, [$tag->name], 'commresourcetag', false);

                                set_post_thumbnail($resource->ID, $resourceTile['image']['ID']);

                                if (isset($resourceTile['title']) && !empty($resourceTile['title']) && $resourceTile['title'] != $resource->post_title):
                                    update_field('short_title', strip_tags($resourceTile['title']), $resource->ID);
                                endif;

                                if (isset($resourceTile['subtitle'])):
                                    update_field('sub_title', strip_tags($resourceTile['subtitle']), $resource->ID);
                                endif;

                                delete_post_meta($resource->ID, 'custom_permalink');
                            endif;
                        endif;
                    endforeach;
                endif;

                wp_delete_post($resource->ID);
            endforeach;
        endif;
    endif;
}

    // add_action('init', __NAMESPACE__ . '\\theme_upgrade');



    /*
    add_action('init', 'data_cleanup');

    function data_cleanup() {
        global $post;

        $args = [
            'post_type' => 'works',
            'posts_per_page' => -1
        ];

        $works = new WP_Query($args);

        if ($works->have_posts()) {
            while ($works->have_posts()) {
                $works->the_post();

                if (get_field('old_medium_id')) {
                    the_title();
                    var_dump(get_field('old_artist_ids'));
                    $mediums = get_terms( array(
                        'taxonomy' => 'medium',
                        'hide_empty' => false,
                        'fields' => 'ids',
                        'meta_query' => [
                            [
                                'key' => 'old_medium_id',
                                'value' => get_field('old_medium_id')
                            ]
                        ]
                    ));

                    if ($mediums) {
                        wp_set_post_terms($post->ID, strval($mediums[0]), 'medium', false);
                    }
                }


                if (get_field('old_artist_ids')) {
                    the_title();
                    var_dump(get_field('old_artist_ids'));
                    foreach (explode(',', get_field('old_artist_ids')) as $artistID) {
                        $artists = get_terms( array(
                            'taxonomy' => 'artist',
                            'hide_empty' => false,
                            'fields' => 'ids',
                            'meta_query' => [
                                [
                                    'key' => 'old_artist_id',
                                    'value' => $artistID
                                ]
                            ]
                        ));

                        if ($artists) {
                            wp_set_post_terms($post->ID, strval($artists[0]), 'artist', true);
                        }
                    }
                }


                if (get_field('old_works_ids')) {
                    $args = [
                        'post_type' => 'works',
                        'posts_per_page' => -1,
                        'meta_query' => [
                            [
                                'key' => 'old_painting_id',
                                'value' => explode(',', get_field('old_works_ids')),
                                'compare' => 'IN'
                            ]
                        ]
                    ];

                    $posts = new WP_Query($args);

                    if ($posts->have_posts()) {
                        $workIDs = [];

                        foreach ($posts->posts as $newWork) {
                            $workIDs[] = $newWork->ID;
                        }
                        update_field('exhibition_works', $workIDs);
                    }
                }

                $workImages = [];

                for ($i = 1; $i <= 5; $i++) {
                    if (get_field('work_image_'.$i)) {
                        $workImages[] = get_field('work_image_'.$i);
                    }
                }

                update_field('images', $workImages);

                if (get_field('exhibition_image')) {
                    set_post_thumbnail($post, get_field('exhibition_image'));
                }

                var_dump($workImages);
            }

            wp_reset_postdata();
        }

        $artists = get_terms( array(
            'taxonomy' => 'artist',
            'hide_empty' => false,
        ) );

        foreach ($artists as $artist) {

            wp_update_term($artist->term_id, 'artist', array(
                'description' => ''
            ));
            if (get_field('Old_Featured_Painting_ID', $artist) && is_numeric(get_field('Old_Featured_Painting_ID', $artist))) {
                //echo get_field('Old_Featured_Painting_ID', $artist);

                $args = [
                    'post_type' => 'works',
                    'posts_per_page' => -1,
                    'meta_query' => [
                        [
                            'key' => 'old_painting_id',
                            'value' => get_field('Old_Featured_Painting_ID', $artist)
                        ]
                    ]
                ];

                $posts = new WP_Query($args);

                if ($posts->have_posts()) {
                    echo $posts->posts[0]->ID;
                    update_field('artist_featured_work', [$posts->posts[0]->ID], $artist);
                }
            }
        }

        $artists = get_terms( array(
            'taxonomy' => 'artist',
            'hide_empty' => false,
        ) );

        foreach ($artists as $artist) {
            if (get_field('Old_Featured_Painting_ID', $artist) && is_numeric(get_field('Old_Featured_Painting_ID', $artist))) {
                //echo get_field('Old_Featured_Painting_ID', $artist);

                $args = [
                    'post_type' => 'works',
                    'posts_per_page' => -1,
                    'meta_query' => [
                        [
                            'key' => 'old_painting_id',
                            'value' => get_field('Old_Featured_Painting_ID', $artist)
                        ]
                    ]
                ];

                $posts = new WP_Query($args);

                if ($posts->have_posts()) {
                    echo $posts->posts[0]->ID;
                    update_field('artist_featured_work', [$posts->posts[0]->ID], $artist);
                }
            }
        }
    }
    */