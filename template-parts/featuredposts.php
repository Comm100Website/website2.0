<?php
use Roots\Sage\Analytics;
use WP_Query;

$args = [
    'post_type' => 'post',
    'post_status' => 'publish',
    'posts_per_page' => 5,
    'order' => 'desc',
    'orderby' => 'date',
    'meta_query' => [
        [
            'key' => 'featured_post',
            'value' => '1'
        ]
    ]
];

$featuredPosts = new WP_Query($args);

if ($featuredPosts->have_posts()):
?>
<ul>
    <?php
        while ($featuredPosts->have_posts()): $featuredPosts->the_post();
    ?>
        <li class="item">
            <div class="c-image" style="background-image: url('<?php the_post_thumbnail_url(); ?>')"></div>
            <a href="<?php the_permalink();?>" title="<?php the_title_attribute(); ?>"><?php the_title(); ?></a>
        </li>
        <?php
    endwhile;

    wp_reset_postdata();
    ?>
</ul>
<?php endif; ?>