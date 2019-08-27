<!-- BEGIN: LAYOUT/FOOTERS/FOOTER-7 -->
<a name="footer"></a>
<footer class="footer">
    <div class="container">
        <div class="row row-footer--top">
            <div class="col-sm-12">
                <div class="footer__links">
                    <h4 class="footer__heading">
                        Platform
                    </h4>
                    <?php
                        $defaults = array(
                            'theme_location'  => 'footerPlatform',
                            'menu'            => '',
                            'container'       => '',
                            'container_class' => '',
                            'container_id'    => '',
                            'menu_class'      => 'footer__link',
                            'menu_id'         => '',
                            'echo'            => true,
                            'fallback_cb'     => 'wp_page_menu',
                            'before'          => '',
                            'after'           => '',
                            'link_before'     => '',
                            'link_after'      => '',
                            'items_wrap'      => '<ul id="%1$s" class="%2$s">%3$s</ul>',
                            'depth'           => 0,
                            'walker'          => ''
                            );
                            wp_nav_menu( $defaults );
                    ?>
                </div>
                <div class="footer__links">
                    <h4 class="footer__heading">
                        Solutions
                    </h4>
                    <?php
                        $defaults = array(
                            'theme_location'  => 'footerSolutions',
                            'menu'            => '',
                            'container'       => '',
                            'container_class' => '',
                            'container_id'    => '',
                            'menu_class'      => 'footer__link',
                            'menu_id'         => '',
                            'echo'            => true,
                            'fallback_cb'     => 'wp_page_menu',
                            'before'          => '',
                            'after'           => '',
                            'link_before'     => '',
                            'link_after'      => '',
                            'items_wrap'      => '<ul id="%1$s" class="%2$s">%3$s</ul>',
                            'depth'           => 0,
                            'walker'          => ''
                            );
                            wp_nav_menu( $defaults );
                    ?>
                </div>
                <div class="footer__links">
                    <h4 class="footer__heading">
                        Library
                    </h4>
                    <?php
                        $defaults = array(
                            'theme_location'  => 'footerResources',
                            'menu'            => '',
                            'container'       => '',
                            'container_class' => '',
                            'container_id'    => '',
                            'menu_class'      => 'footer__link',
                            'menu_id'         => '',
                            'echo'            => true,
                            'fallback_cb'     => 'wp_page_menu',
                            'before'          => '',
                            'after'           => '',
                            'link_before'     => '',
                            'link_after'      => '',
                            'items_wrap'      => '<ul id="%1$s" class="%2$s">%3$s</ul>',
                            'depth'           => 0,
                            'walker'          => ''
                            );
                            wp_nav_menu( $defaults );
                    ?>
                </div>
                <div class="footer__links">
                    <h4 class="footer__heading">
                        Company
                    </h4>
                    <?php
                        $defaults = array(
                            'theme_location'  => 'footerCompany',
                            'menu'            => '',
                            'container'       => '',
                            'container_class' => '',
                            'container_id'    => '',
                            'menu_class'      => 'footer__link',
                            'menu_id'         => '',
                            'echo'            => true,
                            'fallback_cb'     => 'wp_page_menu',
                            'before'          => '',
                            'after'           => '',
                            'link_before'     => '',
                            'link_after'      => '',
                            'items_wrap'      => '<ul id="%1$s" class="%2$s">%3$s</ul>',
                            'depth'           => 0,
                            'walker'          => ''
                            );
                            wp_nav_menu( $defaults );
                    ?>
                </div>
                <div class="footer__links c-margin-t-30">
                    <ul class="c-ulnormal c-ulnormal-address">
                        <li>
                            <i class="icon-call-end"></i> 1-877-­305-0464
                        </li>
                        <li>
                            <i class="icon-envelope"></i>
                            <a href="mailto:sales@comm100.com">
                                sales@comm100.com
                            </a>
                        </li>
                        <li>
                            <i class="icon-pointer"></i>
                            <a href="/company/about/contact/">Contact us</a>
                        </li>
                    </ul>
                    <form class="c-quick-search" action="/search/">
                        <i class="fa fa-search"></i>
                        <input type="text" name="q" placeholder="" value="" class="form-control form-search" autocomplete="off">
                    </form>
                </div>
            </div>

            <div class="col-sm-3 col-sm-push-9 c-center">
                <div class="socicon">
                    <a href="//www.linkedin.com/company/comm100-network-corporation" class="socicon-btn socicon-btn-circle socicon-solid c-theme-on-hover fa fa-linkedin tooltips" data-original-title="LinkedIn" data-container="body"></a>
                    <a href="//twitter.com/comm100" class="socicon-btn socicon-btn-circle socicon-solid c-theme-on-hover fa fa-twitter tooltips" data-original-title="Twitter" data-container="body"></a>
                    <a href="//www.facebook.com/comm100" class="socicon-btn socicon-btn-circle socicon-solid c-theme-on-hover fa fa-facebook tooltips" data-original-title="Facebook" data-container="body"></a>

                </div>
            </div>

        </div>
        <div class="row row-footer--bottom">
            <div class="col-sm-12 footer__trustby">
                <span><img src="/wp-content/uploads/2018/10/Footer-Certificate-Hipaa.svg" alt="Hipaa" width="94" height="49" class="c-sm-margin-t-10"></span>
                <span><img src="/wp-content/uploads/2018/10/Footer-Certificate-ISO.svg" alt="ISO 27001" width="58" height="58"></span>
                <span>
                    <img src="/wp-content/uploads/2018/10/Footer-Certificate-PCI.svg" alt="PCI" width="107" height="44">
                </span>
                <span><img src="/wp-content/uploads/2018/10/Footer-Certificate-MicrosoftGoldPartner.svg" alt="Microsoft Partner" width="89" height="41" class="c-sm-margin-t-10"></span>
                <span><img src="/wp-content/uploads/2018/10/Footer-Certificate-SalesForce.svg" alt="Salesforce Partner" width="133" height="51" class="c-sm-margin-t-10"></span>
            </div>
            <div class="col-sm-10 col-sm-push-1 c-margin-t-40 clearfix">
                <p class="c-copyright c-float-l">Copyright &copy; <?= date('Y'); ?> Comm100 Network Corporation.
                    All Rights Reserved.
                </p>
                <p class="c-copyright c-float-r">
                    <a href="/sitemap_index.xml" title="Live Chat Site Map">Site Map</a> |
                    <a href="/privacy/" title="Live Chat Privacy Policy">Privacy Policy</a> |
                    <a href="/privacy/cookie-policy/">Cookie Policy</a> |
                    <a href="/eula/">EULA</a>
                </p>
            </div>

            <div class="col-sm-12 c-center footer__note">
                <p class=" c-line-height-18 c-font-14"> All Comm100 brand and product names are trademarks or registered trademarks of Comm100
                        Network Corporation in Canada and other countries.<br>
                        All other trademarks or registered trademarks including Windows, Mac, Linux, iPhone,
                        Blackberry, Symbian and others are property of their respective owners.
                </p>
            </div>
        </div>
    </div>
</footer>
<!-- END: LAYOUT/FOOTERS/FOOTER-7 -->
<!-- BEGIN: LAYOUT/FOOTERS/GO2TOP -->
<div class="c-layout-go2top">
    <i class="icon-arrow-up"></i>
</div>
<!-- END: LAYOUT/FOOTERS/GO2TOP -->
<!-- BEGIN: LAYOUT/BASE/BOTTOM -->
<!-- BEGIN: CORE PLUGINS -->

<?php
if (get_field('override_the_default_site_chatbot')):
    the_field('override_chatbox_code');
else:
?>
<!--Begin Comm100 Live Chat Code-->
<div id="comm100-button-5000239"></div>
<script type="text/javascript">
    var Comm100API=Comm100API||{};
    if (location.search.toLowerCase().indexOf('from=chatwindow') === -1) {
        (function(t){function e(e){var a=document.createElement("script"),c=document.getElementsByTagName("script")[0];a.type="text/javascript",a.async=!0,a.src=e+t.site_id,c.parentNode.insertBefore(a,c)}t.chat_buttons=t.chat_buttons||[],t.chat_buttons.push({code_plan:5000239,div_id:"comm100-button-5000239"}),t.site_id=10000,t.main_code_plan=5000239,e("https://chatserver.comm100.com/livechat.ashx?siteId="),setTimeout(function(){t.loaded||e("https://hostedmax.comm100.com/chatserver/livechat.ashx?siteId=")},5e3)})(Comm100API||{})
    }
</script>
<!--End Comm100 Live Chat Code-->
<?php endif; ?>
<!-- END: LAYOUT/BASE/BOTTOM -->
