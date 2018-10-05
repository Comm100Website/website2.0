<?php
/*
Template Name:no header and footer
*/
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="robots" content="noindex, nofollow"/>
    <title></title>
</head>
<body>
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
</body>
</html>