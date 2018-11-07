<?php use Roots\Sage\Navigation; ?>
<?php get_template_part('template-parts/header'); ?>
</header>
<div class="c-layout-page c-layout-page-fixed">
    <div class="c-content-box c-size-md">
        <div class="container">
            <div class="row">
                <div class="col-xs-12">
                    <ul class="post-nav">
                        <li class="hide"><a href="/blog/">Blog Home</a></li>
                    <?php
                    $categories = get_categories();

                    foreach ($categories as $category):
                        $is_active = ($category->term_id == get_queried_object_id());
                        echo '<li class="'.($is_active ? 'active' : '').' hidden-xs"><a href="'.get_category_link($category->term_id).'">'.$category->name.'</a></li>';
                    endforeach;
                    ?>
                    </ul>
                </div>
            </div>
            <div class="row post-tiles">
                <?php
                $postIndex = 0;

                if (!is_paged()):
                    $blogCTAs = get_field('blog_ctas', 'options');
                    $ctas = [];

                    if ($blogCTAs):
                        foreach($blogCTAs as $key => $cta):
                            if(isset($cta['feature_in_archive']) && $cta['feature_in_archive']):
                                $ctas[] = $cta;
                            endif;
                        endforeach;
                    endif;

                    $ctaIndex = 0;
                endif;

                while (have_posts()) : the_post();
                    $postClass = ' post-tile col-xs-12';

                    if (is_paged() || $postIndex >= 1):
                        $postClass .= ' col-sm-6 col-md-4';
                    else:
                        $postClass .= ' col-md-8 ';
                    endif;
                    ?>
                    <div class="<?= $postClass; ?>">
                        <?= get_template_part('template-parts/post', 'tile'); ?>
                    </div>

                    <?php
                    if (!is_paged() && $postIndex == 0):
                    ?>
                        <div class="post-tile post-sidebar col-xs-12 col-sm-6 col-md-4">
                            <?= get_template_part('template-parts/searchform'); ?>

                            <div class="c-content-blog-post-card-1 c-post-cta c-option-2 featured-posts">
                                <div class="c-body">

                                    <h5>Featured Posts</h5>
                                    <?= get_template_part('template-parts/featuredposts'); ?>
                                </div>
                            </div>
                        </div>
                    <?php
                    endif;

                    if ($ctas && !is_paged() && in_array($postIndex, [3, 7, 11]) && $ctaIndex < count($ctas)):
                        echo '<div class="post-tile col-xs-12 col-sm-6 col-md-4">';
                        set_query_var('cta', $ctas[$ctaIndex]);
                        get_template_part('template-parts/post', 'cta');
                        echo '</div>';
                        $ctaIndex++;
                    endif;

                    $postIndex++;
                endwhile;
                ?>
            </div>
            <div class="row">
                <div class="col-xs-12">
                    <?php
                    the_posts_pagination([
                        'mid_size'  => 2,
                        'prev_text' => __( '<i class="fa fa-angle-left"></i>', 'textdomain' ),
                        'next_text' => __( '<i class="fa fa-angle-right"></i>', 'textdomain' ),
                        'screen_reader_text' => ''
                    ]);
                    ?>
                </div>
            </div>
        </div>
    </div>
</div>
<?php get_template_part('template-parts/footer'); ?>