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
                    <div class="col-xs-12 col-sm-10 col-sm-offset-1">
                        <div class="c-content-blog-post-1-view">
                            <div class="c-content-blog-post-1">
                                <div class="c-title c-margin-t-0 text-center">
                                    <h1 class="c-margin-t-0 c-margin-b-0">
                                        <?php the_title(); ?>
                                    </h1>
                                </div>
                                <div class="c-margin-b-30 post-meta text-center">
                                    <span>
                                        <?php the_time('F jS, Y'); ?>
                                    </span>
                                </div>
                                <div class="c-desc c-article">
                                    <?php the_content(); ?>
                                    <h6><strong>ABOUT COMM100</strong></h6>
                                    <?= get_field('about_comm100', 'options'); ?>
                                    <br/>
                                    <hr/>
                                    <br/>
                                    <h6><strong>COMM100 MEDIA CONTACT</strong></h6>
                                    <?= get_field('media_contact', 'options'); ?>
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
            </div>
        </div>
    </div>
</div>
<script type="text/javascript">
        var addthis_share = addthis_share || {}
        addthis_share = {
            passthrough: {
                twitter: {
                    via: "Comm100"
                }
            }
        }
</script>
<!-- Go to www.addthis.com/dashboard to customize your tools -->
<script type="text/javascript" src="//s7.addthis.com/js/300/addthis_widget.js#pubid=ra-4e2faac9507104da"></script>
<?php get_template_part('template-parts/footer'); ?>
