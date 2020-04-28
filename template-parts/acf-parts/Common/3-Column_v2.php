<?php
use Roots\Sage\Assets;
// check current row layout
if( get_row_layout() == '3-column_v2' ):

 // check if the nested repeater field has rows of data
    $title = get_sub_field('title');
    if( have_rows('columns') ):

        echo '<div class="c-content-box c-size-md">';
        echo '<div class="container">';
        echo '<div class="row">';


        if ($title):
            echo '<h3 class="three-column-title">' . $title . '</h3>';
        endif;

        echo '<div class="col-sm-12 three-column">';
            // loop through the rows of data

        while ( have_rows('columns') ) : the_row();

            $headline = get_sub_field('headline');
            $body = get_sub_field('body');
            $icon = get_sub_field('icon');
            $cta = get_sub_field('cta');
            $linkcontent = '';

            if ($cta):
                while ( have_rows('cta') ) : the_row();
                    $cta_link_type = get_sub_field('cta_link_type');
                    $cta_link = get_sub_field('cta_link');
                   
                    
                    if ($cta_link):
                       
                       
                             $linkcontent = '<a class="c-redirectLink" href="' . $cta_link['url'] . '" target="' . $cta_link['target'] . '">' .
                                            $cta_link['title'] .
                                        '</a>';
                            
                        
                    endif;
                endwhile;
            endif;

            if ($linkcontent !== ''):
                $linkcontent = '<div class="c-margin-t-30">' . $linkcontent . '</div>';
            endif;

            echo    '<div class="three-column__item">' .
                        Assets\get_acf_image($icon, '', '', 80) .
                        '<h5  class="three-column__title">' . $headline . '</h3>' .
                        $body .
                        $linkcontent .
                    '</div>';
        endwhile;

        echo '</div>';
        echo '</div>';
        echo '</div>';
        echo '</div>';

    endif;

endif;