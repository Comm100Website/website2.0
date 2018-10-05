/**
 * @author Mark
 */
//dropdownlist
    $("select.postform").each(function() {

        $(this).wrap("<label class=\"dropdown\"></label>");
        $(this).after("<span class=\"selectedvalue\">Please choose country/region</span><span class=\"spanddl\"></span>");
        $(this).next(".selectedvalue").html($('<div/>').text($(this).find("option:selected").text()).html());
        $(this).next(".selectedvalue").css("width", $(this).width() - 20 + "px");
    })

    $("select.postform").change(function() {
        $(this).next(".selectedvalue").css("color", "#ADAEAD");
        $(this).next(".selectedvalue").html($('<div/>').text($(this).find("option:selected").text()).html());
    })


    $('.dropdown select.postform').click(function() {
        $(this).parent().toggleClass('active');
        return false;
    });
    $(document).click(function() {
        $('.dropdown').removeClass('active');
    });