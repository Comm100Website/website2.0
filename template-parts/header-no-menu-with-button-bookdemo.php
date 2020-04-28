<header class="c-layout-header c-layout-header-2 c-header-transparent-dark c-layout-header-dark-mobile"
data-minimize-offset="130">
<div class="c-navbar c-mainbar">
    <div class="container">
      <!-- BEGIN: BRAND -->
      <div class="c-navbar-wrapper clearfix">
        <div class="c-brand c-pull-left">
            <a href="<?= get_site_url(); ?>" class="c-logo">
                <span class="c-logo-img"><img src="<?= get_site_url(); ?>/wp-content/uploads/images/logo-comm100.svg" alt="Comm100" class="c-desktop-logo"/></span>
            </a>
        </div>
        <?php
        $buttonURL = '#bookdemo';
        $buttonTarget = '';
        $buttonLabel = 'Book demo';
        $customButton = get_field('header_button');

        if ($customButton) {
            $buttonURL = $customButton['url'];
            $buttonLabel = $customButton['title'];

            if (isset($customButton['target']) && !empty($customButton['target'])) {
                $buttonTarget = 'target="'.$customButton['target'].'"';
            }
        }
        if (!get_field('is_image_menu_button')) {
            ?>
            <a
            class="c-navbar-wrapper__btn btn btn-xlg btn-link--green"
            href="<?= $buttonURL; ?>"
            <?= $buttonTarget; ?>
            ><?= $buttonLabel; ?>
        </a>
        <?php } else { 

        $image = get_field('image')

        ?>
        <style>
            .c-brand {
                padding-top: 13px;
                padding-bottom: 13px;
            }
            .img-btn{
              padding-top: 20px;
            }

            @media (max-width: 991px){

                .c-layout-header .c-mainbar .c-brand {
                    display: unset;
                    float: left !important;
                    margin-top:13px;
                }
            }
    </style>

    <div class="img-btn" style="float:right;">
        <a href="<?= $buttonURL; ?>" class="c-btn">
            <span class="c-btn-img"><img src="<?= $image['url']; ?>" ></span>
        </a>
    </div>


    <?php
}?>
        </div>
    </div>
</div>
</header>