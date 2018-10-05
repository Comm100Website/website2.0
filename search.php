<?php get_header(); ?>
</header>
          
 <!-- posts  -->
<div class="c-layout-page c-layout-page-fixed">
    <!-- BEGIN: BLOG LISTING -->
    <div class="c-content-box c-size-md">
        <div class="container">
          <div class="row"> 
            <div class="col-md-9">
                <h1>Search results for: <?php the_search_query(); ?></h1>
                <div class="c-content-blog-post-card-1-grid">
                  
                    <?php 
                      global $wp_query;
                      $args = array_merge( $wp_query->query, array( 'post_type' => 'post' ) );
                      query_posts( $args ); 
                    ?>
                    <?php if (have_posts()) : ?>
                      <div class="row">
                        <?php while (have_posts()) : the_post(); ?>
                          
                            <div class="col-md-6">
                              <div class="c-content-blog-post-card-1 c-option-2 c-bordered">
                                  <div class="c-media c-content-overlay">
                                    <a href="<?php the_permalink(); ?>">
                                    <?php // check if the post has a Post Thumbnail assigned to it.
                                        if (has_post_thumbnail()) {
                                          the_post_thumbnail();
                                        }
                                      ?>
                                      </a>
                                  </div>
                                  <div class="c-body">
                                      <div class="c-title c-font-bold">
                                          <a  href="<?php the_permalink(); ?>" rel="bookmark" title="<?php the_title(); ?>"><?php the_title(); ?></a>
                                      </div>
                                      <div class="c-author">
                                          <span><?php the_time('F jS, Y'); ?> | <?php the_category(', '); ?> |  <a href="<?php echo get_author_posts_url( get_the_author_meta( 'ID' ) ); ?>"><?php the_author(); ?></a> </span>
                                      </div>
                                  </div>
                              </div>
                            </div>
                          
                        <?php endwhile; ?>
                      </div>
                      <div class="clear"></div>
                      <div class="c-pagination">
                        <!--<?php next_posts_link('&laquo; Previous posts') ?> <?php previous_posts_link('Next posts &raquo;') ?><br/><br/>
                        <a href="#posts"><img src="<?php bloginfo('template_directory'); ?>/images/backtotopicon.gif" alt="Back to top" />Back to top</a>-->
                            <?php pagenavi(); ?>
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
            <?php get_template_part('template-parts/sidebar'); ?>
          </div>
        </div>
    </div>
</div>
  




<?php get_footer(); ?>