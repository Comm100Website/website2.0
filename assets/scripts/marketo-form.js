/* jshint ignore:start */
(function (){
    // Please include the email domains you would like to block in this list
    var invalidDomains = ["@skynet.", "@interfree.", "@valyoo.", "@myself.", "@cheerful.", "@terra.",
    "@sify.", "@blumail.", "@rediffmail.", "@googlemail.", "@email.com", "@ireland.", "@colombia.",
    "@mac.", "@ymail.", "@uol.", "@ig.", "@bol.", "@sapo.", "@alice.", "@me.", "@yeah.", "@139.",
    "@qq.", "@126.", "@sohu.", "@163.", "@sina.", "@aol.", "@mail.", "@care2.", "@mywyamial.",
    "@hotpop.", "@myspace.", "@zapak.", "@lavabit.", "@bigstring.", "@live.", "@hotmail.",
    "@fastmail.", "@inbox.", "@gawab.", "@zenbe.", "@yahoo.", "@gmx.", "@aim.", "@gmail.",
    "@ssinfosysinc.com", "@icloud.", "@romandie.com", "@bellsouth.net", "@wans.net,", "@verizon.net",
    "@swbell.net", "@kimo.com", "@geocities.com", "@flash.net", "@btopenworld.com", "@btinternet.com",
    "@bellsouth.net", "@talk21.com", "@yahooxtra.co.nz", "@y7mail.com", "@wans.net,", "@ameritech.net,",
    "@bell.ca", "@sympatico.ca", "@windowslive.es", "@hotmail.ca", "@tuitionjobsportal.com", "@yhg.biz",
    "@posteo.net", "@yandex.", "@yopmail.", "@outlook", "@centurylink.net", "@mtnl.net.in", "@dudumail.",
    "@facebook.com", "@breakthru.com", "@cox.net", "@q.com", "@takdhinadin.", "@dvaar.", "@indiawrites", "@tadka",
    "@india.", "@imail.", "@timepass.", "@zmail.", "@cytanet.com.cy", "@yahoo.co.uk", "@safe-mail.net",
    "@mailcatch.com", "@virgilio.it", "@a1.perwebsolutions.in", "@mailcatch.com", "@spiceweb.net", "@comcast.net",
    "@rediff.com", "@rocketmail", "@yopmail.com", "@insightbb", "@katamail.com", "@att.net", "@inwind.it",
    "@xtra.co.nz", "secretary.net", "salesperson.net", "rescueteam.com", "representative.com", "repairman.com",
    "registerednurses.com", "realtyagent.com", "radiologist.net", "qualityservice.com", "publicist.com", "programmer.net",
    "priest.com", "presidency.com", "politician.com", "planetmail.net", "planetmail.com", "physicist.net", "photographer.net",
    "pediatrician.com", "orthodontist.net", "optician.com", "net-shopping.com", "musician.org", "minister.com", "lobbyist.com",
    "legislator.com", "journalist.com", "job4u.com", "insurer.com", "instructor.net", "instruction.com", "hot-shot.com",
    "homemail.com", "hairdresser.net", "groupmail.com", "graphic-designer.com", "graduate.org", "geologist.com", "gardener.com",
    "fireman.net", "financier.com", "fastservice.com", "execs.com", "doctor.com", "disposable.com", "diplomats.com",
    "deliveryman.com", "cyberservices.com", "counsellor.com", "coolsite.net", "computer4u.com", "comic.com", "columnist.com",
    "collector.org", "clubmember.org", "clerk.com", "chemist.com", "chef.net", "cash4u.com", "brew-meister.com", "birdlover.com",
    "bikerider.com", "bartender.net", "auctioneer.net", "artlover.com", "arcticmail.com", "archaeologist.com", "appraiser.net",
    "angelic.com", "alumnidirector.com", "alumni.com", "allergist.com", "adexec.com", "activist.com", "contractor.net", "uymail.com",
    "@hotmail.bs", "@hotmail.at", "@hotmail.co.uk", "@coldmail.nu", "@hushmail.com", "@getemail.co.za", "@garcesrealestate.com",
    "hush.ai", "aircraftmail.com", "2trom.com", "@frontier.", "@charter", "@aesinc.us.com", "@zing.vn", "@shaw.", "@21cn.",
    "@china.", "@vip.163.", "@libero.it", "@nadlanu.", "@tiscali.", "@scoremusic.", "@MAIL.RU", "@nadlanu.", "@cbn.", "@netvigator.",
    "@vip.126.", "@vip.sina.", "@ctimail.", "@canada.", "@usa.", "@tom.", "@zoho", "@263.", "@in.", "@sbcglobal.", "@msn.",
    "@telus.", "saintly.com", "religious.com", "reincarnate.com", "protestant.com", "muslim.com", "innocent.com", "disciples.com",
    "torontomail.com", "swissmail.com", "swedenmail.com", "spainmail.com", "scotlandmail.com", "samerica.com", "safrica.com",
    "polandmail.com", "munich.com", "moscowmail.com", "mexicomail.com", "koreamail.com", "italymail.com", "israelmail.com",
    "irelandmail.com", "germanymail.com", "europemail.com", "englandmail.com", "dutchmail.com", "dublin.com", "chinamail.com",
    "brazilmail.com", "berlin.com", "australiamail.com", "asia-mail.com", "africamail.com", "sanfranmail.com", "pacificwest.com",
    "pacific-ocean.com", "nycmail.com", "dallasmail.com", "californiamail.com", "bellair.net", "reggaefan.com", "reborn.com",
    "ravemail.com", "oath.com", "ninfan.com", "metalfan.com", "madonnafan.com", "kissfans.com", "hiphopfan.com", "elvisfan.com",
    "discofan.com", "acdcfan.com", "rocketship.com", "null.net", "mail-me.com", "inorbit.com", "humanoid.net", "housemail.com",
    "cyber-wizard.com", "cybergal.com", "cyberdude.com", "toke.com", "snakebite.com", "petlover.com", "nonpartisan.com",
    "marchmail.com", "lovecat.com", "kittymail.com", "keromail.com", "hilarious.com", "hackermail.com", "greenmail.net",
    "galaxyhit.com", "doramail.com", "doglover.com", "dbzmail.com", "cutey.com", "catlover.com", "bsdmail.com", "brew-master.com",
    "boardermail.com", "blader.com", "atheist.com", "linuxmail.org", "techie.com", "accountant.com", "cheerful.com",
    "engineer.com", "dr.com", "writeme.com", "iname.com", "asia.com", "europe.com", "post.com", "consultant.com", "myself.com",
    "email.com", "mail.com", "@prodigy.net.mx", "@optusnet", "@myway.", "workmail.com", "worker.com", "webname.com", "umpire.com",
    "tvstar.com", "toothfairy.com", "therapist.net", "theplate.com", "technologist.com", "tech-center.com", "teachers.org",
    "surgical.net", "songwriter.net", "solution4u.com", "sociologist.com", "socialworker.net", "@outlook."];

    MktoForms2.whenReady(function (form){
        //map your results from REST call to the corresponding field name on the form
        GetFieldsAndValuesToPrefill(form);
        form.onValidate(function(isValid){
            if (!isValid) {
                return;  
            }  
            var formtype = form.vals().formtype;
            var email = form.vals().Email;
            var requestUrl = '';
            switch (formtype) {
                case 'partner':
                case 'contact':
                    requestUrl = window.location.href;
                    break;
                case 'requstdemo':
                    requestUrl = document.referrer;
                    break;
                default: break;
            }
            if(email){
                if(typeof(formtype) !== 'undefined' && formtype !== 'contact' && !isEmailGood(email)) {
                    form.submitable(false);
                    var emailElem = form.getFormElem().find("#Email");
                    form.showErrorMessage("Must be Business email.", emailElem);
                }else{
                    jQuery("input[name='Request_URL__c']")[0].value = requestUrl;
                    AddFieldsAndVaulesStringToCookie(form);
                    form.submitable(true);
                    if (navigator.userAgent.indexOf('MSIE') >= 0 || navigator.userAgent.indexOf('Trident/') >= 0) {
                        return;
                    }
                    if(jQuery("#downloadlink").length > 0) {
                        jQuery("#downloadlink")[0].click();
                    }
                }
            }
        });
    });
    function isEmailGood(email) {
        for(var i=0; i < invalidDomains.length; i++) {
            var domain = invalidDomains[i];
            if (email.indexOf(domain) != -1) {
                return false;
            }
        }
        return true;
    }


})();

function AddFieldsAndVaulesStringToCookie(form) {
    var fieldsAndValues = {
        Email: form.vals().Email,
        FirstName: form.vals().FirstName,
        LastName: form.vals().LastName,
        Company: form.vals().Company,
        Phone: form.vals().Phone,
        Job_Role__c: form.vals().Job_Role__c,
        No_of_Live_Chat_Agents__c: form.vals().No_of_Live_Chat_Agents__c,
        Comment__c: form.vals().Comment__c
    };
    WriteCookies("_comm100_mkto_fvs", JSON.stringify(fieldsAndValues), 30);
}

function GetFieldsAndValuesToPrefill(form) {
    var read = GetCookie("_comm100_mkto_fvs");
    if (read != null) {
        var prefillFields = JSON.parse(read);
        form.vals(prefillFields);
    }
}
function WriteCookies(Key, Value, expire) {
    var ep = "";
    if (expire != null) {
        ep = new Date((new Date()).getTime() + expire * 24 * 3600 * 1000);
    }
    else {
        ep = new Date((new Date()).getTime() + 365 * 24 * 3600 * 1000);
    }
    ep = ";expires=" + ep.toGMTString();
    document.cookie = Key + "=" + Value + ep;
}
function IfCookieExists(key) {
    var result = null;
    var myCookie = document.cookie + ";";
    var startOfCookie = myCookie.indexOf(key);
    if (startOfCookie != -1) {
        return true;
    }
    return false;
}
function GetCookie(key) {
    var result = null;
    var myCookie = document.cookie + ";";
    var startOfCookie = myCookie.indexOf(key);
    var endOfCookie;
    if (startOfCookie != -1) {
        startOfCookie += key.length;
        endOfCookie = myCookie.indexOf(";", startOfCookie);
        result = unescape(myCookie.substring(startOfCookie + 1, endOfCookie));
    }
    return result;
}
/* jshint ignore:end */
