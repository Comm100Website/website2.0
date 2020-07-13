<?php
use Roots\Sage\Assets;
    if (get_row_layout() == 'card_v2') {

        $background_color = get_sub_field('background_color');
        if( $background_color == "grey" ){ $background_color_class = "promotion";}

        $rows = get_sub_field('cards');
        $row_count = count($rows);

        $headline = get_sub_field('headline');
        $subtitle = get_sub_field('subtitle');
        $hover_bg_color_array = array();
        while ( have_rows('cards') ) {the_row();
        
            $hover_bg_color_array[] = get_sub_field('color');;
        } 
        
       
        ?>
        <style>

.card-col-4 .card-item {
    width: calc(50% - 15px);
    margin-bottom: 15px;
}

@media screen and (max-width: 767px) {
    .card-col-4 .card-item {
    width: calc(100%);
}
}
.card-col-4 .card-item:nth-child(3):hover{
    background-color:<?php echo $hover_bg_color_array[0];?> !important;
} 
   
.card-col-4 .card-item:nth-child(4):hover{
    background-color:<?php echo $hover_bg_color_array[1];?> !important;
} 

.card-col-4 .card-item:nth-child(5):hover{
    background-color:<?php echo $hover_bg_color_array[2];?> !important;
} 

.card-col-4 .card-item:nth-child(6):hover{
    background-color:<?php echo $hover_bg_color_array[3];?> !important;
} 


.card-col-4 .card-item__link{
    position:initial;
}

.card-item h3{
    padding-bottom:0px;
}

.card-item__link {
    margin-top:30px;
}
.card-item--platform {
    padding:40px;
}
.card-item__subtitle {
    font-family: Ubuntu Light,sans-serif;
}
   </style>

        <?php
  
    
        
        
        
        
        // check if the nested repeater field has rows of data
        if (have_rows('cards')):
        echo '<div class="c-content-box c-content-box__quote c-size-md '.$background_color_class.' card_v2">';
        echo '<div class="container">';
        echo '<div class="row">';
        echo '<div class="col-sm-12 card card--block card-col-' . $row_count . '">';


        echo '<h3>' . $headline . '</h3>';
        echo '<p class="text-center" style="margin-bottom:40px;">' . $subtitle . '</p>';
        // loop through the rows of data
        $no = 0;    
        while ( have_rows('cards') ) : the_row();

            $card_themecolor = get_sub_field('color');
            $card_img = get_sub_field('icon');
            $card_title = get_sub_field('title');
            $card_subtitle = get_sub_field('subtitle');
            $card_description = get_sub_field('description');

            $card_subtitle_wrap = '';
            if ($card_subtitle):
                $card_subtitle_wrap = '<div class="card-item__subtitle">' . $card_subtitle . '</div>';
            endif;


            $cta = get_sub_field('cta');
            $linkcontent='';
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
       
            echo    '<div class="card-item card-item--platform " data-link="' . $cta_link['url'] . '" >' .
                        '<div class="card__icon-wrap">'.Assets\get_acf_image($card_img, 'card__icon--small', 70, 70).'</div>' .
                        '<h3>' . $card_title . '</h3>' .
                        $card_subtitle_wrap .
                        $card_description .
                        '<div class="card-item__link">' . $linkcontent . '</div>' .
                    '</div>';
                    // $no = $no +1;
        endwhile;
        

                        echo '</div>';
                        echo '</div>';
                        echo '</div>';
                        echo '</div>';

                    endif;

                
    }