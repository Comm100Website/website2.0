<div class="post news">
    <div class="inner">
        <div class="post-meta"><?= get_the_date('M j, Y'); ?> | <?= get_field('source'); ?></div>
        <h4><a href="<?= get_field('article_url'); ?>" target="_blank"><?php the_title(); ?></a></h4>
    </div>
</div>
