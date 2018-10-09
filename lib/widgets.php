<?php
namespace Roots\Sage\Widgets;

//Customize Search Style
function widget_web_search() {
?>
    <div class="sidebarbox">
        <?php get_template_part('template-parts/searchform'); ?>
    </div>
<?php
}
wp_register_sidebar_widget(__('Search'), __('Search'), __NAMESPACE__.'\\widget_web_search');

//Customize Search Style in Post
function widget_post_search() {
    ?>
    <div class="sidebarbox">
        <?php get_template_part('template-parts/searchform'); ?>
    </div>
    <?php
}
wp_register_sidebar_widget(__('Post Search'), __('Post Search'), __NAMESPACE__.'\\widget_post_search', '');

function popularposts() {
    get_template_part('template-parts/popularposts');
}
wp_register_sidebar_widget('Popular Posts', 'Popular Posts',__NAMESPACE__.'\\popularposts', '');

function relatedposts() {
    get_template_part('template-parts/relatedposts');
}
wp_register_sidebar_widget('Related Posts', 'Related Posts',__NAMESPACE__.'\\relatedposts', '');

function recentposts() {
    get_template_part('template-parts/recentposts');
}
wp_register_sidebar_widget('Custom Recent Posts', 'Custom Recent Posts',__NAMESPACE__.'\\recentposts', '');
