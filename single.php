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
                                    <h1 class="c-margin-t-0">
                                        <?php the_title(); ?>
                                    </h1>
                                </div>
                                <div class="c-panel c-margin-b-30">
                                            <span>
                                                <?php the_time('F jS, Y'); ?> |
                                                <?php
                                                    //author
                                                    $recent_author_str='';
                                                    if ( function_exists( 'coauthors_posts_links' ) ) {
                                                        $recent_authors = get_coauthors();
                                                        foreach($recent_authors as $recent_author){
                                                            $recent_author_str .= '<a href="'. get_author_posts_url( $recent_author->ID, $recent_author->user_nicename) . '">'. $recent_author->display_name .'</a>, ';
                                                        }
                                                        echo substr($recent_author_str,0,strlen($recent_author_str)-2);
                                                    } else {
                                                        echo '<a href="'.get_author_posts_url( get_the_author_meta( 'ID' ) ).'">'.
                                                            the_author().
                                                        '</a>';
                                                    }
                                                ?> |
                                                <!-- <a href="<?php echo get_author_posts_url( get_the_author_meta( 'ID' ) ); ?>"><?php the_author(); ?></a> |  -->
                                                <?php the_category(', ');?> |
                                                <?php echo do_shortcode('[rt_reading_time label="Estimated Reading Time:" postfix="minutes"]'); ?>
                                            </span>
                                </div>
                                <div class="c-desc c-article">
                                    <?php the_content(); ?>
                                </div>
                                <!-- begin author -->
                                <?php
                                $coauthors = get_coauthors();
                                foreach( $coauthors as $coauthor ):
                                    $archive_link = get_author_posts_url( $coauthor->ID, $coauthor->user_nicename );
                                    $userdata = get_userdata( $coauthor->ID );
                                ?>
                                    <div class="authorsure-author-box">
                                        <?php echo get_avatar( $userdata->user_email, 100 ); ?>
                                        <h4>
                                            About <a href="<?php echo $archive_link; ?>">
                                                <?php echo $userdata->display_name; ?>
                                            </a>
                                        </h4>
                                        <p ><?php echo $userdata->user_description; ?></p>
                                    </div>
                                <?php
                                endforeach;
                                ?>
                                <!-- end author -->
                                <div class="c-article__sharebutton">
                                    <div class="c-article__sharebuttonText">
                                        Find this article helpful? Don’t forget to share.
                                    </div>
                                    <!-- Go to www.addthis.com/dashboard to customize your tools -->
                                    <div class="addthis_inline_share_toolbox_qf55"></div>
                                </div>
                                <!-- The following line set post view counts -->
                                <?php Analytics\setPostViews(get_the_ID()); ?>
                                <!-- Related articles -->
                                <?php
                                    /*
                                    $tags = wp_get_post_tags(get_the_ID());
                                    if ($tags) {
                                        $first_tag = $tags[0]->term_id;

                                    $args=array(
                                        'tag__in' => array($first_tag),
                                        'post__not_in' => array(get_the_ID()),
                                        'showposts'=>5,
                                        'caller_get_posts'=>1,
                                        'orderby'=>'ID'
                                    );

                                    $my_query = new WP_Query($args);

                                    if( $my_query->have_posts() ) { ?>
                                        <div class="c-content-title-1 c-margin-t-50">
                                            <h3 class="c-font-bold">Related Posts</h3>
                                            <div class="c-line-left"></div>
                                        </div>

                                        <ul class="c-content-list-1 c-theme c-separator-dot">
                                        <?php
                                            while ($my_query->have_posts()) : $my_query->the_post(); ?>
                                                <li>
                                                    <a href="<?php the_permalink() ?>" title="<?php the_title_attribute(); ?>"><?php the_title(); ?></a>
                                                </li>
                                        <?php
                                            endwhile;

                                            wp_reset_postdata();
                                        ?>
                                        </ul>

                                    <?php }
                                   }
                                   */
                                ?>
                                <div class="c-center c-margin-t-80">
                                    <a href="/blog/" class="btn btn-lg c-btn-border-2x c-btn-square c-theme-btn c-font-sbold" title="Back to All">
                                        Back to All</a>
                                </div>
                                <?= get_template_part('template-parts/comments'); ?>
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
<div class="related-posts">
    <div class="container">
        <div class="row">
            <div class="col-sm-12"><h3 class="title">Suggested Reading</h3></div>
            <?php
            //Output two related posts for this article. Users can custom select the related posts or optionally we will find
            //related posts that match this posts category.
            $customRelatedPosts = get_field('related_posts');
            $numCustomDefinedPosts = 0;
            $numRelatedPosts = 3;
            $relatedPostIndex = 1;

            if (!empty($customRelatedPosts)) {
                $numCustomDefinedPosts = count($customRelatedPosts);
                $oldPost = $post;

                foreach ($customRelatedPosts as $relatedPost) {
                    $post = $relatedPost;
                    setup_postdata($post);

                    echo '<div class="post-tile col-xs-12 col-sm-6 col-md-4">';
                    get_template_part('template-parts/post', 'tile');
                    echo '</div>';
                }

                $post = $oldPost;
                wp_reset_postdata();
            }

            if ($numCustomDefinedPosts < $numRelatedPosts) {
                $customRelatedPosts = get_posts(
                    array(
                        'category__in' => wp_get_post_categories($post->ID),
                        'numberposts' => ($numRelatedPosts - $numCustomDefinedPosts),
                        'post__not_in' => array($post->ID)
                    )
                );

                if($customRelatedPosts) {
                    $oldPost = $post;

                    foreach($customRelatedPosts as $relatedPost) {
                        $post = $relatedPost;
                        setup_postdata($post);

                        echo '<div class="post-tile col-xs-12 col-sm-6 col-md-4">';
                        get_template_part('template-parts/post', 'tile');
                        echo '</div>';
                    }

                    $post = $oldPost;
                    wp_reset_postdata();
                }

                wp_reset_postdata();
            }
            ?>
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
