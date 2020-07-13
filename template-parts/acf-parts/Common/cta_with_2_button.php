<?php
// check current row layout
if( get_row_layout() == 'cta_with_2_button' ):

    $custom_cta = get_sub_field('custom_cta');
    
    
   

    if($custom_cta){

        $calltoaction_type = get_sub_field('type');
        $calltoaction_title = get_sub_field('title');
        $calltoaction_subtitle = get_sub_field('subtitle');
        $calltoaction_description = get_sub_field('description');
        $calltoaction_bg = get_sub_field('background_image');
        $calltoaction_bg_color = get_sub_field('background_color');
        $calltoaction_cta = get_sub_field('cta');
    
        $more_info = get_sub_field('more_info');

    } else {
        $calltoaction_type  =   get_field('type',options);
        $calltoaction_title =   get_field('title',options);
        $calltoaction_subtitle  =   get_field('subtitle',options);
        $calltoaction_description   =   get_field('description',options);
        $calltoaction_bg    =   get_field('background_image',options);
        $calltoaction_bg_color  =   get_field('background_color',options);
        $calltoaction_cta   =   get_field('cta',options);
        $more_info  = get_field('more_info',options);
    }

    

    $style_bg = '';
    if ($calltoaction_bg):
        $style_bg = 'style="background-image: url(' . $calltoaction_bg['url'] . ')"';
    endif;
    

    echo '<div class="cta_with_two_button '. $calltoaction_bg_color .' c-content-box c-size-md c-content-box--bg" ' . $style_bg . '>';
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



        foreach( $calltoaction_cta as $row ) {
          

                $cta_link_type =$row['cta_link_type'];
                $cta_link = $row['cta_link'];
                $cta_link_color = $row['cta_link_color'];


                if($cta_link_type == "flat") {
                    $cta_link_type_class = "";
                }
                if($cta_link_type == "hollow") {
                    $cta_link_type_class = "c-btn-border-2x";
                }
                if ($cta_link):
                    switch ($cta_link_color) {
                        case 'green' :
                                echo '<a class="btn btn-xlg '.$cta_link_type_class.' btn-link--green" href="' . $cta_link['url'] . '" target="' . $cta_link['target'] . '">' .
                                        $cta_link['title'] .
                                    '</a>';
                                break;
                        case 'blue' :
                                echo '<a class="btn btn-xlg '.$cta_link_type_class.' c-theme-btn" href="' . $cta_link['url'] . '" target="' . $cta_link['target'] . '">' .
                                        $cta_link['title'] .
                                    '</a>';
                                break;
                        default: break;
                    }
                endif;
           
        }

      
    
       


    endif;

    
    if($more_info){
        echo '<div class="more-info">'.$more_info.'</div>';
    }

    echo '</div>';
    echo '</div>';
    echo '</div>';
    echo '</div>';
endif;