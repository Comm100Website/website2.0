<?php

if( get_row_layout() == 'hero_banner_with_video_background' ):

	wp_enqueue_style('vidbacking');
wp_enqueue_script('vidbacking');
    $banner_type = get_sub_field('type');
    $banner_size = get_sub_field('size');
    $banner_align = get_sub_field('align');
    $banner_icon = get_sub_field('icon');

    $banner_headline = get_sub_field('h1_title');
    $banner_slogan = get_sub_field('subtitle');
    $banner_description = get_sub_field('description');
    $banner_background_image = get_sub_field('background_image');
    $video_background = get_sub_field('video_background');
    $banner_feature_image = get_sub_field('feature_image');
    $background_color = get_sub_field('background_colour');

    $banner_cta = get_sub_field('cta');

    $banner_content_class = ($banner_type == 'responsive_feature' ? 'col-md-5' : 'col-sm-7');
    $row_class = ($banner_type == 'responsive_feature' ? 'd-flex flex-wrap' : '');
    
   echo "
   
   <style>
   
   @media screen and (max-width: 767px) {
    .video-back{
    	background-color:".$background_color.";
    }
}
</style>
   
   ";

    echo '<div style="" class="video-back c-content-box  c-size-lg c-margin-b-20 banner banner--'.$banner_type.' banner--' . $banner_size . ' banner--' . $banner_align . '">';
    
    echo '<video poster="" autoplay muted loop class="vidbacking">
    <source src="'.$video_background.'" type="video/mp4">
</video>';
    echo "<script >
    jQuery.noConflict();
    jQuery(document).ready(function($){
        jQuery('.video-back').vidbacking();
    });
</script>";
   
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
        echo '<div class="col image-col col-md-7" style="padding: unset;margin-bottom: unset;font-size:0px;">';
       // $featureImage = get_sub_field('feature_image');
        echo '<img src="'.$banner_feature_image['url'].'" alt="'.$banner_feature_image['alt'].'"  class="visible-xs"/>';
        
        echo '<video   autoplay style="height: 100%;width:100%;    object-fit:fill;" autoplay muted="muted" loop src="'.$banner_feature_video.'" class="hidden-xs">　　</video>';
       
   
    
        echo '</div>';
    endif;

    echo '</div>';
    echo '</div>';
    echo '</div>';
endif;