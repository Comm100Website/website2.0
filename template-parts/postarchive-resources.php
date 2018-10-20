<?php if (have_posts()) : ?>
    <div class="c-content-box c-size-md">
        <div class="container">
            <div class="row">
                <div class="col-xs-12">
                    <h1 class="c-center">Resource Base</h1>
                    <h2 class="c-margin-t-20 c-margin-b-60 text-center">Everything you need to know to start the conversation</h2>
                    <?php
                    $resourceCategories = get_terms([
                        'taxonomy' => 'commresourcecat',
                        'hide_empty' => true,
                    ]);

                    $navItems = [
                        'All' => get_site_url().'/resources/'
                    ];

                    foreach($resourceCategories as $cat):
                        $navItems[$cat->name] = get_term_link($cat, 'commresourcecat');
                    endforeach;

                    $navItems['Blog'] = get_site_url().'/blog/';

                    echo '<ul class="resources-nav">';

                    // loop through the rows of data
                    foreach ($navItems as $label => $url):
                        $is_active = false;

                        if ($url == get_term_link(get_queried_object(), 'commresourcecat')):
                            $is_active = true;
                        endif;

                        echo    '<li class="' . ($is_active ? 'active' : '') . '">' .
                                    '<a href="' . $url . '">' . $label . '</a>' .
                                '</li>';
                    endforeach;

                    echo '</ul>';

                    $args = [
                        'post_type' => 'commresource',
                        'posts_per_page' => 2,
                        'meta_query' => [
                            [
                                'key' => 'featured_case_study',
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
                    ?>
                    <div class="resource-list clearfix">
                    <?php while (have_posts()) : the_post(); ?>
                        <div class="col-xs-12 col-sm-6 col-md-4">
                            <?= get_template_part('template-parts/resource', 'tile'); ?>
                        </div>
                        <?php endwhile; ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
  <?php else : ?>

  <div class="post">
    <h2>Not found1!</h2>
    <p><?php _e('Sorry, this page does not exist.'); ?></p>
    <?php get_template_part('template-parts/searchform'); ?>
  </div>

  <?php endif; ?>