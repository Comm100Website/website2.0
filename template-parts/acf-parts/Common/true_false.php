<?php
if( get_row_layout() == 'true_false' ){
$subtitle = get_sub_field('subtitle');
$title = get_sub_field('title');
$description = get_sub_field('description');

$false = get_sub_field('false');
$true = get_sub_field('true');

?>


<div class="c-content-box c-size-md support_title"><div class="container header header--center"><div class="row"><div class="col-sm-12">
        <h1><?php echo $subtitle ;?></h1>
        <p class="subtitle"><?php echo $title ;?></p>
        <p><?php echo $description ;?></p>
      
        </div></div></div></div>

<style>
.support_title {
    padding-bottom:0px !important;
}

.support_title h1{
    font-size: 25px;
}

.support_title p{
    font-size: 20px;
}

.support_title .subtitle{
    font-size: 38px;
}
.support .col-sm-5 {
    width:516px;
    padding-top: 48px;
    text-align: center;
    padding-bottom: 40px;
    padding-right: 24px;
    padding-left: 24px;
    background-color: #f4f8fc;
    box-shadow: 0px 0px 10px 5px rgba(0,0,0,0.1);
    cursor:pointer;
}
.support .col-sm-5:first-child {
    margin-left:35px;
    margin-right:68px;
}
.support .col-sm-5 h3{
    font-size: 22px;
    line-height:    34px;
    margin-top:0px;
    margin-bottom:24px;   
}
.support .col-sm-5:first-child:hover {
    background: #3dc4ff !important;
}

 .support .col-sm-5:last-child:hover {
    background: #9fdd09!important;
}

.support .col-sm-5:hover h3{
    color:#fff;
}

.support .col-sm-5 a.c-redirectLink:hover {
    border-bottom: 2px solid #fff;
}
 

 .support .col-sm-5:hover a, .support .col-sm-5:hover a:active{
    color:#fff;
    border-bottom: 2px solid #fff;
}
.support .col-sm-5 p{
    font-size: 22px;
    line-height:    32px;
    margin-top:0px;
    margin-bottom:38px;    
}
.support .col-sm-5 a{
    font-size: 26px !important;
	padding: 0px!important;    
}

@media screen and (max-width: 767px) {
    .support .col-sm-5 {
        width: unset;
        margin: 10px !important;
    }

}
</style>
<div class="c-content-box c-size-md support"><div class="container"><div class="row">
    <div class="col-sm-5" style=" " onclick="window.open('<?php echo $false['link']['url'];?>','_self')">
        <h3><?php echo $false['title']; ?></h3>
        <p><?php echo $false['subtitle']; ?></p>

        <a href="<?php echo $false['link']['url'];?>"><img src="<?php echo $false['image']['url'];?>" class="img-responsive"></a>
        <div class="c-margin-t-40 text-center"> <a class="c-redirectLink" href="<?php echo $false['link']['url'];?>" target=""><?php echo $false['link']['title'];?></a></div>
    </div>
    
    <div class="col-sm-5" style="
    background-color: #f4f8fc;
" onclick="window.open('<?php echo $true['link']['url'];?>','_self')">
        <h3><?php echo $true['title'];?></h3>
        <p><?php echo $true['subtitle'];?></p>

        <a href="<?php echo $true['link']['url'];?>"><img src="<?php echo $true['image']['url'];?>" class="img-responsive"></a>
        <div class="c-margin-t-40 text-center">
        <a class="c-redirectLink" href="<?php echo $true['link']['url'];?>" target=""><?php echo $true['link']['title'];?></a>
        </div>
    </div>
    </div></div></div>

<?php
}