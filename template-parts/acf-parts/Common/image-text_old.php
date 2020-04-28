<?php

// check current row layout
            if( get_row_layout() == 'image-text' ):
				$background_color = get_sub_field('background_color');
                // check if the nested repeater field has rows of data
                if( have_rows('image_text_column_repeater') ):

                    echo '<div class="c-content-box c-content-box--' . $background_color . ' c-size-md">';
                    echo '<div class="container">';
                    echo '<div class="row">';
                        // loop through the rows of data
                    while ( have_rows('image_text_column_repeater') ) : the_row();

                        $headline = get_sub_field('title');
                        $body = get_sub_field('description');
                        $image = get_sub_field('image');
                        $title_color = get_sub_field('title_color');
                        $image_position = get_sub_field('image_position');
                        $cta = get_sub_field('cta');
                        $pull6 = '';
                        $push6 = '';
                        
                        
                        $title_color_class = '';
                            if ($title_color !== 'none'):
                                $title_color_class = 'highlight highlight--' . $title_color;
                            endif;
                            
                            
                        if ($image_position == 'right') :
                            $pull6 = 'col-sm-pull-6';
                            $push6 = 'col-sm-push-6';
                        endif;
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

                        echo    '<div class="img-text-column img-text-column--' . $image_position . ' clearfix">' .
                                    '<div class="col-sm-6 ' . $push6 . ' img-text-column__img">' .
                                        '<img src="' . $image['url'] . '" alt="' . $image['alt'] . '" width="" height="" />' .
                                    '</div>' .
                                    '<div class="col-sm-6 ' . $pull6 . ' img-text-column__text">' .
                                        '<h3 class="' . $title_color_class . '">' . $headline . '</h3>' .
                                        $body .
                                        $linkcontent .
                                    '</div>' .
                                '</div>';
                    endwhile;

                    echo '</div>';
                    echo '</div>';
                    echo '</div>';

                endif;


            endif;