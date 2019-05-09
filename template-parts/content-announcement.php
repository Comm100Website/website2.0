<div class="post release">
    <div class="inner">
        <h4><?php the_title(); ?></h4>
        <?php if (get_field('announcement')): ?>
        <div class="excerpt"><?php the_field('announcement'); ?></div>
        <?php endif; ?>
    </div>
</div>
