<?php

if (get_row_layout() == 'card_v2') {
    $rows = get_sub_field('cards');
    $row_count = count($rows);
    $headline = get_sub_field('headline');
    $subtitle = get_sub_field('subtitle');
    
    
    
    
    
        // check if the nested repeater field has rows of data
    if (have_rows('cards')):
        echo '<div class="c-content-box c-content-box__quote c-size-md promotion card_v2">';
        echo '<div class="container">';
        echo '<div class="row">';
        echo '<div class="col-sm-12 card card--block card-col-' . $row_count . '">';


        echo '<h3>' . $headline . '</h3>';
        echo '<p class="text-center" style="margin-bottom:40px;">' . $subtitle . '</p>';
        // loop through the rows of data
        
        
        echo "<style>
        
        
        .card_v2 .nav-tab .media-body {
            padding-left: 20px;
        }
        .card_v2 .nav-tab .media-body .c-redirectLink {
            padding-bottom: 2px;
            margin-top: 12px;
        }
        .card_v2 .nav-tab li{
            margin: 25px 0px;
        }
        .card_v2 .nav-tab .media-body h4 {
            line-height: 64px;
        }
        .card_v2 .nav-tab  .media-body p {
            display: none;
        }
        .card_v2 .nav-tab .media-heading {
            color:#5E6D79;
            font-size: 18px;
            font-family:'Ubuntu Medium', sans-serif;
        }
        .card_v2 .nav-tab li:hover,.nav-tab .active {
            
            color:#5E6D79;
            display: inherit;
            background-color: #fff;
        }
        .card_v2 .nav-tab .active .c-redirectLink{
            display: none;
        }
        .card_v2 .nav-tab .active .c-redirectLink{
            display: inline-block;
            margin-bottom: 27px;
        }
        .card_v2 .nav-tab  li {
            border-radius:5px;
        }

        .card_v2 .nav-tab .active h4 {
            line-height: 26px;
        }
        .card_v2 .nav-tab .active .media-object {
            margin-top: 40px;
        }
        .card_v2 .nav-tab .active .media-body p {
            display: block;
        }
        .card_v2 .nav-tab #tab1:hover, .card_v2 .nav-tab  #tab1.active {
            border-left:solid 5px #00567C; 
        }
        .card_v2 .nav-tab #tab2:hover, .card_v2 .nav-tab  #tab2.active {
            border-left:solid 5px #0090D0; 
        }
        .card_v2 .nav-tab #tab3:hover, .card_v2 .nav-tab  #tab3.active {
            border-left:solid 5px #3DC0FF; 
        }
        .card_v2 .nav-tab #tab4:hover, .card_v2 .nav-tab  #tab4.active {
            border-left:solid 5px #9BD909; 
        }

        .card_v2 .panel1{
            border-top:solid 5px #00567C; 
        }
        .card_v2 .panel2{
            border-top:solid 5px #0090D0; 
        }
        .card_v2 .panel3{
            border-top:solid 5px #3DC0FF; 
        }
        .card_v2 .panel4{
            border-top:solid 5px #9BD909; 
        }


        .card_v2 .media-left,.card_v2 .media-body{
            display:table-cell;
        }
        .card_v2 .media-left  {
            width: 94px;
            padding-left: 30px;
            }

        .card_v2 .nav>li a {

            display: inline-block; 
            display: none;
        }

        </style>";

    echo '<div class="tab-content vertical-tab-content col-xs-6 hidden-xs">';

    $no = 1;
    while ( have_rows('cards') ) { the_row();
        $image_content = get_sub_field('image_content');
        if( $no == 1) {
            $active = "active";
        } else {
            $active = "";
        }

        echo '<div role="tabpanel" class="tab-pane '.$active.'" id="tab' . $no . '">';
        echo '<img src="' . $image_content['url'] .'" class="img-responsive">';
        echo '</div>';  
        $no = $no + 1;
    }





echo '</div>';

echo '<div class="col-xs-12 text-left visible-xs">';

$no = 1;
while ( have_rows('cards') ) { the_row();
    $icon = get_sub_field('icon');
    $title = get_sub_field('title');
    $subtitle = get_sub_field('subtitle'); 

    echo '<div class="panel panel-default panel'.$no.'">
    <div class="panel-body" style="text-align:center">
    <img class="" data-src="/wp-content/themes/comm100/dist/images/2020.04_new/holder.js/64x64" alt="64x64" src="' . $icon['url'].'"
    data-holder-rendered="true" style="width: 64px; height: 64px;margin-bottom:15px;">
    
    <h4 class="media-heading">'.$title.'</h4>
    <p style="text-align:left">'.$subtitle.'</p>';


    $cta = get_sub_field('cta');
    if ($cta) {
       while ( have_rows('cta') ) : the_row();
        $cta_link = get_sub_field('cta_link');
        echo ' <a class="c-redirectLink" href=" '.$cta_link['url'].'" target="_self" onclick=jumpurl("'.$cta_link['url'].'")>' .$cta_link['title'].'</a>'; 
    endwhile;
    
}





echo '</div></div>';




$no = $no + 1;
}


echo '</div>';




echo '<div class="col-xs-6 text-left hidden-xs">';
echo '<ul class="nav nav-tab vertical-tab" role="tablist" id="vtab">';



$no = 1;
while ( have_rows('cards') ) { the_row();
    $icon = get_sub_field('icon');
    $title = get_sub_field('title');
    $subtitle = get_sub_field('subtitle');  

    if( $no == 1) {
        $active = "active";
    } else {
        $active = "";
    }


    echo '<li href="#tab' . $no .'" id="tab' . $no .'" role="presentation" class=" ' .$active . '" data-toggle="tab">';
    
    echo '<div class="media-left">
    <img class="media-object" data-src="/wp-content/themes/comm100/dist/images/2020.04_new/holder.js/64x64" alt="64x64" src="' . $icon['url'].'" data-holder-rendered="true" style="width: 64px; height: 64px;"></div>
    <div class="media-body">
    <h4 class="media-heading">' . $title .'</h4>
    <script>
    function jumpurl(url) {
     
     window.location.href=url;
 }
 
 
 </script>
 <p>' .$subtitle.'</p>';
 
 $cta = get_sub_field('cta');
 if ($cta) {
   while ( have_rows('cta') ) : the_row();
    $cta_link = get_sub_field('cta_link');
    echo ' <a class="c-redirectLink" href=" '.$cta_link['url'].'" target="_self" onclick=jumpurl("'.$cta_link['url'].'")>' .$cta_link['title'].'</a>'; 
endwhile;

}

echo '</div>';

echo '</li>';  
$no = $no + 1;
}















echo '</ul>';
echo  '</div>';


echo '</div>';
echo '</div>';
echo '</div>';
echo '</div>';

endif;


}