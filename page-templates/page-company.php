<?php
/*
Template Name:company
*/
?>
<?php get_template_part('template-parts/header'); ?>
    <div class="c-navbar--secondary visible-md">
        <div class="container">
            <?php
            $defaults = array(
                'theme_location'  => 'company',
                'menu'            => '',
                'container'       => 'nav',
                'container_class' => '',
                'container_id'    => '',
                'menu_class'      => 'clearfix',
                'menu_id'         => '',
                'echo'            => true,
                'fallback_cb'     => 'wp_page_menu',
                'before'          => '',
                'after'           => '',
                'link_before'     => '',
                'link_after'      => '',
                'items_wrap'      => '<ul id="%1$s" class="%2$s">%3$s</ul>',
                'depth'           => 0,
                'walker'          => ''
                );
                wp_nav_menu( $defaults );
            ?>
        </div>
    </div>
</header>


<!-- <div class="c-layout-page c-layout-page-fixed">
    <div class="c-content-box c-size-md">
        <div class="container">
            <div class="row">
                <div class="col-xs-12 col-sm-10 col-sm-offset-1 col-md-8 col-md-offset-2 c-desc c-article"> -->
                    <?php if (have_posts()) : ?>
                    <?php while (have_posts()) : the_post(); ?>
                            <?php the_content(__('<br/>Continue reading...')); ?>
                    <?php endwhile; ?>
                    <?php else : ?>

                        <div class="post">
                            <h2>Not found!</h2>
                            <p><?php _e('Sorry, this page does not exist.'); ?></p>
                            <?php get_template_part('template-parts/searchform'); ?>
                        </div>

                    <?php endif; ?>
               <!-- </div>
            </div>
        </div>
    </div>
</div> -->

<?php get_template_part('template-parts/footer'); ?>
