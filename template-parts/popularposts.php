<?php
use Roots\Sage\Analytics;
?>
    <div class="c-content-title-1 c-theme c-title-md c-margin-t-40">
        <h3 class="c-font-bold">
            Popular Posts</h3>
        <div class="c-line-left c-theme-bg">
        </div>
    </div>

    <ul class="c-menu c-arrow-dot1 c-theme">

        <?php
	        query_posts('meta_key=post_views_count&orderby=meta_value_num&order=DESC&showposts=5');
	        if (have_posts()) : while (have_posts()) : the_post(); ?>

            <li>
                <div class="c-image" style="background-image: url('<?php the_post_thumbnail_url(); ?>')"></div>
                <a href="<?php the_permalink();?>" title="<?php the_title_attribute(); ?>"><?php the_title(); ?></a>
                <!-- <?php echo Analytics\getPostViews(get_the_ID()); ?> -->
            </li>
        <?php
            endwhile; endif;
            wp_reset_query(); ?>
    </ul>
