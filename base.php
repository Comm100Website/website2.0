<?php
use Roots\Sage\Setup;
use Roots\Sage\Wrapper;
?>
<!doctype html>
<html <?php language_attributes(); ?>>
  <?php get_template_part('template-parts/head'); ?>
  <body <?php body_class('c-layout-header-fixed c-layout-header-mobile-fixed c-layout-header-fullscreen'); ?>>
    <!--[if IE]><span class="ie7note">You are using an <strong>outdated</strong> browser. Please <a href="//browsehappy.com/">upgrade your browser</a> to improve your experience.</span><![endif]--><!-- Google Tag Manager (noscript) -->
    <noscript><iframe src="https://www.googletagmanager.com/ns.html?id=GTM-MHPR23J" height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>
    <!-- End Google Tag Manager (noscript) -->
    <?php if ($post && $post->post_type == 'kbe_knowledgebase'): ?>
        <div class="notify hidden-xs" style="display: block;">
            <a href="https://www.comm100.com/privacy/">We have updated our Privacy Policy. Check it out here &gt;&gt;</a>
            <span class="close">×</span>
        </div>
    <?php endif; ?>
    <?php
      do_action('get_header');
    ?>
    <?php include Wrapper\template_path(); ?>
    <?php
      do_action('get_footer');
      wp_footer();
    ?>
  </body>
</html>