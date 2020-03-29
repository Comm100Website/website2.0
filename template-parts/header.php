<header class="c-layout-header c-layout-header-2 c-header-transparent-dark c-layout-header-dark-mobile" data-minimize-offset="130">
    <?php 
        if (is_home() || is_front_page()) { 
    ?>
        <style>
            .header_tips {
                font-family: "Ubuntu Regular", sans-serif;
                margin-bottom: 0px;
                color:rgba(148,159,169,1);
                font-size: 16px;
                line-height: 16px;
                padding-top:20px;
                padding-bottom:14px;
                text-align: center;
            }
            @media screen and (max-width: 767px) {
                .header_tips {
                    line-height: 20px;
                }
            }
            @media (max-width: 991px) {
                .c-layout-header-fixed .c-layout-page{
                    margin-top: 202px;
				}
            }
        </style>
        <div class="container-fluid" style="background:rgba(244,248,252,1);">
            <div class="container">
        
                <p class="header_tips">Read a <a class="" href="https://www.comm100.com/response-to-covid-19/">letter from our CEO</a> about how we’re responding to COVID-19, and what we can do to help you help your customers.</p>
            </div>
        </div>
    <?php 
        }
    ?>
    <div class="c-topbar c-navbar">
        <div class="container">
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
    <div class="c-navbar c-mainbar">
        <div class="container">
                <!-- BEGIN: BRAND -->
            <div class="c-navbar-wrapper clearfix">
                <div class="c-brand c-pull-left">
                    <a href="/" class="c-logo">
                        <span class="c-logo-img"><img src="/wp-content/uploads/images/logo-comm100.svg" alt="Comm100" class="c-desktop-logo"/></span>
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
                        'theme_location'  => 'livechat',
                        'menu'            => '',
                        'container'       => 'nav',
                        'container_class' => 'c-top2-menu c-mega-menu c-pull-right c-mega-menu-light c-mega-menu-dark-mobile c-theme',
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
    <?php if ($post && in_array($post->post_type, ['course', 'lesson'])): ?>
    <div class="c-sectionbar visible-md">
        <div class="container">
            <nav class="clearfix">
                <ul class="nav navbar-nav c-theme-nav" style="float: right;">
                    <li class="page_item page-item-4"><a href="/courses/">Course Catalog</a></li>
                    <li class="page_item page-item-5"><a href="/memberships/">Membership Catalog</a></li>
                    <li class="page_item page-item-7"><a href="/dashboard/my-courses/">My Courses</a></li>
                </ul>
            </nav>
        </div>
    </div>
    <?php endif; ?>
