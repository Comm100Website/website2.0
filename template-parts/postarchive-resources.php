<?php
use Roots\Sage\Assets;
?>
    <div class="c-layout-page c-layout-page-fixed primary-page">
        <div class="c-content-box c-size-md">
            <div class="container">
                <div class="row">
                    <div class="col-xs-12">
                        <?php if (have_posts()): ?>
                            <h1 class="c-center">Resource Base</h1>
                            <h2 class="c-margin-t-20 c-margin-b-60 text-center">Everything you need to know to start the conversation</h2>
                            <?php
                            $resourceCategories = get_terms([
                                'taxonomy' => 'commresourcecat',
                                'hide_empty' => true,
                                'orderby' => 'name',
                                'order' => 'ASC',
                                'exclude' => '2829',
                            ]);

                            $navItems = [
                                'All' => get_site_url().'/resources/'
                            ];

                            foreach($resourceCategories as $cat):
                                $navItems[$cat->name] = get_term_link($cat, 'commresourcecat');
                            endforeach;

                            $navItems['Blog'] = get_site_url().'/blog/';

                            echo '<ul class="post-nav">';
                            global $wp;
                            $currentPageURL = home_url($wp->request).'/';

                            foreach ($navItems as $label => $url):
                                $is_active = ((is_post_type_archive('commresource') && $label == 'All') || $url == $currentPageURL);
                                echo '<li class="'.($is_active ? 'active' : '').' hidden-xs"><a href="'.$url.'">'.$label.'</a></li>';
                            endforeach;

                            echo '</ul>';

                            if (!is_paged()):
                                $args = [
                                    'post_type' => 'commresource',
                                    'posts_per_page' => 2,
                                    'meta_query' => [
                                        [
                                            'key' => 'featured_resource',
                                            'value' => '1'
                                        ]
                                    ]
                                ];

                                if (is_tax('commresourcecat')):
                                    $args['tax_query'] = [
                                        [
                                            'taxonomy' => 'commresourcecat',
                                            'field'    => 'term_id',
                                            'terms'    => get_queried_object_id(),
                                        ]
                                    ];
                                endif;

                                $featuredResources = new WP_Query($args);

                                if ($featuredResources->have_posts()):
                                    echo '<div class="resource-promotion clearfix">';
                                    // loop through the rows of data
                                    while ($featuredResources->have_posts()):
                                        $featuredResources->the_post();
                                        ?>
                                        <div class="col-xs-12 col-sm-6">
                                            <?= get_template_part('template-parts/resource', 'tile'); ?>
                                        </div>
                                    <?php
                                    endwhile;
                                    echo '</div>';

                                    wp_reset_postdata();
                                endif;
                            endif;
                            ?>
                            <div class="resource-list post-tiles clearfix">
                            <?php
                            $ctas = get_field('resources_ctas', 'options');
                            $postIndex = 0;
                            $ctaIndex = 0;

                            while (have_posts()) : the_post();
                            ?>
                                <div class="col-xs-12 col-sm-6 col-md-4">
                                    <?= get_template_part('template-parts/resource', 'tile'); ?>
                                </div>

                                <?php
                                if ($ctas && !is_paged() && in_array($postIndex, [4, 7]) && $ctaIndex < count($ctas)):
                                ?>
                                    <div class="resource-item col-xs-12 col-sm-6 col-md-4">
                                        <div class="CTA">
                                            <?= Assets\get_acf_image($ctas[$ctaIndex]['image'], '', 120, 120); ?>
                                            <div class="resource-item--title"><?= $ctas[$ctaIndex]['title']; ?></div>
                                            <?php
                                            if (isset($ctas[$ctaIndex]['subtitle'])):
                                                echo $ctas[$ctaIndex]['subtitle'];
                                            endif;

                                            if (isset($ctas[$ctaIndex]['link'])):
                                                $linkClass = 'c-redirectLink';

                                                switch ($ctas[$ctaIndex]['link_type']):
                                                    case 'green' :
                                                        $linkClass = 'btn btn-xlg btn-link--green';
                                                        break;
                                                    case 'blue' :
                                                        $linkClass = 'btn btn-xlg c-theme-btn';
                                                        break;
                                                    case 'white' :
                                                        $linkClass = 'btn btn-xlg c-btn-border-2x c-theme-btn';
                                                        break;
                                                    default: break;
                                                endswitch;
                                            ?>
                                                <div class="resource-item-CTA-link">
                                                    <a class="<?= $linkClass; ?>" href="<?= $ctas[$ctaIndex]['link']['url']; ?>" target="<?= $ctas[$ctaIndex]['link']['target']; ?>"><?= $ctas[$ctaIndex]['link']['title']; ?></a>
                                                </div>
                                            <?php endif; ?>
                                        </div>
                                    </div>
                                <?php
                                    $ctaIndex++;
                                endif;

                                $postIndex++;
                            endwhile;
                            ?>
                            </div>
                            <?php
                            the_posts_pagination([
                                'mid_size'  => 2,
                                'prev_text' => __( '<i class="fa fa-angle-left"></i>', 'textdomain' ),
                                'next_text' => __( '<i class="fa fa-angle-right"></i>', 'textdomain' ),
                                'screen_reader_text' => ''
                            ]);
                        ?>
                        <?php else : ?>
                            <div class="post text-center">
                                <h2>No resources found!</h2>
                                <p class="text-center"><?php _e('Sorry, no resources were found for this category.'); ?></p>
                                <?php get_template_part('template-parts/searchform'); ?>
                            </div>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>
    </div>