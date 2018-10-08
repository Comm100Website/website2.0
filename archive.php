<?php get_header(); ?>
</header>
        
<!-- posts  -->
<div class="c-layout-page c-layout-page-fixed">
    <!-- BEGIN: BLOG LISTING -->
    <div class="c-content-box c-size-md">
        <div class="container">
      <div class="row"> 
            <div class="col-md-9">
            <?php
                if ( function_exists( 'coauthors_posts_links' ) ) {
                    global $post;
                    $author_id=get_the_author_meta('ID');
                    $userdata = get_userdata( $author_id ); 
            ?>
                    <div id="authorsure-author-profile" class="c-margin-b-60">
                        <h1 class="authorsure-author-title">About <?php echo $userdata->display_name; ?></h1>
                        <?php echo get_avatar( $userdata->user_email, 100 ); ?>
                        <p>
                            <?php echo $userdata->user_description; ?>
                        </p>
                        <div class="clear"></div>
                    </div>
            <?php
                }
            ?>
            <?php if (have_posts()) : ?>
            <?php $post = $posts[0]; ?>
            <?php if (is_category()) { ?><h1 class="c-post-list-h1">Archive for '<?php echo single_cat_title(); ?>'</h1>
            <?php } elseif (is_day()) { ?><h1 class="c-post-list-h1">Archive for <?php the_time('F jS, Y'); ?></h1>
            <?php } elseif (is_month()) { ?><h1 class="c-post-list-h1">Archive for <?php the_time('F, Y'); ?></h1>
            <?php } elseif (is_year()) { ?><h1 class="c-post-list-h1">Archive for the year <?php the_time('Y'); ?></h1>
            <?php } elseif (is_tag()) { ?><h1 class="c-post-list-h1">Tag: <?php single_tag_title(''); ?></h1>
            <?php } elseif (is_search()) { ?><h1 class="c-post-list-h1">Search results</h1>
            <?php } elseif (isset($_GET['paged']) && !empty($_GET['paged'])) { ?><h1 class="c-post-list-h1">Archives</h1>
            <?php } ?>
            <?php else : ?>
             <div class="post" style="border-bottom: none">
                <p><?php _e('No posts found. Try a search?'); ?></p>
                <?php
            get_template_part('template-parts/searchform');
           ?> 
             </div> 
            <?php endif; ?>
            <div class="c-content-blog-post-card-1-grid">
                        <div class="row">
                <?php if (have_posts()) : ?>
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
                                    <div class="clear"></div>
                                    
                                <?php else : ?>
                                  <div class="post">
                                      <h2>Not found!</h2>
                                      <p><?php _e('Sorry, this page does not exist.'); ?></p>
                                      <?php
                                       get_template_part('template-parts/searchform');
                                      ?>  
                                  </div>     
                                <?php endif; ?>
            </div>
              <div class="c-pagination">
                <!--<?php next_posts_link('&laquo; Previous posts') ?> <?php previous_posts_link('Next posts &raquo;') ?><br/><br/>
                <a href="#posts"><img src="<?php bloginfo('template_directory'); ?>/images/backtotopicon.gif" alt="Back to top" />Back to top</a>-->
                 <?php pagenavi(); ?>
              </div>
           </div>   
        </div>
        <?php get_template_part('template-parts/sidebar'); ?>
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