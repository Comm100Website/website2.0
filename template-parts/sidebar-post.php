<?php
/**
 * The sidebar containing the main widget area
 *
 * If no active widgets are in the sidebar, hide it completely.
 */
?>
<div class="col-md-3">
    <div class="c-content-ver-nav c-sidebar post-tile post-sidebar">
        <?php if (!in_array($post->post_type, ['course', 'lesson'])): ?>
            <?= get_template_part('template-parts/searchform'); ?>
            <div class="c-content-blog-post-card-1 c-post-cta c-option-2 featured-posts">
                <ul class="nav nav-tabs" id="myTabs" role="tablist">
                    <li role="presentation" class="active"><a href="#featured" role="tab" id="featured-tab" data-toggle="tab" aria-controls="featured" aria-expanded="true">Featured</a></li>
                    <li role="presentation"><a href="#categories" id="categories-tab" role="tab" data-toggle="tab" aria-controls="categories">Categories</a></li>
                </ul>
                <div class="tab-content" id="myTabContent">
                    <div class="tab-pane fade in active" role="tabpanel" id="featured" aria-labelledby="featured-tab">
                        <?= get_template_part('template-parts/featuredposts'); ?>
                    </div>
                    <div class="tab-pane fade" role="tabpanel" id="categories" aria-labelledby="categories-tab">
                        <ul class="category-nav">
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
            </div>
            <!-- Go to www.addthis.com/dashboard to customize your tools -->
            <div class="addthis_custom_follow"></div>
            <?php
            $ctas = get_field('blog_ctas', 'options');

            foreach($ctas as $cta):
                if (isset($cta['feature_on_post_sidebar']) && $cta['feature_on_post_sidebar']):
                    echo '<div class="row"><div class="post-tile col-xs-12">';
                    set_query_var('cta', $cta);
                    get_template_part('template-parts/post', 'cta');
                    echo '</div></div>';
                endif;
            endforeach;
            ?>
        <?php endif; ?>
        <?php dynamic_sidebar( 'single-sidebar' ); ?>
    </div>
</div>
