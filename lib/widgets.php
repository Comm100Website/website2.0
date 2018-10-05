<?php

//Customize Search Style
function widget_web_search() {
  ?>
      <div class="sidebarbox">
          <?php get_template_part('template-parts/searchform'); ?>
      </div>

  <?php
  }

  if (function_exists('register_sidebar_widget')) {
      register_sidebar_widget(__('Search'), 'widget_web_search');
  }

  //Customize Search Style in Post
  function widget_post_search() {
  ?>
      <div class="sidebarbox">
          <?php get_template_part('template-parts/searchform'); ?>
      </div>
  <?php
  }
  if ( function_exists('register_sidebar_widget') )
      register_sidebar_widget(__('Post Search'), 'widget_post_search');


  // Add "Popular Posts" and "Related Posts" Widgets
  if ( function_exists( 'register_sidebar_widget' ) ) {
      register_sidebar_widget('Popular Posts','popularposts');
      register_sidebar_widget('Related Posts','relatedposts');
      register_sidebar_widget('Custom Recent Posts','recentposts');
  }

  function popularposts() { get_template_part('template-parts/popularposts'); }
  function relatedposts() { get_template_part('template-parts/relatedposts'); }
  function recentposts() { get_template_part('template-parts/recentposts'); }
