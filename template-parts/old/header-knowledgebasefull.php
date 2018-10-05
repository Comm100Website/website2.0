<!DOCTYPE html>

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
    
    <link rel="stylesheet" href="<?php bloginfo('stylesheet_url'); ?>?ver=1.0.19" type="text/css" media="screen, projection" />
    
    <!-- END THEME STYLES -->
    <link rel="shortcut icon" href="<?php bloginfo('template_url');?>/assets/favicon.ico" />
    
    
    <link rel="pingback" href="<?php bloginfo('pingback_url'); ?>" />
    
    <?php wp_head(); ?>
</head>
<!-- END HEAD -->

<body class="c-layout-header-fixed c-layout-header-mobile-fixed c-layout-header-fullscreen">
<!--[if lte IE 8]>
            <span class="ie7note">You are using an <strong>outdated</strong> browser. Please <a href="//browsehappy.com/">upgrade your browser</a> to improve your experience.</span>
    <![endif]-->   
