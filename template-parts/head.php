<?php
use Roots\Sage\Assets;
?>
<head>
    <meta charset="utf-8">
    <?php wp_head(); ?>
    <?php /* YOAST SEO can handle this now.
    if (is_author()) :?>
        <title><?php wp_title(''); $paged = get_query_var('paged'); $allpages = $wp_query->max_num_pages; if ($paged > 1) printf(' – Page %s of %s',$paged,$allpages);?></title>
    <?php else : ?>
        <title><?php wp_title(''); ?></title>
    <?php endif; */ ?>
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />

    <link rel="icon" type="image/x-icon" href="<?= Assets\asset_path('images/favicon.ico'); ?>" />
    <link rel="pingback" href="<?php bloginfo('pingback_url'); ?>" />

    <!-- Google Tag Manager -->
    <script>(function(w,d,s,l,i){w[l]=w[l]||[];w[l].push({'gtm.start':
    new Date().getTime(),event:'gtm.js'});var f=d.getElementsByTagName(s)[0],
    j=d.createElement(s),dl=l!='dataLayer'?'&l='+l:'';j.async=true;j.src=
    'https://www.googletagmanager.com/gtm.js?id='+i+dl;f.parentNode.insertBefore(j,f);
    })(window,document,'script','dataLayer','GTM-MHPR23J');</script>
    <!-- End Google Tag Manager -->
    <script>
        var Comm100_Variable_IP = '';
    </script>
</head>