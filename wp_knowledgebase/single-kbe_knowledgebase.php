<?php
    $parts = parse_url(strtolower('http://'.$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI']));
    parse_str($parts['query'], $query);

    $ifFullScreen;

    if (isset($query['from']) && $query['from']==='chatwindow') {
        get_header('knowledgebasefull');
        $kbe_container_class = 'col-sm-12';
        $ifFullScreen = true;
    } else {
        get_header('knowledgebase');
        $kbe_container_class = 'col-sm-9';
        $ifFullScreen = false;
    }
    
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
?>
<div class="c-layout-page c-layout-page-fixed" style="<?php echo $ifFullScreen ? 'margin-top: 0' : '' ?>">
    <div class="c-content-box c-size-md">
        <div id="kbe_container" class="container">
            <div class="row">
                <div id="kbe_container">
                    <div class="<?php echo $kbe_container_class; ?>">
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
                                <div id="kbe_content" <?php echo $ifFullScreen ? 'col-sm-12' : 'col-sm-9'; ?>>
                                    <!--Content Body-->
                                    <div class="kbe_leftcol" >
                                    <?php
                                        while(have_posts()) :
                                            the_post();

                                            //  Never ever delete it !!!
                                            kbe_set_post_views(get_the_ID());
                                    ?>
                                            <div class="c-title c-font-bold c-margin-t-0"><h1 class="c-margin-t-0 c-margin-b-30"><?php the_title(); ?></h1></div>
                                            <div class="c-panel c-margin-b-30">
                                                <span>
                                                    <?php the_time('F jS, Y'); ?> | 
                                                    <?php 
                                                        $kbe_bc_term = get_the_terms( get_the_ID() , KBE_POST_TAXONOMY );
                                                        foreach($kbe_bc_term as $kbe_tax_term){
                                                    ?>
                                                    <a href="<?php echo get_term_link($kbe_tax_term->slug, KBE_POST_TAXONOMY) ?>">
                                                        <?php echo $kbe_tax_term->name ?>
                                                    </a>
                                                    <?php
                                                        }
                                                    ?> <!-- | 
                                                    <a href="<?php echo get_author_posts_url( get_the_author_meta( 'ID' ) ); ?>"><?php the_author(); ?></a> -->
                                                </span>
                                            </div>
                                            <div class="c-desc c-article">
                                            <?php 
                                                the_content();
                                            ?>
                                            </div>
                                            <?php 
                                                if(KBE_COMMENT_SETTING == 1){
                                            ?>
                                                <div class="kbe_reply">
                                                <?php
                                                            comments_template("wp_knowledgebase/kbe_comments.php");
                                                ?>
                                                </div> 
                                    <?php
                                            }
                                        endwhile;

                                        //  Never ever delete it !!!
                                        kbe_get_post_views(get_the_ID());
                                    ?>
                                        <?php
                                        if (!$ifFullScreen) {
                                            echo '<div class="c-center c-margin-t-80">
                                                <a href="https://www.comm100.com/livechat/knowledgebase/" class="btn btn-lg c-btn-square c-theme-btn c-btn-bold c-btn-uppercase" title="Back to All">
                                                    Back to All</a>
                                            </div>
                                            <div class="disqus">
                                                <div id="disqus_thread">
                                                </div>
                                                <script type="text/javascript">
                                                    /* * * CONFIGURATION VARIABLES * * */
                                                    var disqus_shortname = "livechatkb";

                                                    /* * * DON\'T EDIT BELOW THIS LINE * * */
                                                    (function () {
                                                        var dsq = document.createElement("script"); dsq.type = "text/javascript"; dsq.async = true;
                                                        dsq.src = "//" + disqus_shortname + ".disqus.com/embed.js";
                                                        (document.getElementsByTagName("head")[0] || document.getElementsByTagName("body")[0]).appendChild(dsq);
                                                    })();
                                                </script>
                                                <noscript>
                                                    Please enable JavaScript to view the <a href="https://disqus.com/?ref_noscript" rel="nofollow">
                                                        comments powered by Disqus.</a></noscript>
                                            </div>';
                                        }
                                        
                                        ?>
                                    </div>
                                    <!--/Content Body-->

                                </div>
                            </div>
                        </div>
                	</div>
                    <!--aside-->
                    <div class="kbe_aside <?php echo $kbe_sidebar_class; ?> col-md-3" style="<?php echo $ifFullScreen ? 'display: none' : 'display: block' ?>">
                        <div class="c-content-ver-nav c-sidebar">
                            <?php
                                if(!$ifFullScreen) {
                                    if((KBE_SIDEBAR_INNER == 2) || (KBE_SIDEBAR_INNER == 1)){
                                        dynamic_sidebar('kbe_cat_widget');
                                    }
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
<?php 
    if (!$ifFullScreen) {
        get_footer();
    } else {
        return "</body></html>";
    }
?>