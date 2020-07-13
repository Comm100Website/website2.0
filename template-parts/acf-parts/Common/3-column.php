<?php
// check current row layout
            if( get_row_layout() == '3-column' ):
                $background_color = get_sub_field('background_color');
                if( $background_color == "grey" ){ $background_color_class = "promotion";}

                // check if the nested repeater field has rows of data
                if( have_rows('columns') ):

                    echo '<div class="c-content-box c-size-md '.$background_color_class.' layout-three-column">';
                    echo '<div class="container">';
                    echo '<div class="row">';
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
                        endif;

                        if ($linkcontent !== ''):
                            $linkcontent = '<div class="c-margin-t-30">' . $linkcontent . '</div>';
                        endif;

                        echo    '<div class="three-column__item">' .
                                    '<img src="' . $icon['url'] . '" alt="' . $icon['alt'] . '" width="80" height="80" />' .
                                    '<h5 class="three-column__title">' . $headline . '</h3>' .
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