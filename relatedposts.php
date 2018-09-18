<?php 
    $queried_object = get_queried_object();
    $post_id = 0;
    if ( $queried_object ) {
    	$post_id = $queried_object->ID;
    }

    $tags = wp_get_post_tags($post_id);
    if ($tags) {
        $first_tag = $tags[0]->term_id;
        
        $args=array(
            'tag__in' => array($first_tag),
            'post__not_in' => array($post_id),
            'showposts'=>5,
            'caller_get_posts'=>1,
            'orderby'=>'ID'
        );
        
        $my_query = new WP_Query($args);
        
        if( $my_query->have_posts() ) { ?>
            
                <div class="c-content-title-1 c-theme c-title-md c-margin-t-40">
                  <h3 class="c-font-bold">
                     Related Posts</h3>
                  <div class="c-line-left c-theme-bg">
                  </div>
                </div>
                <ul class="c-menu c-arrow-dot1 c-theme">
                     <?php 
                        while ($my_query->have_posts()) : $my_query->the_post(); ?>
                            <li>
                                <div class="c-image" style="background-image: url('<?php the_post_thumbnail_url(); ?>')"></div>
                                <a href="<?php the_permalink() ?>" title="<?php the_title_attribute(); ?>"><?php the_title(); ?></a>
                            </li>
                            <?php endwhile; ?>
                 </ul>
            
        <?php }
    }
?>