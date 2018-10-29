<?php
use Roots\Sage\Extras;
use Roots\Sage\Assets;
?>
<div class="c-content-blog-post-card-1 c-option-2">
    <div class="c-media c-content-overlay">
        <?php if (has_post_thumbnail()): ?>
            <a href="<?php the_permalink(); ?>"><?= Assets\get_lazy_load_post_thumbnail($post->ID, get_the_title(), 'full'); ?></a>
        <?php endif; ?>
    </div>
    <div class="c-body">
        <div class="c-author">
            <span>
                <?php the_time('F jS, Y'); ?> | <?php the_category(', '); ?>
            </span>
        </div>
        <div class="c-title c-font-bold">
            <a  href="<?php the_permalink(); ?>" rel="bookmark" title="<?php the_title(); ?>"><?php the_title(); ?></a>
        </div>
        <div class="postcontent">
            <?php
                the_excerpt();
            ?>
        </div>
    </div>
</div>