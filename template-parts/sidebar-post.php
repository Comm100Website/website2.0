<?php
/**
 * The sidebar containing the main widget area
 *
 * If no active widgets are in the sidebar, hide it completely.
 */
?>

<div class="col-md-3">
    <div class="c-content-ver-nav c-sidebar post-tile post-sidebar">
        <?= get_template_part('template-parts/searchform'); ?>
        <div class="c-content-blog-post-card-1 c-post-cta c-option-2 featured-posts">
            <div class="c-body">
                <h5>Featured Posts</h5>
                <?= get_template_part('template-parts/featuredposts'); ?>
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

        <?php dynamic_sidebar( 'single-sidebar' ); ?>
    </div>
</div>
