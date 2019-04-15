var DEMAND_BASE_COOKIE = 'db_visitor_info';

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

function setBodyClass(userInfo) {
    if (document.body) {
        if (userInfo) {
            var dbFields = [
                'registry_country',
                'country_name',
                'industry',
                'sub_industry',
                'audience',
                'audience_segment',
            ];

            for (var i = 0; i < dbFields.length; i++) {
                if (userInfo.hasOwnProperty(dbFields[i])) {
                    document.body.classList.add("db-audience-" + encodeURI(userInfo[dbFields[i]].replace(' ', '-').toLowerCase()));
                }
            }
        }
    }
}

function redirect_to_db_audience(userinfo) {
    var audiencePageURL = dbGlobal.db_default;

    // console.log('User Audience', userinfo);
    // console.log('DB Audiences', dbGlobal.db_audiences);

    //If the user has an audience and we have a list of audience pages for this page that was set in the theme setup, we'll then test and see if the user is on the right page.
    if (userinfo && dbGlobal.db_audiences) {
        for (var i = 0; i < dbGlobal.db_audiences.length; i++) {
            console.log(dbGlobal.db_audiences[i]);
            if (userinfo.hasOwnProperty(dbGlobal.db_audiences[i].field)) {
                console.log('Audience field [' + dbGlobal.db_audiences[i].field + '] (' + userinfo[dbGlobal.db_audiences[i].field] +'=='+ dbGlobal.db_audiences[i].value + ')');

                if (userinfo.hasOwnProperty(dbGlobal.db_audiences[i].field) && userinfo[dbGlobal.db_audiences[i].field] == dbGlobal.db_audiences[i].value) {
                    var excluded = false;

                    //Now check to see if the user's audience is excluded from this rule. If it is we'll set the audience page to the current URL so we won't get redirected
                    if (dbGlobal.db_audiences[i].exclude.length > 0) {
                        for (var x = 0; x < dbGlobal.db_audiences[i].exclude.length; x++) {
                            if (userinfo.hasOwnProperty(dbGlobal.db_audiences[i].exclude[x].field) && userinfo[dbGlobal.db_audiences[i].exclude[x].field] == dbGlobal.db_audiences[i].exclude[x].value) {
                                excluded = true;
                                // console.log('User excluded based on ' + dbGlobal.db_audiences[i].exclude[x].field + ' matching ' + dbGlobal.db_audiences[i].exclude[x].value);
                            }
                        }
                    }

                    if (!excluded) {
                        console.log('User matched based on ' + dbGlobal.db_audiences[i].field + ' matching ' + dbGlobal.db_audiences[i].value);

                        audiencePageURL = dbGlobal.db_audiences[i].url;
                        break;
                    }
                }
            }
        }
    }

    console.log('audience url', audiencePageURL);

    var currentPageURL = window.location.protocol + "//" + window.location.hostname + window.location.pathname;

    if (audiencePageURL != currentPageURL) {
        console.log('Would have redirected to ' + audiencePageURL);
        window.location.href = audiencePageURL;
    }
}

// if (location.search.indexOf('reset=')>=0) {
//     console.log('Erasing Cookies');
//     eraseCookie(DEMAND_BASE_COOKIE);
// }

if (!getCookie(DEMAND_BASE_COOKIE) || location.search.indexOf('reset=')>=0) {
    //This script will call the DemandBase API, which we'll pass through our local theme in order to hide the API key. Then we can check the DemandBase audience assigned to the user and if it's different than the current page, then we'll redirect them to the appropriate DB page.
    var requestURL = dbGlobal.theme_url + '/ajax/demandbase-api.php';

    if (location.search.indexOf('ip=')>=0) {
        var urlParams = new URLSearchParams(window.location.search);
        requestURL += '?ip=' + urlParams.get('ip');
    }

    console.log('Request URL: ' + requestURL);

    var xhr = new XMLHttpRequest();
    xhr.open('GET', requestURL, true);
    xhr.onload = function(e) {
        if (xhr.readyState === 4) {
			//We got a DB API response.
        	if (xhr.status === 200) {
				//Grab the responses JSON, save the users audience_segment and then redirect the user to the DB audience page if we need to.
				var responseJSON = JSON.parse(xhr.responseText);

                // setCookie(DEMAND_BASE_COOKIE, JSON.stringify(responseJSON), 365);
				setBodyClass(responseJSON);

                console.log('DB Query', responseJSON);

				if (dbGlobal.db_audiences) {
					redirect_to_db_audience(responseJSON);
				}
			}
        }
    };
    xhr.send();
} else {
    var userInfo = JSON.parse(getCookie(DEMAND_BASE_COOKIE));

	if (dbGlobal.db_audiences) {
		//The user already had their DB audience defined in a cookie, so we'll just redirect them if needed.
    	redirect_to_db_audience(userInfo);
	}

	setBodyClass(userInfo);
}