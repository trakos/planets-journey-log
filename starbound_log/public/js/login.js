$(function(){
    $("#mws-login-ui").dialog({
        autoOpen: false,
        title: '<i class="icon-lock" style="padding-bottom:4px;"></i> Login',
        modal: true,
        width: "300",
        buttons: []
    });
    $(".model-login, #mws-navigation .key-2").bind("click", function (event) {
        $("#mws-login-ui").dialog("option", {
            modal: true
        }).dialog("open");
        event.preventDefault();
    });
});