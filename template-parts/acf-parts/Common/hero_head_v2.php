<?php
use Roots\Sage\Assets;
// check current row layout
if( get_row_layout() == 'hero_head_v2' ){

    $header_align = get_sub_field('align');
    $header_icon = get_sub_field('icon');
    // $page_tag = get_sub_field('page_tag');
    $header_headline = get_sub_field('h1_title');
    $header_slogan = get_sub_field('subtitle');
    $header_description = get_sub_field('description');
    $header_cta = get_sub_field('cta');
    $feature_image = get_sub_field('feature_image');
    $feature_video = get_sub_field('feature_video');

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
    
    
    if($feature_image) {
        echo '<div class="c-content-box c-size-md"><div class="container"><div class="row">

<div class="col-sm-12 text-center">



<img src="' . $feature_image['url'] .'" class="img-fluid">
</div></div></div></div>';
    }

    if($feature_video) {
        ?>
<div class="c-content-box c-size-md hidden-xs" style="padding-top: 0px;"><div class="container"><div class="row"><div class="col-sm-12 text-center">
<video   autoplay style="width:820px;    object-fit:fill;" autoplay muted="muted" loop src="<?php echo $feature_video;?>">　　</video>
</div></div></div></div>
        <?php



    }
}