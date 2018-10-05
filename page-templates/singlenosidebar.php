<?php
/*
Template Name Posts: Single Post No Sidebar
*/
?>
<?php get_header(); ?>
</header>
        
<!-- posts  -->
<div class="c-layout-page c-layout-page-fixed">
    <!-- BEGIN: PAGE CONTENT -->
    <!-- BEGIN: BLOG LISTING -->
    <div class="c-content-box c-size-md">
        <div class="container">
            <div class="row clearfix">
                <?php if (have_posts()) : ?>
                    <?php while (have_posts()) : the_post(); ?>
                        <div class="col-lg-10 col-md-10 col-sm-10 col-lg-push-1 col-md-push-1 col-sm-push-1 kb-content-nosidebar" id="post-<?php the_ID(); ?>">
                            <div class="c-content-blog-post-1-view">
                                <div class="c-content-blog-post-1">
                                    <div class="c-title c-font-bold c-margin-t-0">
                                        <h1>
                                            <?php the_title(); ?>
                                        </h1>
                                    </div>
                                    <div class="c-desc c-article">
                                        <?php the_content(); ?>
                                    </div> 

                                    <!-- The following line set post view counts -->
                                    <?php setPostViews(get_the_ID()); ?>
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

<?php get_footer(); ?>