<?php
/*
Template Name:Blank
*/
?>
<?php get_template_part('template-parts/header'); ?>
</header>
<div class="c-layout-page c-layout-page-fixed">
<?php if (have_posts()) : ?>
                    <?php while (have_posts()) : the_post(); ?>
                    <?php the_content(); ?>
                    <?php endwhile; ?>
<?php endif; ?>
</div>

<?php get_template_part('template-parts/footer'); ?>