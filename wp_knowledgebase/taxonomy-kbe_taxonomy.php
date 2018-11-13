<?php
    get_header('knowledgebase');
    
    // Classes For main content div
    if(KBE_SIDEBAR_INNER == 0) {
        $kbe_content_class = 'class="kbe_content_full"';
    } elseif(KBE_SIDEBAR_INNER == 1) {
        $kbe_content_class = 'class="kbe_content_right"';
    } elseif(KBE_SIDEBAR_INNER == 2) {
        $kbe_content_class = 'class="kbe_content_left"';
    }
    
    // Classes For sidebar div
    if(KBE_SIDEBAR_INNER == 0) {
        $kbe_sidebar_class = 'kbe_aside_none';
    } elseif(KBE_SIDEBAR_INNER == 1) {
        $kbe_sidebar_class = 'kbe_aside_left';
    } elseif(KBE_SIDEBAR_INNER == 2) {
        $kbe_sidebar_class = 'kbe_aside_right';
    }
    
    // Query for Category
    $kbe_cat_slug = get_queried_object()->slug;
    $kbe_cat_name = get_queried_object()->name;
    
    $kbe_tax_post_args = array(
        'post_type' => KBE_POST_TYPE,
        'posts_per_page' => 999,
        'orderby' => 'menu_order',
        'order' => 'ASC',
        'tax_query' => array(
            array(
                'taxonomy' => KBE_POST_TAXONOMY,
                'field' => 'slug',
                'terms' => $kbe_cat_slug
            )
        )
    );
    $kbe_tax_post_qry = new WP_Query($kbe_tax_post_args);
?>
<div class="c-layout-page c-layout-page-fixed">
    <div class="c-content-box c-size-md">
        <div id="kbe_container" class="container">
            <div class="row">
                <div id="kbe_container">
                    <div class="col-md-9">
                        <div class="c-content-blog-post-1-view">
                            <div class="c-content-blog-post-1">
                                <!--Breadcrum-->
                                <?php
                                    if(KBE_BREADCRUMBS_SETTING == 1){
                                ?>
                                        <div class="kbe_breadcrum">
                                            <?php echo kbe_breadcrumbs(); ?>
                                        </div>
                                <?php
                                    }
                                ?>
                                <!--/Breadcrum-->
                                    
                                <!--search field-->
                                <?php
                                    if(KBE_SEARCH_SETTING == 1){
                                        kbe_search_form();
                                    }
                                ?>
                                <!--/search field-->
                                    
                                <!--content-->
                                <div id="kbe_content" <?php echo $kbe_content_class; ?>>
                                    <!--leftcol--> 
                                    <div class="kbe_leftcol">

                                        <!--<articles>-->
                                        <div class="kbe_articles">
                                            <h1>Articles in "<?php echo $kbe_cat_name; ?>"</h1>

                                            <ul class="c-ul-kb">
                                                <?php
                                                    if($kbe_tax_post_qry->have_posts()) :
                                                        while($kbe_tax_post_qry->have_posts()) :
                                                            $kbe_tax_post_qry->the_post();
                                                ?>
                                                            <li>
                                                                <h2 class="c-font-22">
                                                                    <a href="<?php the_permalink(); ?>">
                                                                        <?php the_title(); ?>
                                                                    </a>
                                                                </h2>
                                                                <?php the_excerpt(); ?>
                                                                <!-- <div class="kbe_read_more">
                                                                    <a href="<?php the_permalink(); ?>">
                                                                        Read more...
                                                                    </a>
                                                                </div> -->
                                                            </li>
                                                <?php
                                                        endwhile;
                                                    endif;
                                                ?>
                                            </ul>

                                        </div>
                                    </div>
                                    <!--/leftcol-->

                                </div>
                                <!--/content-->
                                
                               
                            </div>
                        </div>
                    </div>
                     <!--aside-->
                    <div class="kbe_aside <?php echo $kbe_sidebar_class; ?> col-md-3">
                        <div class="c-content-ver-nav c-sidebar">
                        <?php
                            if((KBE_SIDEBAR_INNER == 2) || (KBE_SIDEBAR_INNER == 1)){
                                dynamic_sidebar('kbe_cat_widget');
                            }
                        ?>
                        </div>
                    </div>
                    <!--/aside-->
                </div>
            </div>
        </div>
    </div>
</div>
<?php get_footer(); ?>