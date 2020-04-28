<?php

if( get_row_layout() == 'hero_banner_video' ):
    $banner_type = get_sub_field('type');
    $banner_size = get_sub_field('size');
    $banner_align = get_sub_field('align');
    $banner_icon = get_sub_field('icon');

    $banner_headline = get_sub_field('h1_title');
    $banner_slogan = get_sub_field('subtitle');
    $banner_description = get_sub_field('description');
    $banner_background_image = get_sub_field('background_image');
    $banner_feature_video = get_sub_field('feature_video');
    $banner_feature_image = get_sub_field('feature_image');

    $banner_cta = get_sub_field('cta');

    $banner_content_class = ($banner_type == 'responsive_feature' ? 'col-md-5' : 'col-sm-7');
    $row_class = ($banner_type == 'responsive_feature' ? 'd-flex flex-wrap' : '');
    
   

    echo '<div style="background-color: #0190D3;    background-image: linear-gradient(to right,#0190D3 60%, #1189D2 70%);" class="c-content-box  c-size-lg c-margin-b-20 banner banner--'.$banner_type.' banner--' . $banner_size . ' banner--' . $banner_align . '">';
    
   
    echo '<div class="container">';
    echo '<div class="row '. $row_class. '">';
    echo '<div class="col content-col '.$banner_content_class.'" >';

    if ($banner_icon):
       // echo '<div class="banner_icon">'.Assets\get_acf_image($banner_icon, '', 64, 64).'</div>';
    endif;
    if ($banner_headline):
        echo '<h1>' .
                $banner_headline .
            '</h1>';
    endif;
    if ($banner_slogan):
        echo '<p class="subtitle">' .
                $banner_slogan .
            '</p>';
    endif;
    if ($banner_description):
        echo '<div class="desc">' .
                $banner_description .
            '</div>';
    endif;

    if ($banner_cta):

        while ( have_rows('cta') ) : the_row();
            $cta_link_type = get_sub_field('cta_link_type');
            $cta_link = get_sub_field('cta_link');
            if ($cta_link):
                switch ($cta_link_type) {
                    case 'green' :
                            echo '<a class="banner_cta_link btn btn-xlg btn-link--green" href="' . $cta_link['url'] . '" target="' . $cta_link['target'] . '">' .
                                    $cta_link['title'] .
                                '</a>';
                            break;
                    case 'blue' :
                            echo '<a class="banner_cta_link btn btn-xlg c-theme-btn" href="' . $cta_link['url'] . '" target="' . $cta_link['target'] . '">' .
                                    $cta_link['title'] .
                                '</a>';
                            break;
                    case 'white' :
                            echo '<a class="banner_cta_link btn btn-xlg c-btn-border-2x c-theme-btn" href="' . $cta_link['url'] . '" target="' . $cta_link['target'] . '">' .
                                    $cta_link['title'] .
                                '</a>';
                            break;
                    case 'link' :
                            echo '<a class="banner_cta_link" href="' . $cta_link['url'] . '" target="' . $cta_link['target'] . '">' .
                                    $cta_link['title'] .
                                '</a>';
                            break;
                    default: break;
                }
            endif;
        endwhile;


    endif;
    echo '</div>';

    if ($banner_type == 'responsive_feature'):
        echo '<div class="col image-col col-md-7 video-back" style="padding: unset;margin-bottom: unset;font-size:0px;">';
       // $featureImage = get_sub_field('feature_image');
        echo '<img src="'.$banner_feature_image['url'].'" alt="'.$banner_feature_image['alt'].'"  class="visible-xs"/>';
        
        echo '<video   autoplay style="height: 100%;width:100%;    object-fit:fill;" autoplay muted="muted" loop src="'.$banner_feature_video.'" class="hidden-xs">　　</video>';
       
   
    
        echo '</div>';
    endif;

    echo '</div>';
    echo '</div>';
    echo '</div>';
endif;