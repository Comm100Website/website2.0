<?php get_template_part('template-parts/header'); ?>
</header>
<div class="c-layout-page c-layout-page-fixed">
    <div class="c-content-box c-size-md">
        <div class="container">
            <div class="row">

   <?php if (have_posts()) : ?>
   <?php while (have_posts()) : the_post(); ?>
	      <?php the_content(__('<br/>Continue reading...')); ?>
   <?php endwhile; ?>
   <?php else : ?>

   <div class="post">
      <h2>Not found!</h2>
      <p><?php _e('Sorry, this page does not exist.'); ?></p>
      <?php get_template_part('template-parts/searchform'); ?>
   </div>

   <?php endif; ?>
</div>
</div>
</div>
</div>
<?php get_template_part('template-parts/footer'); ?>
