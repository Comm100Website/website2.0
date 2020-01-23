<?php get_template_part('template-parts/header'); ?>

  </header>
  <?php if (have_posts()) : ?>
  <?php while (have_posts()) : the_post(); ?>
       <?php the_content(__('<br/>Continue reading...')); ?>
       <?php
        if( have_rows('modules') ):
            echo '<div class="c-layout-page c-layout-page-fixed">';

            // loop through the rows of data
            while ( have_rows('modules') ) : the_row();
            if( get_row_layout() == 'hero_head' ):

                $header_align = get_sub_field('align');
                $header_icon = get_sub_field('icon');
                // $page_tag = get_sub_field('page_tag');
                $header_headline = get_sub_field('h1_title');
                $header_slogan = get_sub_field('subtitle');
                $header_description = get_sub_field('description');
                $header_cta = get_sub_field('cta');

                echo '<div class="c-content-box c-size-md">';
                echo '<div class="container header header--' . $header_align . '">';
                echo '<div class="row">';
                echo '<div class="col-sm-12">';

                if ($header_icon):
                    echo '<div class="header_icon">'.Assets\get_acf_image($header_icon, '', 64, 64).'</div>';
                endif;
                if ($header_headline):
                    echo '<h1>' .
                            do_shortcode($header_headline) .
                        '</h1>';
                endif;
                if ($header_slogan):
                    echo '<p class="subtitle">' .
                            do_shortcode($header_slogan) .
                        '</p>';
                endif;
                if ($header_description):
                    echo '<div class="desc">' .
                        do_shortcode($header_description) .
                        '</div>';
                endif;

                if ($header_cta):

                    while ( have_rows('cta') ) : the_row();
                        $cta_link_type = get_sub_field('cta_link_type');
                        $cta_link = get_sub_field('cta_link');
                        if ($cta_link):
                            switch ($cta_link_type) {
                                case 'green' :
                                        echo '<a class="header_cta_link btn btn-xlg btn-link--green" href="' . $cta_link['url'] . '" target="' . $cta_link['target'] . '">' .
                                                $cta_link['title'] .
                                            '</a>';
                                        break;
                                case 'blue' :
                                        echo '<a class="header_cta_link btn btn-xlg c-theme-btn" href="' . $cta_link['url'] . '" target="' . $cta_link['target'] . '">' .
                                                $cta_link['title'] .
                                            '</a>';
                                        break;
                                case 'white' :
                                        echo '<a class="header_cta_link btn btn-xlg c-btn-border-2x c-theme-btn" href="' . $cta_link['url'] . '" target="' . $cta_link['target'] . '">' .
                                                $cta_link['title'] .
                                            '</a>';
                                        break;
                                case 'link' :
                                        echo '<a class="header_cta_link" href="' . $cta_link['url'] . '" target="' . $cta_link['target'] . '">' .
                                                $cta_link['title'] .
                                            '</a>';
                                        break;
                                default: break;
                            }
                        endif;
                    endwhile;


                endif;
                echo '</div>';
                echo '</div>';
                echo '</div>';
                echo '</div>';
                endif;
            endwhile;

            get_template_part('template-parts/content', 'blocks');
            echo '</div>';
        endif;
       ?>
  <?php endwhile; ?>
  <?php else : ?>

  <div class="post">
    <h2>Not found1!</h2>
    <p><?php _e('Sorry, this page does not exist.'); ?></p>
    <?php get_template_part('template-parts/searchform'); ?>
  </div>

  <?php endif; ?>

  <!-- Go to www.addthis.com/dashboard to customize your tools -->
<script type="text/javascript" src="//s7.addthis.com/js/300/addthis_widget.js#pubid=ra-4e2faac9507104da"></script>
<?php get_template_part('template-parts/footer'); ?>