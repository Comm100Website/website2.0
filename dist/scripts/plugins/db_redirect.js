var xhr = new XMLHttpRequest();
xhr.open('GET', commGlobal.theme_url + '/ajax/demandbase-api.php');
xhr.onload = function() {
    if (xhr.status === 200) {
        responseJSON = $.parseJSON(xhr.responseText);
        console.log(responseJSON);

        if (responseJSON.audience) {
            console.log(responseJSON.audience);
        }
    }
};
xhr.send();