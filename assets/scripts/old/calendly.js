(function() {
	function getCookies(a) {
		return document.cookie.length > 0 && (c_start = document.cookie.indexOf(a + "="), -1 != c_start) ? (c_start = c_start + a.length + 1, c_end = document.cookie.indexOf(";", c_start), -1 == c_end && (c_end = document.cookie.length), unescape(document.cookie.substring(c_start, c_end))) : "";
	}
	//Comm100 service country.
    var countries = new Array("andorra", "anguilla", "antigua and barbuda", "argentina", "armenia", "aruba",
        "austria",
        "bahamas", "barbados",
        "belarus", "belgium", "belize", "bermuda", "bolivia", "bonaire, sint eustatius, and saba",
        "bosnia and herzegovina",
        "brazil", "british virgin islands", "bulgaria",
        "ca", "canada", "cayman islands", "chile", "colombia", "costa rica", "croatia", "cuba", "curacao",
        "czechia",
        "denmark", "dominica",
        "dominican republic", "ecuador", "el salvador", "estonia", "falkland islands", "finland", "france",
        "french guiana",
        "georgia", "germany",
        "gibraltar", "greece", "greenland", "grenada", "guadeloupe", "guatemala", "guyana", "haiti", "honduras",
        "hungary",
        "iceland", "ireland",
        "italy", "jamaica", "latvia", "liechtenstein", "republic of lithuania", "luxembourg", "macedonia",
        "martinique",
        "mexico", "republic of moldova", "monaco",
        "montenegro", "montserrat", "netherlands", "netherlands antilles", "nicaragua", "norway", "panama",
        "paraguay",
        "peru", "poland", "portugal",
        "puerto rico", "romania", "russian federation", "saint barthelemy", "saint helena",
        "st kitts and nevis",
        "saint lucia", "saint martin",
        "saint pierre and miquelon", "saint vincent and the grenadines", "san marino", "serbia", "slovakia",
        "slovenia",
        "south georgia and the south sandwich islands", "spain", "suriname", "sweden", "switzerland",
        "trinidad and tobago",
        "turks and caicos islands",
        "ukraine", "united kingdom", "united states", "u.s. minor outlying islands", "uruguay", "us", "usa",
        "vatican city",
        "venezuela",
        "u.s. virgin islands")

    var customerInfo = getCookies("_comm100_mkto_fvs");


    var position = {};
    position.action = "getPosition_action";
    $.ajax({
        type: "POST",
        url: "https://www.comm100.com/wp-admin/admin-ajax.php",
        data: position,
        success: function (result) {
            if (result != null) {
                if (isServiceCountry(result.substr(0, result.length - 1))) {
                    showInServiceCountry();
                }
            }
        }
    })

    function isServiceCountry(country) {
        return countries.indexOf(country.toLowerCase()) != -1;
    }

    function showInServiceCountry() {
    	var FirstName = '';
        var LastName = '';
        var Email = '';
        var Phone = '';
        
    	if (customerInfo !== "") {
    		var customerInfo_JSON=JSON.parse(customerInfo);
    		FirstName = customerInfo_JSON.FirstName;
	        LastName = customerInfo_JSON.LastName;
	        Email = customerInfo_JSON.Email;
	        Phone = customerInfo_JSON.Phone;
    	}
        
        
        var url = 'https://calendly.com/ciprian-2/30min'
        if (FirstName != '' || LastName != '') {
            url += '?name=' + FirstName + ' ' + LastName;
        }
        if (Email != '') {
            url += '&amp;email=' + Email;
        }
        if (Phone != '') {
            url += '&amp;a1=' + Phone;
        }
        $('#calendlyPlugin').attr('data-url', url);

        var script = document.createElement('script');
        script.setAttribute("type", "text/javascript");
        script.src = "https://assets.calendly.com/assets/external/widget.js";
        document.body.appendChild(script);

        $('#inServiceCountry').show();
        $('#notInServiceCountry').hide();
    }
}());