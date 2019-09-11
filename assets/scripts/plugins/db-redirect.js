var DEMAND_BASE_COOKIE = 'db_userinfo';

// if (typeof dataLayer !== 'undefined') {
//     var dataLayer = [];
// }

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

        while (c.charAt(0)===' ') {
            c = c.substring(1,c.length);
        }

        if (c.indexOf(nameEQ) === 0) {
            return c.substring(nameEQ.length,c.length);
        }
    }

    return null;
}

function eraseCookie(name) {
    document.cookie = name+'=; Max-Age=-99999999;';
}

function isUserLoggedIn() {
    return (document.cookie.indexOf('wp-settings') !== -1);
}

function urlParam(name) {
    var results = new RegExp('[\?&]' + name + '=([^&#]*)').exec(window.location.href);
    if (results===null){
       return null;
    }
    else{
       return decodeURI(results[1]) || 0;
    }
}

function setBodyClass(userInfo) {
    if( document.readyState !== 'loading' ) {
        if (userInfo) {
            var dbFields = [
                'registry_country',
                'registry_country_code',
                'country_name',
                'industry',
                'sub_industry',
                'audience',
                'audience_segment',
            ];

            // console.log('Setting DB Body Classes');

            for (var i = 0; i < dbFields.length; i++) {
                if (userInfo.hasOwnProperty(dbFields[i])) {
                    document.body.classList.add("db-audience-" + encodeURI(userInfo[dbFields[i]].replace(' ', '-').toLowerCase()));
                }
            }

            // console.log('Set Body Class', document.body.classList);

            //In MS Edge, something the event handler was called before the body class was set.
            // setTimeout(function() {
            var dbEvent;

            if(typeof(Event) === 'function') {
                dbEvent = new Event('db-audiences-set', { bubbles: true });
            }else{
                dbEvent = document.createEvent('Event');
                dbEvent.initEvent('db-audiences-set', true, true);
            }

            // var event = new Event('db-audiences-set', { bubbles: true });
            document.body.dispatchEvent(dbEvent);
        }
    } else {
        document.addEventListener('DOMContentLoaded', function () {
            // console.log( 'document was not ready, place code here' );
            setBodyClass(userInfo);
        });
    }
}

function redirect_to_db_audience(userinfo) {
    var audiencePageURL = dbGlobal.db_default;

    // console.log('User Audience', userinfo);
    // console.log('DB Audiences', dbGlobal.db_audiences);

    //If the user has an audience and we have a list of audience pages for this page that was set in the theme setup, we'll then test and see if the user is on the right page.
    if (userinfo && dbGlobal.db_audiences) {
        for (var i = 0; i < dbGlobal.db_audiences.length; i++) {
            // console.log(dbGlobal.db_audiences[i]);
            if (userinfo.hasOwnProperty(dbGlobal.db_audiences[i].field)) {
                // console.log('Audience field [' + dbGlobal.db_audiences[i].field + '] (' + userinfo[dbGlobal.db_audiences[i].field] +'=='+ dbGlobal.db_audiences[i].value + ')');

                if (userinfo.hasOwnProperty(dbGlobal.db_audiences[i].field) && userinfo[dbGlobal.db_audiences[i].field] === dbGlobal.db_audiences[i].value) {
                    var excluded = false;

                    //Now check to see if the user's audience is excluded from this rule. If it is we'll set the audience page to the current URL so we won't get redirected
                    if (dbGlobal.db_audiences[i].exclude.length > 0) {
                        for (var x = 0; x < dbGlobal.db_audiences[i].exclude.length; x++) {
                            if (userinfo.hasOwnProperty(dbGlobal.db_audiences[i].exclude[x].field) && userinfo[dbGlobal.db_audiences[i].exclude[x].field] === dbGlobal.db_audiences[i].exclude[x].value) {
                                excluded = true;
                                // console.log('User excluded based on ' + dbGlobal.db_audiences[i].exclude[x].field + ' matching ' + dbGlobal.db_audiences[i].exclude[x].value);
                            }
                        }
                    }

                    if (!excluded) {
                        audiencePageURL = dbGlobal.db_audiences[i].url;
                        break;
                    }
                }
            }
        }
    }

    // console.log('audience url', audiencePageURL);

    var currentPageURL = window.location.protocol + "//" + window.location.hostname + window.location.pathname;

    // console.log(window.location.pathname);
    if (audiencePageURL !== currentPageURL) {
        if (!isUserLoggedIn()) {
            console.log(audiencePageURL);
            console.log(audiencePageURL + location.search);

            window.location.href = audiencePageURL + location.search;
        }
    } else if (window.location.pathname === '/') {
        //Activate Google Optimize if we're on the homepage.
        // console.log('optimize.activate');
        dataLayer.push({'event': 'optimize.activate'});
    }
}

if (!getCookie(DEMAND_BASE_COOKIE) || location.search.indexOf('reset=')>=0) {
    //This script will call the DemandBase API, which we'll pass through our local theme in order to hide the API key. Then we can check the DemandBase audience assigned to the user and if it's different than the current page, then we'll redirect them to the appropriate DB page.
    var requestURL = dbGlobal.theme_url + '/ajax/demandbase-api.php';

    if (location.search.indexOf('ip=')>=0) {
        urlParam(name);
        requestURL += '?ip=' + urlParam('ip');
    } else {
        requestURL += '?cache=false';
    }

    // console.log('Request URL: ' + requestURL);

    var xhr = new XMLHttpRequest();
    xhr.open('GET', requestURL, true);
    xhr.onload = function(e) {
        if (xhr.readyState === 4) {
			//We got a DB API response.
        	if (xhr.status === 200) {
				//Grab the responses JSON, save the users audience_segment and then redirect the user to the DB audience page if we need to.
                // if (document.body.classList.contains('logged-in')) {
                    // console.log(xhr.responseText);
                // }

                var responseJSON = JSON.parse(xhr.responseText);

                setCookie(DEMAND_BASE_COOKIE, JSON.stringify(responseJSON), 1);
				setBodyClass(responseJSON);

                // console.log('DB Query', responseJSON);

				if (dbGlobal.db_active && dbGlobal.db_audiences) {
					redirect_to_db_audience(responseJSON);
				}
			}
        }
    };
    xhr.send();
} else {
    var userInfo = JSON.parse(getCookie(DEMAND_BASE_COOKIE));

    // console.log(userInfo);
	setBodyClass(userInfo);

    if (dbGlobal.db_active && dbGlobal.db_audiences) {
		//The user already had their DB audience defined in a cookie, so we'll just redirect them if needed.
    	redirect_to_db_audience(userInfo);
	}
}