<?php
// check current row layout
if( get_row_layout() == 'image-text_v2' ):
    $background_color = get_sub_field('background_color');
    $image_text_title = get_sub_field('image_text_title');
    $image_text_title_color = get_sub_field('image_text_title_color');
    $image_text_description = get_sub_field('image_text_description');
    
    
    // check if the nested repeater field has rows of data
    if( have_rows('image_text_column_repeater') ):

        echo '<div class="c-content-box c-content-box--' . $background_color . ' c-size-md">';
        echo '<div class="container">';
        echo '<div class="row">';

        if ($image_text_title):
            echo '<div class="col-sm-10 col-sm-push-1 c-center">';
                echo '<div class="img-text-title img-text-title--' . $image_text_title_color . '">' . $image_text_title . '</div>';
                if ($image_text_description):
                    echo '<div class="img-text-desc">' . $image_text_description . '</div>';
                endif;
            echo '</div>';
        endif;


        echo '<div class="clear"></div>';
            // loop through the rows of data
        while ( have_rows('image_text_column_repeater') ) : the_row();

            $anchor_id = get_sub_field('anchor_id');
            $title_image = get_sub_field('title_image');
            $headline = get_sub_field('title');
            $title_color = get_sub_field('title_color');
            $body = get_sub_field('description');
            $image = get_sub_field('image');
            $image_align = get_sub_field('image_position');
            $image_position = get_sub_field('image_position');
            $cta = get_sub_field('cta');

            $anchor_id_content = '';
            if ($anchor_id):
                $anchor_id_content = 'id="' . $anchor_id . '"';
            endif;

            $title_color_class = '';
            if ($title_color !== 'none'):
                $title_color_class = 'highlight highlight--' . $title_color;
            endif;


            $pull6 = '';
            $push6 = '';
            if ($image_position == 'right') :
                $pull6 = 'col-sm-pull-6';
                $push6 = 'col-sm-push-6';
            endif;

            $pull6 = 'col-sm-pull-6';
                $push6 = 'col-sm-push-6';
            
            if($image_align) {
                $pull6 = $pull6 . " text-" . $image_align;
            }
            
            
            
            $linkcontent = '';

            if ($cta):
                while ( have_rows('cta') ) : the_row();
                    $cta_link_type = get_sub_field('cta_link_type');
                    $cta_link = get_sub_field('cta_link');
                    if ($cta_link):
                        switch ($cta_link_type) {
                            case 'green' :
                                    $linkcontent = '<a class="btn btn-xlg btn-link--green" href="' . $cta_link['url'] . '" target="' . $cta_link['target'] . '">' .
                                            $cta_link['title'] .
                                        '</a>';
                                    break;
                            case 'blue' :
                                    $linkcontent = '<a class="btn btn-xlg c-theme-btn" href="' . $cta_link['url'] . '" target="' . $cta_link['target'] . '">' .
                                            $cta_link['title'] .
                                        '</a>';
                                    break;
                            case 'white' :
                                    $linkcontent = '<a class="btn btn-xlg c-btn-border-2x c-theme-btn" href="' . $cta_link['url'] . '" target="' . $cta_link['target'] . '">' .
                                            $cta_link['title'] .
                                        '</a>';
                                    break;
                            case 'link' :
                                    $linkcontent = '<a class="c-redirectLink" href="' . $cta_link['url'] . '" target="' . $cta_link['target'] . '">' .
                                            $cta_link['title'] .
                                        '</a>';
                                    break;
                            default: break;
                        }
                    endif;
                endwhile;

                if ($linkcontent !== ''):
                    $linkcontent = '<div class="img-text-column__link"> ' . $linkcontent . ' </div>';
                endif;
            endif;
            
            if($title_image){
                $title_image_content = '<img src="' . $title_image['url'] . '" alt="' . $title_image['alt'] . '" width="" height="" style="margin-bottom:20px;" />';
            }

            echo    '<div ' . $anchor_id_content . ' class="img-text-column img-text-column--' . $image_position . ' clearfix">' .

                        '<div class="col-sm-6 ' . $push6 . ' img-text-column__text">' .
                            $title_image_content .
                            '<h3 class="' . $title_color_class . '">' . $headline . '</h3>' .
                            $body .
                            $linkcontent .
                        '</div>' .


                        '<div class="col-sm-6 ' . $pull6 . ' img-text-column__img">' .
                            '<img src="' . $image['url'] . '" alt="' . $image['alt'] . '" width="" height="" />' .
                        '</div>' .
                        
                    '</div>';
        endwhile;

        echo '</div>';
        echo '</div>';
        echo '</div>';

    endif;
    
    
                endif;