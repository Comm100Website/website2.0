<?php
namespace Roots\Sage\Setup;

use Roots\Sage\Assets;

/**
 * Theme setup
 */
function setup() {
    remove_action( 'wp_head', 'wp_generator' );
    // REMOVE WP EMOJI
    // remove_action( 'wp_head', 'print_emoji_detection_script', 7);
    // remove_action( 'wp_print_styles', 'print_emoji_styles');
    // remove_action( 'admin_print_scripts', 'print_emoji_detection_script' );
    // remove_action( 'admin_print_styles', 'print_emoji_styles' );

    remove_action( 'wp_head', 'rest_output_link_wp_head', 10 );//remove <link rel='https://api.w.org/' href='https://www.comm100.com/wp-json/' />
    remove_action( 'wp_head', 'wp_oembed_add_discovery_links', 10 );

    // Remove p tags from category description
    remove_filter('term_description','wpautop');
    // Remove p and br tags from page content
    remove_filter('the_content', 'wpautop');

    // Make theme available for translation
    // Community translations can be found at https://github.com/roots/sage-translations
    load_theme_textdomain('sage', get_template_directory() . '/lang');

    // Enable plugins to manage the document title
    // http://codex.wordpress.org/Function_Reference/add_theme_support#Title_Tag
    add_theme_support('title-tag');

    // Register wp_nav_menu() menus
    // http://codex.wordpress.org/Function_Reference/register_nav_menus

    register_nav_menus(array(
        'primary' => 'utility',
        'livechat' => 'top-menu',
        'platformLiveChat' => 'live-chat-menu',
        'platformMultichannel' => 'multichannel-menu',
        'platformAI' => 'ai-menu',
        'solutionUseCase' => 'use-case-menu',
        'solutionIndustry' => 'industry-menu',
        'company' => 'about-us-menu',
        'footerPlatform' => 'footer-platform',
        'footerSolutions' => 'footer-solutions',
        'footerResources' => 'footer-resources',
        'footerCompany' => 'footer-company',
        // 'ticket' => 'Ticket Navigation',
        // 'knowledgebase' => 'Knowledgebase Navigation',
        // 'helpdesk' => 'Helpdesk Navigation',
        // 'forum' => 'Forum Navigation',
        'livechatresource' => 'Live Chat Resource Navigation',
        'livechatblog' => 'Live Chat Blog Navigation',
        'livechatnomenu' => 'Live Chat No Menu Navigation',
        )
    );

    // Enable post thumbnails
    add_theme_support( 'post-thumbnails' );
    set_post_thumbnail_size(387, 200); // 680 pixels wide by 200 pixels tall, resize mode

    // Enable HTML5 markup support
    // http://codex.wordpress.org/Function_Reference/add_theme_support#HTML5
    add_theme_support('html5', ['caption', 'comment-form', 'comment-list', 'gallery', 'search-form']);

    // Use main stylesheet for visual editor
    // To add custom styles edit /assets/styles/layouts/_tinymce.scss
    add_editor_style(Assets\asset_path('styles/main.css'));
}
add_action('after_setup_theme', __NAMESPACE__ . '\\setup');

function remove_recent_comments_style() {
    global $wp_widget_factory;
    remove_action( 'wp_head', array( $wp_widget_factory->widgets['WP_Widget_Recent_Comments'], 'recent_comments_style'  ) );
}
add_action( 'widgets_init', __NAMESPACE__.'\\remove_recent_comments_style' );

function remove_admin_login_header() {
    remove_action('wp_head', '_admin_bar_bump_cb');
}
add_action('get_header', __NAMESPACE__.'\\remove_admin_login_header');

/**
 * Register sidebars
 */
function widgets_init() {
    // Define Sidebars
    register_sidebar(array(
        'id' => 'home-sidebar',
        'name' => 'Sidebar',
        'before_widget' => '<div class="c-content-title-1 c-theme c-title-md c-margin-t-40">',
        'after_widget' => '</div>',
        'before_title' => '<h3 class="c-font-bold">',
        'after_title' => '</h3><div class="c-line-left c-theme-bg"></div>',
    ));

    register_sidebar(array(
        'id' => 'single-sidebar',
        'name' => 'Post Sidebar',
        'before_widget' => '<div class="c-content-title-1 c-theme c-title-md c-margin-t-40">',
        'after_widget' => '</div>',
        'before_title' => '<h3 class="c-font-bold">',
        'after_title' => '</h3><div class="c-line-left c-theme-bg"></div>',
    ));
}
add_action('widgets_init', __NAMESPACE__ . '\\widgets_init');

/**
 * Theme assets
 */
function assets() {
  wp_enqueue_style('sage/css', Assets\asset_path('styles/main.css'), array(), false);

  if (is_single() && comments_open() && get_option('thread_comments')) {
    wp_enqueue_script('comment-reply');
  }

//   if (!is_admin()) {
//     // comment out the next two lines to load the local copy of jQuery
//     wp_deregister_script('jquery');
//     wp_deregister_script('jquery-migrate');

//     wp_register_script('jquery', Assets\asset_path('scripts/plugins/jquery.js'), false, '1.11.3', false);
//     wp_register_script('jquery-migrate', Assets\asset_path('scripts/plugins/jquery-migrate.min.js'), ['jquery'], '1.2.1', false);

//     wp_enqueue_script('jquery');
//     wp_enqueue_script('jquery-migrate');
//   }

  wp_enqueue_script('comm100api', 'https://www.comm100.com/integrationsapi/apihandler.ashx', '', null, true);
  wp_enqueue_script('sage/bootstrap', Assets\asset_path('scripts/plugins/bootstrap.js'), ['jquery'], null, true);
  wp_enqueue_script('sage/jqueryeasing', Assets\asset_path('scripts/plugins/jquery.easing.min.js'), ['jquery'], null, true);
  wp_enqueue_script('sage/plugins', Assets\asset_path('scripts/plugins/plugins.min.js'), ['jquery'], null, true);


  wp_enqueue_script('sage/js', Assets\asset_path('scripts/main.js'), ['jquery'], null, true);
  wp_localize_script('sage/js', 'commGlobal', array('ajax_url' => admin_url('admin-ajax.php'), 'site_url' => get_site_url()));

//   wp_enqueue_script('sage/optimizely', 'https://cdn.optimizely.com/js/9295172620.js', null, null, false);
}
add_action('wp_enqueue_scripts', __NAMESPACE__ . '\\assets', 100);

function dequeue_css_from_plugins() {
    wp_dequeue_style( 'kbe_theme_style' );
    wp_deregister_style( 'kbe_theme_style' );

    wp_dequeue_style( 'authorsure' );
    wp_deregister_style( 'authorsure' );
}
add_action( 'wp_print_scripts', __NAMESPACE__.'\\dequeue_css_from_plugins' );