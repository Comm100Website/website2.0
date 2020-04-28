<?php

// check current row layout
if( get_row_layout() == 'testimonial' ):

     $alignment = get_sub_field('alignment');
    $background_image = get_sub_field('background_image');
    $quote = get_sub_field('quote');
    $signature = get_sub_field('signature');
    $signature_image = get_sub_field('signature_image');
    $story_link = get_sub_field('story_link');
    $background_color = get_sub_field('background_color');

    $brand_logo = get_sub_field('brand_logo');
    
    $link_align =get_sub_field('link_align');
    
    $colsType = '';
    if ($alignment == 'left'):
        $colsType = 'col-sm-7';
    elseif ($alignment == 'center'):
        $colsType = 'col-sm-10 col-sm-push-1';
    endif;

    $style_bg = '';
    if ($background_image):
        $style_bg = 'style="background-image: url(' . $background_image['url'] . ')"';
    endif;

    echo '<div class="c-content-box c-content-box__quote c-size-md c-content-box--' . $background_color . ' " ' . $style_bg . '>';
    echo '<div class="container">';
    echo '<div class="row">';
    echo '<div class="' . $colsType . ' c-quote">';

    if ($quote):
        echo '<div class="c-quote__content">' .
                $quote .
            '</div>';
    endif;
   
  
       

    if($link_align == "center"){
        echo "<style>
                .c-quote__link {
                    text-align: center;
                }
             </style>";
    }

    if($link_align == "left"){
            echo "<style>
                    .c-quote__link {
                        text-align: left;
                    }
                 </style>";
    }







    $signatureImage = '';
    if ($signature_image):
        $signatureImage = '<img src="' . $signature_image['url'] . '" alt="' . $signature_image['alt'] . '" width="80" height="80" />';
    endif;
    
        $brandImage = '';
        if ($brand_logo):
            $brandImage = '<img style="margin-top:30px;margin-bottom:20px;" src="' . $brand_logo['url'] . '" alt="' . $brand_logo['alt'] . '"  height="80" />';
        endif;

        if ($signature):
            echo '<div class="c-quote__signature">' .
                $signatureImage .
                    $signature .
                '</div>' .
                 $brandImage;
        endif;
        if ($story_link):
            echo '<div class="c-quote__link">' .
                    '<a class="c-redirectLink" href="' . $story_link['url'] . '" target="' . $story_link['target'] . '">' .
                        $story_link['title'] .
                    '</a>' .
                '</div>';
        endif;



    echo '</div>';
    echo '</div>';
    echo '</div>';
    echo '</div>';

endif;