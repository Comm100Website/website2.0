<?php
use Roots\Sage\Analytics;
?>
<?php get_template_part('template-parts/header'); ?>
</header>
<!-- posts  -->
<div class="c-layout-page c-layout-page-fixed">
    <!-- BEGIN: PAGE CONTENT -->
    <!-- BEGIN: BLOG LISTING -->
    <div class="c-content-box c-size-md">
        <div class="container">
            <div class="row">
                <?php if (have_posts()) : ?>
                    <?php while (have_posts()) : the_post(); ?>
                    <div class="col-md-9">
                        <div class="c-content-blog-post-1-view">
                            <div class="c-content-blog-post-1">
                                <div class="c-title c-margin-t-0">
                                    <h1 class="c-margin-t-0 c-margin-b-0">
                                        <?php the_title(); ?>
                                    </h1>
                                    <br />
                                </div>
                                <div class="c-desc c-article">
                                    <?php the_content(); ?>
                                </div>
                            </div>
                        </div>
                    </div>
                    <?php endwhile; ?>
                <?php else : ?>
                    <div class="post">
                        <h2>Not found!</h2>
                        <p>
                            <?php _e('Sorry, this page does not exist.'); ?>
                        </p>
                        <?php
                            get_template_part('template-parts/searchform');
                        ?>
                    </div>
                <?php endif; ?>
                <?php get_template_part('template-parts/sidebar', 'post'); ?>
            </div>
        </div>
    </div>
</div>
<?php get_template_part('template-parts/footer'); ?>