<?php use Roots\Sage\Navigation; ?>
<?php get_template_part('template-parts/header'); ?>
</header>

 <!-- posts  -->
<div class="c-layout-page c-layout-page-fixed">
    <!-- BEGIN: BLOG LISTING -->
    <div class="c-content-box c-size-md">
        <div class="container">
          <div class="row">
            <div class="col-xs-12">
                <h1>Search results for: <?php the_search_query(); ?></h1>
                <br/>
                <div class="c-content-blog-post-card-1-grid">

                    <?php
                      global $wp_query;
                      $args = array_merge( $wp_query->query, array( 'post_type' => 'post' ) );
                      query_posts( $args );
                    ?>
                    <?php if (have_posts()) : ?>
                      <div class="row post-tiles">
                        <?php while (have_posts()) : the_post(); ?>
                            <div class="post-tile col-xs-12 col-sm-6 col-md-4">
                                <?= get_template_part('template-parts/post', 'tile'); ?>
                            </div>
                        <?php endwhile; ?>
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

                    <?php else : ?>

                    <div class="post">
                      <p><?php _e('No posts found. Try a different search?'); ?></p>
                      <?php
                        get_template_part('template-parts/searchform');
                      ?>
                    </div>

                    <?php endif; ?>

                </div>
            </div>
          </div>
        </div>
    </div>
</div>
<?php get_template_part('template-parts/footer'); ?>