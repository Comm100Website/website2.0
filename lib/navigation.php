<?php
namespace Roots\Sage\Navigation;

function add_menuclass($ulclass) {
    return $output = preg_replace('/<a /', '<a class="c-link dropdown-toggle" ', $ulclass);
 }
 add_filter('wp_nav_menu', __NAMESPACE__.'\\add_menuclass');

 function change_submenu_class($menu) {
   $menu = preg_replace('/ class="sub-menu"/',' class="dropdown-menu c-menu-type-classic c-pull-left" ',$menu);
   return $menu;
 }
 add_filter('wp_nav_menu', __NAMESPACE__.'\\change_submenu_class');

 function roots_wp_nav_menu($text) {
   $replace = array(
     'current-menu-item'     => 'c-active',
     'current-menu-parent'   => 'c-active',
     'menu-item-type-post_type' => '',
     'menu-item-object-page' => '',
     'menu-item-type-custom' => '',
     'menu-item-object-custom' => '',
   );

   $text = str_replace(array_keys($replace), $replace, $text);
   return $text;
 }
 add_filter('wp_nav_menu', __NAMESPACE__.'\\roots_wp_nav_menu');