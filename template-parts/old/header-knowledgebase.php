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

    <!--<link href="<?php bloginfo('template_url');?>/assets/base/css/style.min.css" id="style_components" rel="stylesheet"
        type="text/css" />-->

    <link rel="stylesheet" href="<?php bloginfo('stylesheet_url'); ?>?ver=2.0.15" type="text/css" media="screen, projection" />

    <!-- END THEME STYLES -->
    <link rel="shortcut icon" href="<?php bloginfo('template_url');?>/assets/favicon.ico" />


    <link rel="pingback" href="<?php bloginfo('pingback_url'); ?>" />

    <?php wp_head(); ?>
<!-- Google Tag Manager -->
<script>(function(w,d,s,l,i){w[l]=w[l]||[];w[l].push({'gtm.start':
new Date().getTime(),event:'gtm.js'});var f=d.getElementsByTagName(s)[0],
j=d.createElement(s),dl=l!='dataLayer'?'&l='+l:'';j.async=true;j.src=
'https://www.googletagmanager.com/gtm.js?id='+i+dl;f.parentNode.insertBefore(j,f);
})(window,document,'script','dataLayer','GTM-MHPR23J');</script>
<!-- End Google Tag Manager -->
</head>
<!-- END HEAD -->

<body class="c-layout-header-fixed c-layout-header-mobile-fixed c-layout-header-fullscreen">
<!--[if lte IE 8]>
            <span class="ie7note">You are using an <strong>outdated</strong> browser. Please <a href="//browsehappy.com/">upgrade your browser</a> to improve your experience.</span>
    <![endif]-->
<!-- Google Tag Manager (noscript) -->
<noscript><iframe src="https://www.googletagmanager.com/ns.html?id=GTM-MHPR23J"
height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>
<!-- End Google Tag Manager (noscript) -->
<!-- <div class="notify hidden-xs">
  <a href="https://www.comm100.com/privacy/">

   We have updated our Privacy Policy. Check it out here &gt;&gt;
  </a>
  <span class="close">&times;</span>
</div>  -->
<header class="c-layout-header c-layout-header-2 c-header-transparent-dark c-layout-header-dark-mobile"
        data-minimize-offset="100">
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
                    <a href="https://www.comm100.com/" class="c-logo">
                    <span class="c-logo-img"><img src="https://www.comm100.com/wp-content/uploads/images/logo-comm100.svg" alt="Comm100" class="c-desktop-logo"/></span>
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
                      'menu_class'      => 'nav navbar-nav c-theme-nav c-dark-nav',
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
