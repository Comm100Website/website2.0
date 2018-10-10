<?php
use Roots\Sage\Assets;
?>
<!-- BEGIN: LAYOUT/FOOTERS/FOOTER-7 -->
<a name="footer"></a>
<footer class="c-layout-footer c-layout-footer-7">
    <div class="container">
        <div class="c-prefooter">
            <div class="c-head">
                <div class="row">
                    <div class="col-md-6 col-sm-12">
                        <div class="c-left">
<p><?php the_field('contact'); ?></p>
                            <h3 class="c-title c-font-bold c-margin-l-0">Follow Us on</h3>
                            <div class="socicon">
                                <a href="//www.facebook.com/comm100" class="socicon-btn socicon-btn-circle socicon-solid c-font-dark-1 c-theme-on-hover fa fa-facebook tooltips" data-original-title="Facebook" data-container="body"></a>
                                <a href="//twitter.com/comm100" class="socicon-btn socicon-btn-circle socicon-solid c-font-dark-1 c-theme-on-hover fa fa-twitter tooltips" data-original-title="Twitter" data-container="body"></a>
                                <a href="//plus.google.com/+Comm100" class="socicon-btn socicon-btn-circle socicon-solid c-font-dark-1 c-theme-on-hover fa fa-google-plus tooltips" data-original-title="Google" data-container="body"></a>
                                <a href="//www.linkedin.com/company/comm100-network-corporation" class="socicon-btn socicon-btn-circle socicon-solid c-font-dark-1 c-theme-on-hover fa fa-linkedin tooltips" data-original-title="LinkedIn" data-container="body"></a>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 col-sm-12">
                        <div class="c-right">
                            <h3 class="c-title c-font-bold">Download Apps</h3>
                            <div class="c-icons">
                                <a href="/livechat/androidchat.aspx" class="c-font-30 c-font-dark-1 c-theme-on-hover socicon-btn fa fa-android tooltips" data-original-title="Android" data-container="body"></a>
                                <a href="/livechat/iphonechat.aspx" class="c-font-30 c-font-dark-1 c-theme-on-hover socicon-btn fa fa-apple tooltips" data-original-title="iOS" data-container="body"></a>
                                <a href="/livechat/desktopchat.aspx" class="c-font-30 c-font-dark-1 c-theme-on-hover socicon-btn fa fa-desktop tooltips" data-original-title="Desktop" data-container="body"></a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="c-line"></div>
            <div class="c-body">
                <div class="row">
                    <div class="col-md-4 col-sm-6 col-xs-12">
                        <ul class="c-links c-theme-ul">
                            <li>
                                <a href="/livechat/">Live Chat</a>
                            </li>
                            <li>
                                <a href="/ticket/">Ticket/Email</a>
                            </li>
                            <li>
                                <a href="/helpdesk/">Help Desk</a>
                            </li>
                        </ul>
                        <ul class="c-links c-theme-ul">
                            <li>
                                <a href="//emailmarketing.comm100.com/">Email Marketing</a>
                            </li>
                            <li>
                                <a href="/knowledgebase/">Knowledge Base</a>
                            </li>

                        </ul>
                    </div>
                    <div class="col-md-5 col-sm-6 col-xs-12">
                        <div class="c-content-title-1 c-title-md">
                            <h3 class="c-title c-font-bold">From the Blog</h3>
                            <div class="c-line-left hide"></div>
                        </div>
                        <div class="c-recentpost">
                            <!-- <a class="twitter-timeline" href="//twitter.com/Comm100" data-theme="dark" data-widget-id="671212892415488003" data-tweet-limit="2" data-chrome="noheader nofooter noscrollbar noborders transparent">Loading tweets by @Comm100...</a> -->
                            <?php query_posts('showposts=2'); ?>
                            <?php while (have_posts()) : the_post(); ?>
                            <div class="c-title">
                                <a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>">
                                    <?php the_title(); ?>
                                </a>
                            </div>
                            <div class="c-author c-margin-b-30">
                                <span><?php the_time('F jS, Y'); ?> | <?php the_category(', '); ?> |  <a href="<?php echo get_author_posts_url( get_the_author_meta( 'ID' ) ); ?>"><?php the_author(); ?></a> </span>
                            </div>
                            <?php endwhile;?>
                        </div>
                    </div>
                    <div class="col-md-3 col-sm-12 col-xs-12">
                        <div class="c-content-title-1 c-title-md">
                            <h3 class="c-title c-font-bold">Contact Us</h3>
                            <div class="c-line-left hide"></div>
                        </div>
                        <ul class="c-ulnormal c-ulnormal-address">
                            <li><i class="icon-pointer"></i> 540 – 333 Seymour Street <br />
                                    Vancouver, British Columbia<br />
                                    V6B 5A6 Canada</li>
                                    <li>
                                <i class="icon-call-end"></i> 1-877-&shy;305-0464 (Toll-Free)
                                <br />1-778-&shy;785-0464
                            </li>
                            <li>
                                <i class="icon-printer"></i> 1-888-­837-2011
                            </li>
                            <li>
                                <i class="icon-envelope"></i>
                                <a href="mailto:support@comm100.com">
                                    <span class="c-theme-color">&#115;&#117;&#112;&#112;&#111;&#114;&#116;&#064;&#099;&#111;&#109;&#109;&#049;&#048;&#048;&#046;&#099;&#111;&#109;</span>
                                </a>
                                <a href="mailto:sales@comm100.com">
                                    <span class="c-theme-color">&#115;&#097;&#108;&#101;&#115;&#064;&#099;&#111;&#109;&#109;&#049;&#048;&#048;&#046;&#099;&#111;&#109;</span>
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="c-line"></div>
            <div class="c-foot">
                <div class="row">
                    <div class="col-md-10">

                        <div>
                            <span><img src="/wp-content/uploads/images/hipaa-logo.png" alt="HIPAA" width="127" height="44" class="c-sm-margin-t-10"></span>
                            <span><img src="/wp-content/uploads/images/logo-iso-27001.png?v=20180202" alt="ISO 27001" width="85" height="85" class="c-sm-margin-t-10"></span>
                            <span class="c-padding-left-10">
                                        <img src="<?= Assets\asset_path('images/content/security/pci.png'); ?>" alt="PCI" width="100" height="43">
                                    </span>
                                    <span id="truste" class="c-padding-left-10">
                                   <a href="//privacy.truste.com/privacy-seal/validation?rid=75257e22-f2a1-46d8-9653-38277e4a9cd2" target="_blank"><img style="border: none" src="//privacy-policy.truste.com/privacy-seal/seal?rid=75257e22-f2a1-46d8-9653-38277e4a9cd2" alt="TRUSTe"/></a>
                                </span>
                            <span class="c-padding-left-10">
                                        <a title="Click for the Business Review of Comm100 Network Corporation, a Computer Software Publishers &amp; Developers in Vancouver BC"
                                        href="//www.bbb.org/mbc/business-reviews/computer-software-publishers-and-developers/comm100-network-corporation-in-vancouver-bc-1264631#sealclick" target="_blank">
                                        <img alt="Click for the BBB Business Review of this Computer Software Publishers &amp; Developers in Vancouver BC"
                                            style="border: 0;" src="<?= Assets\asset_path('images/content/security/bbb.png'); ?>" width="114" height="43"/></a></span>
                            <span class="c-padding-left-10"><a href="https://pinpoint.microsoft.com/en-us/companies/4297614086" target="_blank"><img src="<?= Assets\asset_path('images/content/security/microsoft-partner.png'); ?>" alt="Microsoft Partner" width="215" height="43" class="c-sm-margin-t-10"></a></span>
                            <span class="c-padding-left-10"><img src="/wp-content/uploads/images/logo-sfdc.svg" alt="Salesforce Partner" width="147" height="43" class="c-sm-margin-t-10"></span>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
    <div class="c-postfooter c-bg-dark-2">
        <div class="container">
            <div class="row">
                <div class="col-sm-12">
                    <p class="c-copyright c-font-grey">Copyright &copy; <?= date('Y'); ?> Comm100 Network Corporation.
                        <span class="c-font-regular">All Rights Reserved.
                            <a class="c-font-regular" href="/sitemap_index.xml"
                                title="Live Chat Site Map">Site Map</a> | <a  class="c-font-regular" href="/privacy/"
                                title="Live Chat Privacy Policy">Privacy Policy</a> | <a class="c-font-regular" href="/privacy/anti-spam-policy.aspx">Anti-Spam Policy</a> | <a class="c-font-regular" href="/eula/">EULA</a></span>
                    </p>
                    <p class=" c-line-height-18 c-font-14 c-margin-t-15"> All Comm100 brand and product names are trademarks or registered trademarks of Comm100 Network Corporation in Canada and other countries.
                        <br /> All other trademarks or registered trademarks including Windows, Mac, Linux, iPhone, Blackberry, Symbian and others are property of their respective owners.</p>
                </div>
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
<!--Begin Comm100 Live Chat Code-->
<div id="comm100-button-5000239"></div>
<script type="text/javascript">
  var Comm100API=Comm100API||{};(function(t){function e(e){var a=document.createElement("script"),c=document.getElementsByTagName("script")[0];a.type="text/javascript",a.async=!0,a.src=e+t.site_id,c.parentNode.insertBefore(a,c)}t.chat_buttons=t.chat_buttons||[],t.chat_buttons.push({code_plan:5000239,div_id:"comm100-button-5000239"}),t.site_id=10000,t.main_code_plan=5000239,e("https://chatserver.comm100.com/livechat.ashx?siteId="),setTimeout(function(){t.loaded||e("https://hostedmax.comm100.com/chatserver/livechat.ashx?siteId=")},5e3)})(Comm100API||{})
</script>
<!--End Comm100 Live Chat Code-->
<div id="namespace-chatbutton"></div>
<!-- END: LAYOUT/BASE/BOTTOM -->
