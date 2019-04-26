<div class="post release">
    <div class="inner">
        <h4><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h4>
        <div class="post-meta"><?= get_the_date('M j, Y'); ?></div>
        <div class="excerpt"><?php the_excerpt(); ?></div>
    </div>
</div>
