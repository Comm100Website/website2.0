//Enable gzip compression on static assets and html
<configuration>
  <system.webServer>
    <httpCompression directory="%SystemDrive%\inetpub\temp\IIS Temporary Compressed Files">
      <scheme name="gzip" dll="%Windir%\system32\inetsrv\gzip.dll" staticCompressionLevel="9" />
      <dynamicTypes>
        <add mimeType="text/*" enabled="true" />
        <add mimeType="message/*" enabled="true" />
        <add mimeType="application/x-javascript" enabled="true" />
        <add mimeType="application/json" enabled="true" />
        <add mimeType="*/*" enabled="false" />
      </dynamicTypes>
      <staticTypes>
        <add mimeType="text/*" enabled="true" />
        <add mimeType="message/*" enabled="true" />
        <add mimeType="application/x-javascript" enabled="true" />
        <add mimeType="application/atom+xml" enabled="true" />
        <add mimeType="application/xaml+xml" enabled="true" />
        <add mimeType="*/*" enabled="false" />
      </staticTypes>
    </httpCompression>
    <urlCompression doStaticCompression="true" doDynamicCompression="true" />
...
  </system.webServer>
...
</configuration>

//Enable static resource browser caching
<system.webServer>
...
<staticContent>
<clientCache cacheControlMaxAge="14.00:00:00" cacheControlMode="UseMaxAge"/>
</staticContent>
...
</system.webServer>

Remove "Custom Post Templates" plugin. We can use default Wordpress functionality for this.

update wp_postmeta set meta_key = '_wp_page_template' where meta_key = 'custom_post_template';
update wp_postmeta set meta_value = concat('page-templates/',meta_value) where meta_key = '_wp_page_template';
delete from wp_postmeta where meta_key = '_wp_page_template' and meta_value = 'page-templates/single-blog.php';

select distinct meta_value from wp_postmeta where meta_value in ('page-templates/acf-company.php',
'page-templates/acf-home.php',
'page-templates/acf-livechathome.php',
'page-templates/customerstory.php',
'page-templates/landing-chatbot-demo.php',
'page-templates/landing-no-menu-simple-footer.php',
'page-templates/landing-no-menu.php',
'page-templates/page-company.php',
'page-templates/page-forum.php',
'page-templates/page-helpdesk.php',
'page-templates/page-home.php',
'page-templates/page-knowledgebase.php',
'page-templates/page-livechat-home.php',
'page-templates/page-livechat-nomenu.php',
'page-templates/page-livechat-nomenunofooter.php',
'page-templates/page-livechat.php',
'page-templates/page-noheaderandfooter.php',
'page-templates/page-ticket.php',
'page-templates/page-websitemonitor.php',
'page-templates/platformAI.php',
'page-templates/platformAIClickThrough.php',
'page-templates/platformLiveChat.php',
'page-templates/platformLiveChatClickThrough.php',
'page-templates/platformMultichannel.php',
'page-templates/platformMultichannelClickThrough.php',
'page-templates/platformOthers.php',
'page-templates/resource page template.php',
'page-templates/resources.php',
'page-templates/single-blog.php',
'page-templates/singlenosidebar.php',
'page-templates/solutionIndustriesClickThrough.php',
'page-templates/solutionIndustriesLanding.php',
'page-templates/solutionUseCaseClickThrough.php',
'page-templates/solutionUseCaseLanding.php') group by meta_value
