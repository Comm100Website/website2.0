<?php
/*
Template Name:home
*/
?>
<?php get_header(); ?>
</header>
   <?php if (have_posts()) : ?>
   <?php while (have_posts()) : the_post(); ?>
	      <?php the_content(__('<br/>Continue reading...')); ?>
   <?php endwhile; ?>
   <?php else : ?>
   
   <div class="post">
      <h2>Not found!</h2>
      <p><?php _e('Sorry, this page does not exist.'); ?></p>
      <?php include (TEMPLATEPATH . "/searchform.php"); ?>	
   </div>
   
   <?php endif; ?>

<?php get_footer('home'); ?>