function setCookie(name,value,days) {
    var expires = "";
    if (days) {
        var date = new Date();
        date.setTime(date.getTime() + (days*24*60*60*1000));
        expires = "; expires=" + date.toUTCString();
    }
    document.cookie = name + "=" + (value || "")  + expires + "; path=/";
}

function getCookie(name) {
    var nameEQ = name + "=";
    var ca = document.cookie.split(';');
    for(var i=0;i < ca.length;i++) {
        var c = ca[i];
        while (c.charAt(0)==' ') c = c.substring(1,c.length);
        if (c.indexOf(nameEQ) == 0) return c.substring(nameEQ.length,c.length);
    }
    return null;
}

function eraseCookie(name) {
    document.cookie = name+'=; Max-Age=-99999999;';
}

function redirect_to_db_audience(user_audience) {
    var audiencePageURL = dbGlobal.db_default;

    console.log('User Audience: ', user_audience);

    //If the user has an audience and we have a list of audience pages for this page that was set in the theme setup, we'll then test and see if the user is on the right page.
    if (user_audience && dbGlobal.db_audiences) {
        for (var db_audience in dbGlobal.db_audiences){
            console.log(user_audience, db_audience);

            if (user_audience == db_audience) {
                audiencePageURL = dbGlobal.db_audiences[db_audience];
            }
        }
    }

    console.log('audience url', audiencePageURL);

    var currentPageURL = window.location.protocol + "//" + window.location.hostname + window.location.pathname;

    if (audiencePageURL != currentPageURL) {
        window.location.href = audiencePageURL;
    }
}

var DEMAND_BASE_COOKIE = 'db_audience';

if (location.search.indexOf('reset=')>=0) {
    eraseCookie(DEMAND_BASE_COOKIE);
}

if (!getCookie(DEMAND_BASE_COOKIE)) {
    //This script will call the DemandBase API, which we'll pass through our local theme in order to hide the API key. Then we can check the DemandBase audience assigned to the user and if it's different than the current page, then we'll redirect them to the appropriate DB page.
    var requestURL = dbGlobal.theme_url + '/ajax/demandbase-api.php';

    if (location.search.indexOf('ip=')>=0) {
        var urlParams = new URLSearchParams(window.location.search);
        requestURL += '?ip=' + urlParams.get('ip');
    }

    console.log(requestURL);

    var xhr = new XMLHttpRequest();
    xhr.open('GET', requestURL, false);
    xhr.onload = function() {
        //We got a DB API response.
        if (xhr.status === 200) {
            //Grab the responses JSON, save the users audience_segment and then redirect the user to the DB audience page if we need to.
            var responseJSON = JSON.parse(xhr.responseText);
            console.log(responseJSON);
            setCookie(DEMAND_BASE_COOKIE, responseJSON.audience_segment, 365);
            redirect_to_db_audience(responseJSON.audience_segment);
        }
    };
    xhr.send();
} else {
    //The user already had their DB audience defined in a cookie, so we'll just redirect them if needed.
    redirect_to_db_audience(getCookie(DEMAND_BASE_COOKIE));
}