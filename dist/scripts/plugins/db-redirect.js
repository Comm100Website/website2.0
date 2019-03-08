var DEMAND_BASE_COOKIE = 'audience';
var DEMAND_BASE_COUNTRY_COOKIE = 'country';

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

function setBodyClass() {
    if (document.body) {
        document.body.classList.add("db-audience-" + encodeURI(getCookie(DEMAND_BASE_COOKIE).replace(' ', '-').toLowerCase()));
	    document.body.classList.add("db-audience-" + encodeURI(getCookie(DEMAND_BASE_COUNTRY_COOKIE).replace(' ', '-').toLowerCase()));
    }
}
function redirect_to_db_audience(user_audience, user_country) {
    var audiencePageURL = dbGlobal.db_default;

    // console.log('User Audience: ', user_audience);

    //If the user has an audience and we have a list of audience pages for this page that was set in the theme setup, we'll then test and see if the user is on the right page.
    if ((user_audience || user_country)  && dbGlobal.db_audiences) {
        for (var db_audience in dbGlobal.db_audiences){
            // console.log(user_audience, db_audience);

            if (user_audience == db_audience || user_country == db_audience) {
                audiencePageURL = dbGlobal.db_audiences[db_audience];
            }
        }
    }

    // console.log('audience url', audiencePageURL);

    var currentPageURL = window.location.protocol + "//" + window.location.hostname + window.location.pathname;

    if (audiencePageURL != currentPageURL) {
        // console.log('Would have redirected to ' + audiencePageURL);
        window.location.href = audiencePageURL;
    }
}

if (location.search.indexOf('reset=')>=0) {
    eraseCookie(DEMAND_BASE_COOKIE);
    eraseCookie(DEMAND_BASE_COUNTRY_COOKIE);
}

if (!getCookie(DEMAND_BASE_COOKIE)) {
    //This script will call the DemandBase API, which we'll pass through our local theme in order to hide the API key. Then we can check the DemandBase audience assigned to the user and if it's different than the current page, then we'll redirect them to the appropriate DB page.
    var requestURL = dbGlobal.theme_url + '/ajax/demandbase-api.php';

    if (location.search.indexOf('ip=')>=0) {
        var urlParams = new URLSearchParams(window.location.search);
        requestURL += '?ip=' + urlParams.get('ip');
    }

    // console.log(requestURL);

    var xhr = new XMLHttpRequest();
    xhr.open('GET', requestURL, true);
    xhr.onload = function(e) {
        if (xhr.readyState === 4) {
			//We got a DB API response.
        	if (xhr.status === 200) {
				//Grab the responses JSON, save the users audience_segment and then redirect the user to the DB audience page if we need to.
				var responseJSON = JSON.parse(xhr.responseText);
				var country = responseJSON.registry_country;

				if (responseJSON.country_name) {
					country = responseJSON.country_name;
				}

				setCookie(DEMAND_BASE_COUNTRY_COOKIE, country, 365);
				setCookie(DEMAND_BASE_COOKIE, responseJSON.audience_segment, 365);

				setBodyClass();

				if (dbGlobal.db_audiences) {
					redirect_to_db_audience(responseJSON.audience_segment, country);
				}
			}
        }
    };
    xhr.send();
} else {
	if (dbGlobal.db_audiences) {
		//The user already had their DB audience defined in a cookie, so we'll just redirect them if needed.
    	redirect_to_db_audience(getCookie(DEMAND_BASE_COOKIE), getCookie(DEMAND_BASE_COUNTRY_COOKIE));
	}

	setBodyClass();
}