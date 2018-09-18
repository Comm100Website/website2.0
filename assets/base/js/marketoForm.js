(function() {
    MktoForms2.whenReady(function(form) {
        GetFieldsAndValuesToPrefill(form);
        form.onValidate(function(builtInValid) {
            if (!builtInValid) return;
            if ($("#Website_Text__c")[0].value.toLowerCase().indexOf('www.comm100.com') >= 0) {
                var errorMsg = '<div id="invalidWebsite" class="mktoError" style="right: 34px;bottom: -34px;"><div class="mktoErrorArrowWrap"><div class="mktoErrorArrow"></div></div><div class="mktoErrorMsg">Please enter your own website.</div></div>';
                $("#Website_Text__c").after(errorMsg);
                form.submitable(false);
                return;
            }
            $("input[name='Request_URL__c']")[0].value = window.location.href;
            AddFieldsAndVaulesStringToCookie(form);
            form.submitable(true);
            if (navigator.userAgent.indexOf('MSIE') >= 0 || navigator.userAgent.indexOf('Trident/') >= 0) {
                return;
            }
            if($("#downloadlink").length > 0) {
               $("#downloadlink")[0].click();
            }
            
        });
        $("#Website_Text__c").focus(function() {
            if ($("#invalidWebsite").length) {
                $("#invalidWebsite").remove();
            }
        })
    });
})();