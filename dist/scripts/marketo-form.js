function AddFieldsAndVaulesStringToCookie(o){var e={Email:o.vals().Email,FirstName:o.vals().FirstName,LastName:o.vals().LastName,Company:o.vals().Company,Phone:o.vals().Phone,Job_Role__c:o.vals().Job_Role__c,No_of_Live_Chat_Agents__c:o.vals().No_of_Live_Chat_Agents__c,Comment__c:o.vals().Comment__c};WriteCookies("_comm100_mkto_fvs",JSON.stringify(e),30)}function GetFieldsAndValuesToPrefill(o){var e=GetCookie("_comm100_mkto_fvs");if(null!=e){var a=JSON.parse(e);o.vals(a)}}function WriteCookies(o,e,a){var i="";i=null!=a?new Date((new Date).getTime()+24*a*3600*1e3):new Date((new Date).getTime()+31536e6),i=";expires="+i.toGMTString(),document.cookie=o+"="+e+i}function IfCookieExists(o){return-1!=(document.cookie+";").indexOf(o)}function GetCookie(o){var e,a=null,i=document.cookie+";",m=i.indexOf(o);return-1!=m&&(m+=o.length,e=i.indexOf(";",m),a=unescape(i.substring(m+1,e))),a}!function(){function o(o){for(var a=0;a<e.length;a++){var i=e[a];if(-1!=o.indexOf(i))return!1}return!0}var e=["@skynet.","@interfree.","@valyoo.","@myself.","@cheerful.","@terra.","@sify.","@blumail.","@rediffmail.","@googlemail.","@email.com","@ireland.","@colombia.","@mac.","@ymail.","@uol.","@ig.","@bol.","@sapo.","@alice.","@me.","@yeah.","@139.","@qq.","@126.","@sohu.","@163.","@sina.","@aol.","@mail.","@care2.","@mywyamial.","@hotpop.","@myspace.","@zapak.","@lavabit.","@bigstring.","@live.","@hotmail.","@fastmail.","@inbox.","@gawab.","@zenbe.","@yahoo.","@gmx.","@aim.","@gmail.","@ssinfosysinc.com","@icloud.","@romandie.com","@bellsouth.net","@wans.net,","@verizon.net","@swbell.net","@kimo.com","@geocities.com","@flash.net","@btopenworld.com","@btinternet.com","@bellsouth.net","@talk21.com","@yahooxtra.co.nz","@y7mail.com","@wans.net,","@ameritech.net,","@bell.ca","@sympatico.ca","@windowslive.es","@hotmail.ca","@tuitionjobsportal.com","@yhg.biz","@posteo.net","@yandex.","@yopmail.","@outlook","@centurylink.net","@mtnl.net.in","@dudumail.","@facebook.com","@breakthru.com","@cox.net","@q.com","@takdhinadin.","@dvaar.","@indiawrites","@tadka","@india.","@imail.","@timepass.","@zmail.","@cytanet.com.cy","@yahoo.co.uk","@safe-mail.net","@mailcatch.com","@virgilio.it","@a1.perwebsolutions.in","@mailcatch.com","@spiceweb.net","@comcast.net","@rediff.com","@rocketmail","@yopmail.com","@insightbb","@katamail.com","@att.net","@inwind.it","@xtra.co.nz","secretary.net","salesperson.net","rescueteam.com","representative.com","repairman.com","registerednurses.com","realtyagent.com","radiologist.net","qualityservice.com","publicist.com","programmer.net","priest.com","presidency.com","politician.com","planetmail.net","planetmail.com","physicist.net","photographer.net","pediatrician.com","orthodontist.net","optician.com","net-shopping.com","musician.org","minister.com","lobbyist.com","legislator.com","journalist.com","job4u.com","insurer.com","instructor.net","instruction.com","hot-shot.com","homemail.com","hairdresser.net","groupmail.com","graphic-designer.com","graduate.org","geologist.com","gardener.com","fireman.net","financier.com","fastservice.com","execs.com","doctor.com","disposable.com","diplomats.com","deliveryman.com","cyberservices.com","counsellor.com","coolsite.net","computer4u.com","comic.com","columnist.com","collector.org","clubmember.org","clerk.com","chemist.com","chef.net","cash4u.com","brew-meister.com","birdlover.com","bikerider.com","bartender.net","auctioneer.net","artlover.com","arcticmail.com","archaeologist.com","appraiser.net","angelic.com","alumnidirector.com","alumni.com","allergist.com","adexec.com","activist.com","contractor.net","uymail.com","@hotmail.bs","@hotmail.at","@hotmail.co.uk","@coldmail.nu","@hushmail.com","@getemail.co.za","@garcesrealestate.com","hush.ai","aircraftmail.com","2trom.com","@frontier.","@charter","@aesinc.us.com","@zing.vn","@shaw.","@21cn.","@china.","@vip.163.","@libero.it","@nadlanu.","@tiscali.","@scoremusic.","@MAIL.RU","@nadlanu.","@cbn.","@netvigator.","@vip.126.","@vip.sina.","@ctimail.","@canada.","@usa.","@tom.","@zoho","@263.","@in.","@sbcglobal.","@msn.","@telus.","saintly.com","religious.com","reincarnate.com","protestant.com","muslim.com","innocent.com","disciples.com","torontomail.com","swissmail.com","swedenmail.com","spainmail.com","scotlandmail.com","samerica.com","safrica.com","polandmail.com","munich.com","moscowmail.com","mexicomail.com","koreamail.com","italymail.com","israelmail.com","irelandmail.com","germanymail.com","europemail.com","englandmail.com","dutchmail.com","dublin.com","chinamail.com","brazilmail.com","berlin.com","australiamail.com","asia-mail.com","africamail.com","sanfranmail.com","pacificwest.com","pacific-ocean.com","nycmail.com","dallasmail.com","californiamail.com","bellair.net","reggaefan.com","reborn.com","ravemail.com","oath.com","ninfan.com","metalfan.com","madonnafan.com","kissfans.com","hiphopfan.com","elvisfan.com","discofan.com","acdcfan.com","rocketship.com","null.net","mail-me.com","inorbit.com","humanoid.net","housemail.com","cyber-wizard.com","cybergal.com","cyberdude.com","toke.com","snakebite.com","petlover.com","nonpartisan.com","marchmail.com","lovecat.com","kittymail.com","keromail.com","hilarious.com","hackermail.com","greenmail.net","galaxyhit.com","doramail.com","doglover.com","dbzmail.com","cutey.com","catlover.com","bsdmail.com","brew-master.com","boardermail.com","blader.com","atheist.com","linuxmail.org","techie.com","accountant.com","cheerful.com","engineer.com","dr.com","writeme.com","iname.com","asia.com","europe.com","post.com","consultant.com","myself.com","email.com","mail.com","@prodigy.net.mx","@optusnet","@myway.","workmail.com","worker.com","webname.com","umpire.com","tvstar.com","toothfairy.com","therapist.net","theplate.com","technologist.com","tech-center.com","teachers.org","surgical.net","songwriter.net","solution4u.com","sociologist.com","socialworker.net","@outlook."];MktoForms2.whenReady(function(e){GetFieldsAndValuesToPrefill(e),e.onValidate(function(a){if(a){var i=e.vals().formtype,m=e.vals().Email,c="";switch(i){case"partner":case"contact":c=window.location.href;break;case"requstdemo":c=document.referrer}if(m)if(void 0===i||"contact"===i||o(m)){if(jQuery("input[name='Request_URL__c']")[0].value=c,AddFieldsAndVaulesStringToCookie(e),e.submitable(!0),navigator.userAgent.indexOf("MSIE")>=0||navigator.userAgent.indexOf("Trident/")>=0)return;jQuery("#downloadlink").length>0&&jQuery("#downloadlink")[0].click()}else{e.submitable(!1);var t=e.getFormElem().find("#Email");e.showErrorMessage("Must be Business email.",t)}}})})}();
//# sourceMappingURL=marketo-form.js.map
