<!-- BEGIN HEAD -->
<head>
    <meta charset="utf-8">
    <?php /* YOAST SEO can handle this now.
    if (is_author()) :?>
        <title><?php wp_title(''); $paged = get_query_var('paged'); $allpages = $wp_query->max_num_pages; if ($paged > 1) printf(' – Page %s of %s',$paged,$allpages);?></title>
    <?php else : ?>
        <title><?php wp_title(''); ?></title>
    <?php endif; */ ?>
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />

    <!--<link href="<?php bloginfo('template_url');?>/assets/base/css/style.min.css?ver=1.0.3" id="style_components" rel="stylesheet"
        type="text/css" />-->

    <link rel="stylesheet" href="<?php bloginfo('stylesheet_url'); ?>?ver=2.0.15" type="text/css" media="screen, projection" />

    <!-- END THEME STYLES -->
    <link rel="shortcut icon" href="<?= get_template_directory_uri(); ?>/dist/images/favicon.ico" />


    <link rel="pingback" href="<?php bloginfo('pingback_url'); ?>" />
    <script src="https://cdn.optimizely.com/js/9295172620.js"></script>

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
