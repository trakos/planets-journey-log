{
    var onResize = function () {
        var center = $(".grid_vertical_center");
        var wrapperHeight = $("#mws-wrapper").height() - 200;
        if (center.length == 1) {
            if (center.height() < wrapperHeight) {
                center.css("margin-top", (wrapperHeight - center.height()) / 2);
            }
        }
        $(".model-login, #mws-navigation .key-2").bind("click", function (event) {
            $("#mws-login-ui").dialog("option", {
                modal: true
            }).dialog("open");
            event.preventDefault();
        });
    };
    $(onResize);
    $(window).resize(onResize);
}