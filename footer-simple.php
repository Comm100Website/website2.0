<!-- BEGIN: LAYOUT/FOOTERS/FOOTER-7 -->
<a name="footer"></a>
<footer class="footer">
    <div class="container">
        <div class="row row-footer--bottom">
            <div class="col-sm-10 col-sm-push-1 clearfix">
                <p class="c-copyright c-float-l">Copyright &copy; <script>document.write((new Date()).getFullYear());</script> Comm100 Network Corporation. 
                    All Rights Reserved.
                </p>
                <p class="c-copyright c-float-r">
                    <a href="/sitemap_index.xml" title="Live Chat Site Map">Site Map</a> | 
                    <a href="/privacy/" title="Live Chat Privacy Policy">Privacy Policy</a> | 
                    <a href="/privacy/anti-spam-policy/">Anti-Spam Policy</a> | 
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
<!--[if lt IE 9]>
<script src="..//assets/global/plugins/excanvas.min.js"></script> 
<![endif]-->
 <script>
   var Comm100_Variable_IP = '';
</script>
<script src="<?php bloginfo('template_url');?>/assets/plugins/jquery.min.js" type="text/javascript"></script>
<!-- <script src="<?php bloginfo('template_url');?>/assets/plugins/jquery-migrate.min.js" type="text/javascript"></script> -->
<script src="<?php bloginfo('template_url');?>/assets/plugins/bootstrap/js/bootstrap.min.js" type="text/javascript"></script>
<script src="<?php bloginfo('template_url');?>/assets/plugins/jquery.easing.min.js?v=2.0.1" type="text/javascript"></script>
<script src="<?php bloginfo('template_url');?>/assets/base/js/plugins.min.js?v=1.0.0" type="text/javascript"></script>
<script src="<?php bloginfo('template_url');?>/assets/base/js/script.min.js?v=1.0.34" type="text/javascript"></script>

<!-- END: THEME SCRIPTS -->

<!-- BEGIN: PAGE SCRIPTS -->
<!--<script src="<?php bloginfo('template_url');?>/assets/base/js/scripts/pages/lightbox-gallery.js" type="text/javascript"></script>-->
<!-- END: PAGE SCRIPTS -->
<!--  <script type="text/javascript" src="/secure/js/showchatbutton.js?ver=20150608"></script>

<div id="namespace-chatbutton"></div> -->
<!--Begin Comm100 Live Chat Code-->
<div id="comm100-button-5000239"></div>
<script type="text/javascript">
var Comm100API=Comm100API||{};(function(t){function e(e){var a=document.createElement("script"),c=document.getElementsByTagName("script")[0];a.type="text/javascript",a.async=!0,a.src=e+t.site_id,c.parentNode.insertBefore(a,c)}t.chat_buttons=t.chat_buttons||[],t.chat_buttons.push({code_plan:5000239,div_id:"comm100-button-5000239"}),t.site_id=10000,t.main_code_plan=5000239,e("https://chatserver.comm100.com/livechat.ashx?siteId="),setTimeout(function(){t.loaded||e("https://hostedmax.comm100.com/chatserver/livechat.ashx?siteId=")},5e3)})(Comm100API||{})
</script>
<!--End Comm100 Live Chat Code-->
<!-- END: LAYOUT/BASE/BOTTOM -->
<script>
        $(document).ready(function()
        {
            App.init(); // init core    
        });
    </script>
    <!-- END: THEME SCRIPTS -->
    <?php wp_footer(); ?>

</body>
</html>