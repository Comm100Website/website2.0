<?php
namespace Roots\Sage\ThemeUpgrades;

use WP_Query;

function theme_upgrade() {
    // if (array_key_exists('upgrade_comm100', $_GET)):
    //     global $post;

    //     //Get all of the current resource pages and get the tiles so we can loop through them and attempt to populate the resource thumbnail, sub-title, category, tag, etc.
    //     $args = [
    //         'post_type' => 'page',
    //         'posts_per_page' => -1,
    //         'meta_query' => [
    //             [
    //                 'key' => 'modules_0_resources_list_item_0_category',
    //                 'compare' => 'EXISTS'
    //             ]
    //         ]
    //     ];

    //     $currentResourcePages = new WP_Query($args);
    //     $resourceTiles = [];

    //     if ($currentResourcePages->have_posts()):
    //         while ($currentResourcePages->have_posts()):
    //             $currentResourcePages->the_post();

    //             $modules = get_field('modules');

    //             foreach ($modules as $module):
    //                 if ($module['resources_promotion_item']):
    //                     $resourceTiles = array_merge($resourceTiles, $module['resources_promotion_item']);
    //                 endif;

    //                 if ($module['resources_list_item']):
    //                     $resourceTiles = array_merge($resourceTiles, $module['resources_list_item']);
    //                 endif;
    //             endforeach;
    //         endwhile;
    //     endif;

    //     wp_reset_postdata();

    //     $args = [
    //         'post_type' => 'page',
    //         'posts_per_page' => -1,
    //         'post_parent' => 18891,
    //         'post__not_in' => [51, 8209]
    //     ];

    //     $resourceCategories = new WP_Query($args);

    //     if ($resourceCategories->have_posts()):
    //         //Get all of the current resource category pages.
    //         foreach ($resourceCategories->posts as $oldCategoryPost):
    //             // echo '<h4>'.trim(str_replace('Resources -', '', $oldCategoryPost->post_title)).' - '.basename(get_permalink($oldCategoryPost)).'</h4>';
    //             $category = get_term_by('slug', basename(get_permalink($oldCategoryPost)), 'commresourcecat');

    //             if (!$category):
    //                 $newTerm = wp_insert_term(trim(str_replace('Resources -', '', $oldCategoryPost->post_title)), 'commresourcecat', ['slug' => basename(get_permalink($oldCategoryPost))]);
    //                 $category = get_term($newTerm['term_id'], 'commresourcecat');
    //             endif;

    //             //Now that we have the resource categories, let's find all of the resource pages.
    //             $args = [
    //                 'post_type' => 'page',
    //                 'posts_per_page' => -1,
    //                 'post_parent' => $oldCategoryPost->ID,
    //                 'post__not_in' => [$oldCategoryPost->ID]
    //             ];

    //             $resources = new WP_Query($args);

    //             if ($resources->have_posts()):
    //                 foreach ($resources->posts as $resource):
    //                     if (strpos($resource->post_title, 'Thank You') === false):
    //                         $postTitle = trim(str_replace('Resources –', '', str_replace('Resources -', '', $resource->post_title)));
    //                         $postTitle = trim(str_replace($category->name.' –', '', str_replace($category->name.' -', '', $postTitle)));
    //                         $postTitle = trim(str_replace('- Landing Page', '', $postTitle));

    //                         echo $postTitle.'<br/>';

    //                         $resourcePost = array(
    //                             'ID'           => $resource->ID,
    //                             'post_title'   => $postTitle,
    //                             'post_type'    => 'commresource',
    //                             'post_parent'  => null,
    //                             'post_name'    => basename(get_permalink($resource->ID)),
    //                         );
    //                         wp_update_post($resourcePost);
    //                         wp_set_post_terms($resource->ID, [$category->term_id], 'commresourcecat', false);

    //                         $resourceTile = '';

    //                         foreach($resourceTiles as $tile):
    //                             if ($tile['link']['url'] == get_permalink($resource->ID)):
    //                                 $resourceTile = $tile;
    //                                 break;
    //                             endif;
    //                         endforeach;

    //                         if (!empty($resourceTile)):
    //                             $tag = get_term_by('name', $resourceTile['category'], 'commresourcetag');

    //                             if (!$tag):
    //                                 $newTermID = wp_insert_term($resourceTile['category'], 'commresourcetag');
    //                                 $tag = get_term($newTermID, 'commresourcetag');
    //                             endif;

    //                             echo 'Tag: '.$resourceTile['category'].' = '.$tag->name.'<br/>';

    //                             echo '<br/>';
    //                             wp_set_post_terms($resource->ID, [$tag->name], 'commresourcetag', false);

    //                             if (isset($resourceTile['image']) && isset($resourceTile['image']['ID'])):
    //                             set_post_thumbnail($resource->ID, $resourceTile['image']['ID']);
    //                             else:
    //                                 echo '<strong>NO IMAGE</strong><br/>';
    //                             endif;

    //                             if (isset($resourceTile['title']) && !empty($resourceTile['title']) && $resourceTile['title'] != $resource->post_title):
    //                                 update_field('short_title', strip_tags($resourceTile['title']), $resource->ID);
    //                             endif;

    //                             if (isset($resourceTile['subtitle'])):
    //                                 update_field('sub_title', strip_tags($resourceTile['subtitle']), $resource->ID);
    //                             endif;

    //                             delete_post_meta($resource->ID, 'custom_permalink');
    //                         else:
    //                             // echo 'empty<br/><br/>';
    //                             update_field('exclude_from_archive', true, $resource->ID);
    //                         endif;
    //                     else:
    //                         // Set the resource thank you pages to be children of the main resource thank you page.
    //                         $resourcePost = array(
    //                             'ID'           => $resource->ID,
    //                             'post_parent'  => 18891
    //                         );
    //                         wp_update_post($resourcePost);
    //                     endif;
    //                 endforeach;
    //             endif;

    //             // Delete the old resource category page.
    //             wp_delete_post($oldCategoryPost->ID);
    //         endforeach;
    //     endif;

    //     //Delete the old resources page
    //     wp_delete_post(18891, true);

    //     //Set the resource thank you page post to not have a parent;
    //     $resourcePost = array(
    //         'ID'           => 18891,
    //         'post_parent'  => null
    //     );
    //     wp_update_post($resourcePost);
    // endif;
}

// add_action('init', __NAMESPACE__ . '\\theme_upgrade');