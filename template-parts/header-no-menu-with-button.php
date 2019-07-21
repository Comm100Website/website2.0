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
            $buttonURL = '#freetrial';
            $buttonTarget = '';
            $buttonLabel = 'Free trial';
            $customButton = get_field('header_button');

            if ($customButton) {
                $buttonURL = $customButton['url'];
                $buttonLabel = $customButton['title'];

                if (isset($customButton['target']) && !empty($customButton['target'])) {
                    $buttonTarget = 'target="'.$customButton['target'].'"';
                }
            }

            $customButtonColor = 'green';

            if (get_field('header_button_colour')) {
                $customButtonColor = get_field('header_button_colour');
            }
            ?>
            <a
                class="c-navbar-wrapper__btn btn btn-xlg btn-link--<?= $customButtonColor; ?>"
                href="<?= $buttonURL; ?>"
                <?= $buttonTarget; ?>
            ><?= $buttonLabel; ?>
            </a>
        </div>
    </div>
  </div>
</header>