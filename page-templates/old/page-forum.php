<?php
/*
Template Name:forum
*/
?>
<?php get_template_part('template-parts/header'); ?>
  <div class="c-topbar c-navbar">
        <div class="container">
            <div class="c-brand">
                <button class="c-search-toggler" type="button">
                    <i class="fa fa-search"></i>
                </button>
                <button class="c-hor-nav-toggler" type="button" data-target=".c-top-menu">
                    <span class="c-line"></span>
                    <span class="c-line"></span>
                    <span class="c-line"></span>
                </button>
            </div>
            <!-- BEGIN: QUICK SEARCH -->
            <form class="c-quick-search" action="/search/">
                <input type="text" name="q" placeholder="Search Comm100.com..." value="" class="form-control" autocomplete="off">
                <span class="c-theme-link">&times;</span>
            </form>
            <!-- END: QUICK SEARCH -->

            <!-- Dropdown menu toggle on mobile: c-toggler class can be applied to the link arrow or link itself depending on toggle mode -->
            <?php
              $defaults = array(
                  'theme_location'  => 'primary',
                  'menu'            => '',
                  'container'       => 'nav',
                  'container_class' => 'c-top-menu c-mega-menu c-pull-right c-mega-menu-light c-mega-menu-dark-mobile c-theme c-fonts-uppercase',
                  'container_id'    => '',
                  'menu_class'      => 'nav navbar-nav c-theme-nav',
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
            <!-- END: INLINE NAV -->
        </div>
  </div>
  <div class="c-navbar c-navbar-onepage">
    <div class="container">
          <!-- BEGIN: BRAND -->
        <div class="c-navbar-wrapper clearfix">
            <div class="c-brand c-pull-left">
                <a href="/livechat/" class="c-logo">
                    <span class="c-logo-img"><img src="<?php bloginfo('template_url');?>/assets/base/img/layout/logos/logo-comm100livechat.svg" alt="Comm100" class="c-desktop-logo"/></span>
                  </a>
                <button class="c-hor-nav-toggler" type="button" data-target=".c-top2-menu">
                    <span class="c-line"></span>
                    <span class="c-line"></span>
                    <span class="c-line"></span>
                </button>

            </div>
            <!-- END: BRAND -->

            <!-- BEGIN: HOR NAV -->
            <!-- BEGIN: LAYOUT/HEADERS/MEGA-MENU -->
            <!-- BEGIN: MEGA MENU -->

            <!-- Dropdown menu toggle on mobile: c-toggler class can be applied to the link arrow or link itself depending on toggle mode -->
            <?php
              $defaults = array(
                  'theme_location'  => 'forum',
                  'menu'            => '',
                  'container'       => 'nav',
                  'container_class' => 'c-top2-menu c-mega-menu c-pull-right c-mega-menu-light c-mega-menu-dark-mobile c-theme c-onepage-menu',
                  'container_id'    => '',
                  'menu_class'      => 'nav navbar-nav c-theme-nav',
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

          <!-- END: MEGA MENU -->
          <!-- END: LAYOUT/HEADERS/MEGA-MENU -->
          <!-- END: HOR NAV -->
        </div>
    </div>
  </div>
  </header>
  <?php if (have_posts()) : ?>
  <?php while (have_posts()) : the_post(); ?>
	   <?php the_content(__('<br/>Continue reading...')); ?>
  <?php endwhile; ?>
  <?php else : ?>

  <div class="post">
    <h2>Not found1!</h2>
    <p><?php _e('Sorry, this page does not exist.'); ?></p>
    <?php get_template_part('template-parts/searchform'); ?>
  </div>

  <?php endif; ?>

<?php get_template_part('template-parts/footer', 'home'); ?>