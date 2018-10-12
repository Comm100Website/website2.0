<!DOCTYPE html>

<?php
    if (!isset($_COOKIE['landingUrl1'])) {
        setcookie("landingUrl1",'http://'.$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'],time()+3600*24*365,"/",".comm100.com");
    }
?>
<?php
    if (!isset($_COOKIE['R_url'])) {
        setcookie("R_url",$_SERVER['HTTP_REFERER'],time()+3600*24*365,'/','.comm100.com');
    }
    $parts = parse_url(strtolower('http://'.$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI']));
    parse_str($parts['query'], $query);
    if (isset($query['c_cid'])) {
        if (!isset($_COOKIE['C_cId'])) {
            setcookie("C_cId",$query['c_cid'],time()+3600*24*365,'/');
        }
        else
        {
        if (strpos($_COOKIE['C_cId'],$query['c_cid'])===false) {
                setcookie("C_cId",$_COOKIE['C_cId'] . ',' . $query['c_cid'],time()+3600*24*365,'/');
        }
        }
    }
    if (isset($query['utm_source']) && !isset($_COOKIE['utm_source'])) {
      setcookie("utm_source", $query['utm_source'], time()+3600*24*365, '/', '.comm100.com');
    }
    if (isset($query['utm_campaign']) && !isset($_COOKIE['utm_campaign'])) {
      setcookie("utm_campaign", $query['utm_campaign'], time()+3600*24*365, '/', '.comm100.com');
    }

    if (isset($query['utm_medium']) && !isset($_COOKIE['utm_medium'])) {
        setcookie("utm_medium", $query['utm_medium'], time()+3600*24*365, "/", ".comm100.com");
    }
    if (isset($query['utm_term']) && !isset($_COOKIE['utm_term'])) {
        setcookie("utm_term", $query['utm_term'], time()+3600*24*365, "/", ".comm100.com");
    }
?>
<!--[if IE 9]> <html lang="en" class="ie9"> <![endif]-->
<!--[if !IE]><!-->
<html lang="en">
<!--<![endif]-->

<!-- BEGIN HEAD -->
<head>
    <meta charset="utf-8">
    <?php if (is_author()) :?>
        <title><?php wp_title(''); $paged = get_query_var('paged'); $allpages = $wp_query->max_num_pages; if ($paged > 1) printf(' – Page %s of %s',$paged,$allpages);?></title>
    <?php else : ?>
        <title><?php wp_title(''); ?></title>
    <?php endif; ?>
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />

    <meta name="viewport" content="width=device-width, initial-scale=1.0" />


    <!--<link href="<?php bloginfo('template_url');?>/assets/base/css/style.min.css?ver=1.0.3" id="style_components" rel="stylesheet"
        type="text/css" />-->

    <link rel="stylesheet" href="<?php bloginfo('stylesheet_url'); ?>?ver=1.0.57" type="text/css" media="screen, projection" />

    <!-- END THEME STYLES -->
    <link rel="shortcut icon" href="<?php bloginfo('template_url');?>/assets/favicon.ico" />


    <link rel="pingback" href="<?php bloginfo('pingback_url'); ?>" />
    <script src="https://cdn.optimizely.com/js/9295172620.js"></script>

    <?php wp_head(); ?>

</head>
<!-- END HEAD -->

<body class="c-layout-header-fixed c-layout-header-mobile-fixed c-layout-header-fullscreen">
<!--[if lte IE 8]>
            <span class="ie7note">You are using an <strong>outdated</strong> browser. Please <a href="//browsehappy.com/">upgrade your browser</a> to improve your experience.</span>
    <![endif]-->

<!-- <div class="notify hidden-xs">
  <a href="https://www.comm100.com/livechat/resources/live-chat-buyers-guide.aspx">
    <span class="new">New</span>
   [eBook] The Live Chat Buyer’s Guide: What to Look for and How to Ask &gt;&gt;
  </a>
  <span class="close">&times;</span>
</div> -->
<header class="c-layout-header c-layout-header-2 c-header-transparent-dark c-layout-header-dark-mobile"
        data-minimize-offset="130">
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
    <div class="c-navbar c-mainbar">
        <div class="container">
            <!-- BEGIN: BRAND -->
            <div class="c-navbar-wrapper clearfix">
                <div class="c-brand c-pull-left">

                    <a href="/livechat/" class="c-logo">
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
                    'theme_location'  => 'helpdesk',
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
