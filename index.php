<?php get_header(); ?>
</header>
        
<!-- posts  -->
<div class="c-layout-page c-layout-page-fixed">
        <!-- BEGIN: BLOG LISTING -->
        <div class="c-content-box c-size-md">
            <div class="container">
                <div class="row">
                    <div class="col-md-9">
                      <h1 class="c-post-list-h1">Comm100 Live Chat Blog</h1>
                      <?php
                        $current_page = (get_query_var('paged') ? get_query_var('paged') : 1);
                        if($current_page == 1){
                      ?>
                        <div class="c-margin-b-80 img-promotion-container">
                          <div class="img-promotion">
                              <?php 
                                $args = array( 'numberposts' => '1', 'post_status' => 'publish, pending, private' );
                                $recent_posts = wp_get_recent_posts($args);
                                foreach( $recent_posts as $recent ){
                                    //category
                                    $cats = get_the_category($recent["ID"]);
                                    $catstr = '';
                                    foreach($cats as $cat){
                                        $category_name = $cat->name;
                                        $category_id = get_cat_ID( $category_name );
                                        $category_link = get_category_link( $category_id );
                                        $catstr = '<a href="'.$category_link.'">'.$category_name.'</a>, ';
                                    }
                                    $catstr = substr($catstr,0,strlen($catstr)-2); 

                                    //author
                                    $recent_author_str = '';
                                    if ( function_exists( 'coauthors_posts_links' ) ) {
                                        $recent_authors = get_coauthors($recent["ID"]);
                                        foreach($recent_authors as $recent_author){
                                            $recent_author_str .= '<a href="'. get_author_posts_url( $recent_author->ID, $recent_author->user_nicename) . '">'. $recent_author->display_name .'</a>, ';
                                        }
                                        $recent_author_str = substr($recent_author_str,0,strlen($recent_author_str)-2); 
                                    } else {
                                        $recent_author = get_user_by( 'ID', $recent["post_author"] );
                                        $author_display_name = $recent_author->display_name;
                                        $author_url = get_author_posts_url($recent["post_author"]);
                                        $recent_author_str = '<a href="'.$author_url.'">'.$author_display_name.'</a>';
                                    }
                                    
                                    // $excerptstr = get_the_excerpt();
                                    $excerptstr = empty(get_post($recent["ID"])->post_excerpt) ? wp_trim_words(get_post($recent["ID"])->post_content, 55, '...')
                                                                                        : get_post($recent["ID"])->post_excerpt;

                                    $post_thumbnail = "";
                                    if ( has_post_thumbnail() ) { // check if the post has a Post Thumbnail assigned to it.
                                       $post_thumbnail = get_the_post_thumbnail($recent["ID"], 'full');
                                    }
                                    echo '<a href="' . get_permalink($recent["ID"]) . '">' . $post_thumbnail .'</a>
                                          <div class="c-desc c-margin-t-30">
                                            <h4 class="c-font-22 c-font-thin c-font-bold">
                                                <a href="' . get_permalink($recent["ID"]) . '">' . $recent["post_title"].'</a></h4>
                                            <div class="c-author c-margin-t-15 c-margin-b-15">
                                                <span>
                                                   '. date( 'F jS, Y', strtotime( $recent['post_date'] ) ) .'</span> | '.$catstr.' | ' . $recent_author_str . '
                                            </div>
                                            <div class="c-font-17 c-font-thin">
                                                '. $excerptstr .' <a href="'. get_permalink($recent["ID"]) .'">Read More</a>
                                            </div>
                                        </div>';
                                    
                                }
                              ?>
                          </div>
                        </div>
                      <?php  }?>
                      
                      <div class="c-content-blog-post-card-1-grid">
                            <div class="row">
                                
                                <?php
                                    $current_page = (get_query_var('paged') ? get_query_var('paged') : 1);
                                    $maxposts = get_option('posts_per_page');
                                    //if($current_page == 1){ 
                                      query_posts('offset='. strval(($current_page-1)*$maxposts+1));
                                    //}
                                    if (have_posts()) : ?>

                                    <?php while (have_posts()) : the_post(); ?>
                                      <div class="col-sm-6">
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
                                                    <span>
                                                        <?php the_time('F jS, Y'); ?> | 
                                                        <?php the_category(', '); ?> |  

                                                        <?php
                                                            //author
                                                            $recent_author_str='';
                                                            if ( function_exists( 'coauthors_posts_links' ) ) {
                                                                $recent_authors = get_coauthors("ID");
                                                                foreach($recent_authors as $recent_author){
                                                                    $recent_author_str .= '<a href="'. get_author_posts_url( $recent_author->ID, $recent_author->user_nicename) . '">'. $recent_author->display_name .'</a>, ';
                                                                }
                                                                echo substr($recent_author_str,0,strlen($recent_author_str)-2); 
                                                            } else {
                                                                echo '<a href="'.get_author_posts_url( get_the_author_meta( 'ID' ) ).'">'.
                                                                    the_author().
                                                                '</a>';
                                                            }
                                                        ?>
                                                    </span>
                                                </div>
                                                <!-- <hr/>
                                                <div class="postcontent">
                                                <?php the_excerpt(); ?>
                                                    <a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>">Read More</a>
                                                </div>
                                                
                                                <div class="f-r c-margin-t-10">
                                                  <div class="addthis_sharing_toolbox" data-url="<?php the_permalink(); ?>" data-title="<?php the_title(); ?>"></div>
                                                </div> -->
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
                              <?php pagenavi(); ?>
                            </div>
                      </div>
                    </div>
                    
                    <?php get_template_part('template-parts/sidebar'); ?>
                   
                  </div>
            </div>
        </div>
</div>



<?php get_footer(''); ?>
