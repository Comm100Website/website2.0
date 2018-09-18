<?php
/*
Template Name:company
*/
?>
<?php get_header(); ?>
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
	
   <?php if (have_posts()) : ?>
   <?php while (have_posts()) : the_post(); ?>
          <?php the_content(__('<br/>Continue reading...')); ?>
   <?php endwhile; ?>
   <?php else : ?>
   
   <div class="post">
      <h2>Not found!</h2>
      <p><?php _e('Sorry, this page does not exist.'); ?></p>
      <?php include (TEMPLATEPATH . "/searchform.php"); ?>  
   </div>
   
   <?php endif; ?>

<?php get_footer(''); ?>