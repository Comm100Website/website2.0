<?php
// check current row layout
if( get_row_layout() == 'cta_v2' ):
    $calltoaction_type = get_sub_field('type');
    $calltoaction_title = get_sub_field('title');
    $calltoaction_subtitle = get_sub_field('subtitle');
    $calltoaction_description = get_sub_field('description');
    $calltoaction_bg = get_sub_field('background_image');
    $background_color = get_sub_field('background_color');
    $calltoaction_cta = get_sub_field('cta');

    $style_bg = '';
    if ($calltoaction_bg):
        $style_bg = 'style="margin-bottom: -5px;background-repeat: no-repeat; background-position:center center;background-image: url(' . $calltoaction_bg['url'] . ')"';
    endif;
    
    echo '<div class="c-content-box c-size-md c-content-box--' . $background_color . ' " ' . $style_bg . '>';
    //echo '<div class="c-content-box c-size-md c-content-box--bg" ' . $style_bg . '>';
    echo '<div class="container">';
    echo '<div class="row">';
    echo '<div class="col-sm-12 callToAction callToAction--' . $calltoaction_type . '">';

    if ($calltoaction_title):
        echo '<h3>' .
                $calltoaction_title .
            '</h3>';
    endif;
    if ($calltoaction_subtitle):
        echo '<p class="subtitle">' .
                $calltoaction_subtitle .
            '</p>';
    endif;
    if ($calltoaction_cta):

        while ( have_rows('cta') ) : the_row();
            $cta_link_type = get_sub_field('cta_link_type');
            $cta_link = get_sub_field('cta_link');
        
            
            if ($cta_link):
              
                    switch ($cta_link_type) {
                        case 'green' :
                                echo '<a class="btn btn-xlg c-btn-border-2x btn-link--green" href="' . $cta_link['url'] . '" target="' . $cta_link['target'] . '">' .
                                        $cta_link['title'] .
                                    '</a>';
                                break;
                        case 'blue' :
                                echo '<a class="btn btn-xlg c-btn-border-2x c-theme-btn" href="' . $cta_link['url'] . '" target="' . $cta_link['target'] . '">' .
                                        $cta_link['title'] .
                                    '</a>';
                                break;
                        case 'white' :
                                echo '<a class="btn btn-xlg c-btn-border-2x c-btn-border-2x c-theme-btn" href="' . $cta_link['url'] . '" target="' . $cta_link['target'] . '">' .
                                        $cta_link['title'] .
                                    '</a>';
                                break;
                        case 'link' :
                                echo '<a class="c-redirectLink" href="' . $cta_link['url'] . '" target="' . $cta_link['target'] . '">' .
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